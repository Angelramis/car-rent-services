<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>
<h1 class='text-center text-2xl p-3'>Editing reservation</h1>

<?php //Admin models
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/admin-models.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

  if (isset($_POST['rs_number'])) {
    $rs_number = htmlspecialchars($_POST['rs_number']);

    $sql_rs = "SELECT *
              FROM reservations_view
              WHERE rs_number = '$rs_number';";

    $execute_query = mysqli_query($conn, $sql_rs);

    $rs = mysqli_fetch_assoc($execute_query);

    if ($execute_query) {
  ?>
      <nav class="flex flex-row-reverse gap-2 items-center">
        <form action="/car-rent-services/views/db/reservations/db-reservation-delete.php" method="POST" name="db-reservation-delete">
          <input type="hidden" name="rs-number" value="<?php echo $rs['rs_number']; ?>">
          <input type="submit" value="Delete" name="db-reservation-delete" class="mt-2 bg-red-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-red-300 hover:cursor-pointer transition text-center block">
        </form>
        <form action="/car-rent-services/views/forms/reservations/form-reservation-admin.php" method="POST">
          <input type="submit" value="Cancel" name="form-reservation-admin" class="mt-2 bg-gray-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-gray-300 hover:cursor-pointer transition text-center block">
        </form>
      </nav>

      <form class="w-full" action="/car-rent-services/views/db/reservations/db-reservation-update.php" method="POST">
        <div class="w-full grid grid-cols-2 gap-2">

          <nav class="flex flex-col gap-1 p-2">
            <label for="rs-number">Reservation Number</label>
            <input type="text" id="rs-number" name="rs-number" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['rs_number']; ?>" readonly>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-nif">User NIF</label>
            <input type="text" id="user-nif" name="user-nif" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['user_nif']; ?>" readonly>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-plate">Car Plate</label>
            <input type="text" id="car-plate" name="car-plate" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['car_plate']; ?>" readonly>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="pickup">Pickup date and time</label>
            <input type="text" id="pickup" name="pickup" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['rs_pickup_date'] . ' - ' . $rs['rs_pickup_time'] . 'h'; ?>" readonly>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="dropoff">Dropoff date and time</label>
            <input type="text" id="dropoff" name="dropoff" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['rs_dropoff_date'] . ' - ' . $rs['rs_dropoff_time'] . 'h'; ?>" readonly>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="rs-status">Status</label>
            <?php if ($rs['rs_status'] === 'Confirmed'): ?>
              <select id="rs-status" name="rs-status" class="bg-gray-200 rounded-md border-[1px] p-1">
                <option value="Confirmed" selected>Confirmed</option>
                <option value="Cancelled">Cancelled</option>
              </select>
            <?php else: ?>
              <input type="text" id="rs-status" name="rs-status" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['rs_status']; ?>" readonly>
            <?php endif; ?>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="rs-created">Creation date</label>
            <input type="text" id="rs-created" name="rs-created" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['rs_created_at']; ?>" readonly>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="rs-total-price">Total Price (€)</label>
            <input type="text" id="rs-total-price" name="rs-total-price" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $rs['rs_total_price']; ?>" readonly>
          </nav>
        </div>
        <nav class="flex flex-row justify-between">
          <nav class="flex flex-row gap-2">
            <input type="submit" value="Save" name="db-reservation-update" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-600 hover:cursor-pointer transition text-center block">
          </nav>
        </nav>
      </form>


  <?php
    }
  }

  mysqli_close($conn);
  ?>

</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>