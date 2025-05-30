<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car-id'])) {
  $car_id       = $_POST['car-id'];
  $pickup_date  = htmlspecialchars($_POST['pickup-date']);
  $pickup_time  = htmlspecialchars($_POST['pickup-time']);
  $dropoff_date = htmlspecialchars($_POST['dropoff-date']);
  $dropoff_time = htmlspecialchars($_POST['dropoff-time']);
  $rs_stripe_payment_id = htmlspecialchars($_POST['stripe-payment-id'] ?? '');
  $raw_extras   = json_decode($_POST['extras-data'], true);

  $r = pg_query($conn, "SELECT car_price_per_day 
                            FROM cars 
                            WHERE car_id = $car_id");

  if (!($r && pg_num_rows($r))) {
?>
    <p class='text-red-600 text-center mt-4'><?= __('Car not found.', $lang); ?></p>
  <?php
    exit;
  }

  $car_price_per_day = pg_fetch_assoc($r)['car_price_per_day'];
  $pickup  = new DateTime($pickup_date);
  $dropoff = new DateTime($dropoff_date);
  $days    = max($pickup->diff($dropoff)->days, 1);
  $base_rent = $car_price_per_day * $days;

  $extras_to_store = [];
  $total_extras = 0.0;

  if (is_array($raw_extras)) {
    foreach ($raw_extras as $extra) {
      $name     = $extra['name'];
      $qty      = $extra['quantity'];
      $unit     = $extra['price'];
      $subtotal = $qty * $unit;
      $total_extras += $subtotal;

      $en = pg_escape_string($conn, $name);
      $qr = pg_query($conn, "SELECT extra_id 
                                FROM extras 
                                WHERE extra_name = '$en' 
                                LIMIT 1;");
      $eid = $qr && pg_num_rows($qr)
        ? (int) pg_fetch_assoc($qr)['extra_id']
        : null;

      $extras_to_store[] = [
        'id'         => $eid,
        'name'       => $name,
        'quantity'   => $qty,
        'unit_price' => $unit,
      ];
    }
  }

  $total_price = $base_rent + $total_extras;
  $extras_json = pg_escape_string($conn, json_encode($extras_to_store));

  $sql = "
    INSERT INTO reservations (
      user_id, car_id,
      rs_pickup_date, rs_pickup_time,
      rs_dropoff_date, rs_dropoff_time,
      rs_total_price, rs_stripe_payment_id, rs_status,
      rs_extras,
      rs_created_at
    ) VALUES (
      $session_user_id, $car_id,
      '$pickup_date', '$pickup_time',
      '$dropoff_date', '$dropoff_time',
      $total_price, '$rs_stripe_payment_id', 'Confirmed',
      '$extras_json',
      NOW()
    )
      RETURNING rs_number";

  $result = pg_query($conn, $sql);

  if (!$result) {
    echo "<p class='text-red-600 text-center mt-4'>Error inserting reservation: "
      . pg_last_error($conn) . "</p>";
    exit;
  }

  $reservation_id = pg_fetch_result($result, 0, 'rs_number');

  // Redirige tras guardar para evitar reinserción al recargar
  header("Location: " . $_SERVER['PHP_SELF'] . "?id=$reservation_id");

  // Cerrar conexión
  pg_close($conn);

  exit;
}



// Mostrar datos si viene por GET con ?id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $reservation_id = (int)$_GET['id'];

  $res = pg_query($conn, "
  SELECT * FROM reservations_view
  WHERE rs_number = $reservation_id
  AND user_id = $session_user_id
  LIMIT 1
  ");


  if ($res && pg_num_rows($res)) {
    $row = pg_fetch_assoc($res);
    $extras_arr = json_decode($row['rs_extras'], true);

    $pickup = new DateTime($row['rs_pickup_date']);
    $dropoff = new DateTime($row['rs_dropoff_date']);
    $days = max($pickup->diff($dropoff)->days, 1);
    $base_rent = $days * (float)$row['car_price_per_day'];
  ?>
    <h1 class="text-center text-2xl p-3"><?= __('Reservation Confirmed', $lang); ?></h1>

    <div class="max-w-2xl mx-auto bg-white p-4 rounded shadow">
      <p><strong><?= __('Reservation') ?> #:</strong> <?= $row['rs_number'] ?></p>
      <p><strong><?= __('Customer', $lang) ?>:</strong> <?= $row['user_fullname'] ?> (<?= $row['user_nif'] ?>)</p>
      <p><strong><?= __('Pick up date', $lang) ?>:</strong> <?= $row['rs_pickup_date'] ?> <?= __('at', $lang) ?> <?= $row['rs_pickup_time'] ?>h</p>
      <p><strong><?= __('Drop off date', $lang) ?>:</strong> <?= $row['rs_dropoff_date'] ?> <?= __('at', $lang) ?> <?= $row['rs_dropoff_time'] ?>h</p>
      <p><strong><?= __('Status', $lang) ?>:</strong> <?= $row['rs_status'] ?></p>
      <p><strong><?= __('Days', $lang) ?>:</strong> <?= $days ?></p>
      <p><strong><?= __('Rent', $lang) ?>:</strong> <?= number_format($base_rent, 2) ?>€</p>

      <p class="mt-2"><strong><?= __('Car', $lang) ?>:</strong> <?= $row['car_brand'] ?> <?= $row['car_model'] ?></p>
      <p><strong><?= __('Price per day', $lang) ?>:</strong> <?= number_format($row['car_price_per_day'], 2) ?>€</p>

      <h3 class="mt-4 font-semibold"><?= __('Extras', $lang) ?>:</h3>

      <?php if (!empty($extras_arr)): ?>
        <ul class="list-disc pl-5">
          <?php foreach ($extras_arr as $ex): ?>
            <li>
              <?= htmlspecialchars($ex['name']) ?> x<?= $ex['quantity'] ?> (
              <?= number_format($ex['unit_price'], 2) ?>€/unit) =
              <?= number_format($ex['unit_price'] * $ex['quantity'], 2) ?>€
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p><?= __('No extras selected', $lang) ?></p>
      <?php endif; ?>

      <p class="text-xl mt-4"><strong><?= __('Total Price', $lang) ?>:</strong> <?= number_format($row['rs_total_price'], 2) ?>€</p>
    </div>
  <?php
  } elseif ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  ?>
    <p class="text-red-600 text-center mt-4"><?= __('Missing reservation data or user not logged in.', $lang) ?></p>
  <?php
  } else {
  ?>
    <p class="text-red-600 text-center mt-4"><?= __('Reservation not available', $lang) ?></p>
<?php
  }

  pg_close($conn);
}
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>