<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>


<?php

include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car-id'])) {
  $car_id       = (int) $_POST['car-id'];
  $pickup_date  = mysqli_real_escape_string($conn, $_POST['pickup-date']);
  $pickup_time  = mysqli_real_escape_string($conn, $_POST['pickup-time']);
  $dropoff_date = mysqli_real_escape_string($conn, $_POST['dropoff-date']);
  $dropoff_time = mysqli_real_escape_string($conn, $_POST['dropoff-time']);
  $raw_extras   = json_decode($_POST['extras-data'], true);

  $r = mysqli_query($conn, "SELECT car_price_per_day 
                            FROM cars 
                            WHERE car_id = $car_id");

  if (!($r && mysqli_num_rows($r))) {
    echo "<p class='text-red-600 text-center mt-4'>Car not found.</p>";
    exit;
  }

  $car_price_per_day = mysqli_fetch_assoc($r)['car_price_per_day'];
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

      $en = mysqli_real_escape_string($conn, $name);
      $qr = mysqli_query($conn, "SELECT extra_id 
                                FROM extras 
                                WHERE extra_name = '$en' 
                                LIMIT 1;");
      $eid = $qr && mysqli_num_rows($qr)
        ? (int) mysqli_fetch_assoc($qr)['extra_id']
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
  $extras_json = mysqli_real_escape_string($conn, json_encode($extras_to_store));

  $sql = "
    INSERT INTO reservations (
      user_id, car_id,
      rs_pickup_date, rs_pickup_time,
      rs_dropoff_date, rs_dropoff_time,
      rs_total_price, rs_status,
      rs_extras,
      rs_created_at
    ) VALUES (
      $session_user_id, $car_id,
      '$pickup_date', '$pickup_time',
      '$dropoff_date', '$dropoff_time',
      $total_price, 'Confirmed',
      '$extras_json',
      NOW()
    )";

  if (!mysqli_query($conn, $sql)) {
    echo "<p class='text-red-600 text-center mt-4'>Error inserting reservation: "
      . mysqli_error($conn) . "</p>";
    exit;
  }

  $reservation_id = mysqli_insert_id($conn);

  // Redirige tras guardar para evitar reinserción al recargar
  header("Location: " . $_SERVER['PHP_SELF'] . "?id=$reservation_id");

exit;
}  // Cierre del bloque POST



// Mostrar datos si viene por GET con ?id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $reservation_id = (int)$_GET['id'];

  $res = mysqli_query($conn, "
  SELECT * FROM reservations_view
  WHERE rs_number = $reservation_id
  AND user_id = $session_user_id
  LIMIT 1
  ");

  if ($res && mysqli_num_rows($res)) {
    $row = mysqli_fetch_assoc($res);
    $extras_arr = json_decode($row['rs_extras'], true);

    $pickup = new DateTime($row['rs_pickup_date']);
    $dropoff = new DateTime($row['rs_dropoff_date']);
    $days = max($pickup->diff($dropoff)->days, 1);
    $base_rent = $days * (float)$row['car_price_per_day'];

    echo "<h1 class='text-center text-2xl p-3'>Reservation Confirmed</h1>";
    echo "<div class='max-w-2xl mx-auto bg-white p-4 rounded shadow'>";
    echo "<p><strong>Reservation #:</strong> {$row['rs_number']}</p>";
    echo "<p><strong>Customer:</strong> {$row['user_fullname']} ({$row['user_nif']})</p>";
    echo "<p><strong>Pickup:</strong> {$row['rs_pickup_date']} at {$row['rs_pickup_time']}</p>";
    echo "<p><strong>Dropoff:</strong> {$row['rs_dropoff_date']} at {$row['rs_dropoff_time']}</p>";
    echo "<p><strong>Status:</strong> {$row['rs_status']}</p>";
    echo "<p><strong>Days:</strong> $days</p>";
    echo "<p><strong>Base Rent:</strong> " . number_format($base_rent, 2) . "€</p>";
    echo "<p class='mt-2'><strong>Car:</strong> {$row['car_brand']} {$row['car_model']}</p>";
    echo "<p><strong>Price per day:</strong> " . number_format($row['car_price_per_day'], 2) . "€</p>";
    
    echo "<h3 class='mt-4 font-semibold'>Extras:</h3>";
    if (!empty($extras_arr)) {
      echo "<ul class='list-disc pl-5'>";
      foreach ($extras_arr as $ex) {
        echo "<li>"
        . htmlspecialchars($ex['name'])
        . " x{$ex['quantity']} ("
        . number_format($ex['unit_price'], 2) . "€/unit) = "
        . number_format($ex['unit_price'] * $ex['quantity'], 2) . "€"
        . "</li>";
      }
      echo "</ul>";
      
      echo "<p class='text-xl'><strong>Total Price:</strong> " . number_format($row['rs_total_price'], 2) . "€</p>";
    } else {
      echo "<p>No extras selected.</p>";
    }

    echo "</div>";
  } else {
    echo "<p class='text-red-600 text-center mt-4'>Reservation not available</p>";
  }
} else if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo "<p class='text-red-600 text-center mt-4'>Missing reservation data or user not logged in.</p>";
}

mysqli_close($conn);

include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>
