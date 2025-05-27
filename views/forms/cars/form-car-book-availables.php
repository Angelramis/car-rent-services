<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>
<?php

// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

// Si se ha pulsado el botón de submit, iniciar consulta.
if (isset($_POST['form-car-search'])) {

  // Variables
  $pickup_date = htmlspecialchars($_POST['pickup-date']);
  $pickup_time = htmlspecialchars($_POST['pickup-time']);
  $dropoff_date = htmlspecialchars($_POST['dropoff-date']);
  $dropoff_time = htmlspecialchars($_POST['dropoff-time']);
  
  // Filtrar coches que no estén dentro de fechas reservadas
  // confirmadas o por confirmar
  $sql_query = "SELECT *
                FROM cars
                WHERE car_id NOT IN (
                                      SELECT car_id
                                      FROM reservations
                                      WHERE ('$pickup_date' < rs_dropoff_date 
                                      AND '$dropoff_date' > rs_pickup_date)
                                      AND (rs_status = 'Confirmed' OR rs_status = 'Pending')
                                      );";

  // Ejecutar consulta SQL con BBDD
  $execute_query = mysqli_query($conn, $sql_query);

  $cars = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);

?>
  <div class="grid grid-cols-1 w-full m-2 gap-3">

    <?php
    foreach ($cars as $car) {
    ?>
      <div class="flex flex-col items-center justify-center w-full bg-white text-left rounded-md shadow p-2 md:grid md:grid-cols-4 md:gap-2">
        <img src="<?php echo $car['car_image']; ?>" class="w-full max-w-[350px] h-full md:object-contain md:h-36">
        <div class="p-2 mb-3 mt-2 w-full border-black flex flex-col justify-between md:bg-white md:border-none md:mb-0 md:mt-0 md:rounded-none">
          <div class="w-full">
            <p class="text-xl"><?php echo $car['car_brand'] . " " . $car['car_model']; ?></p>
            <p class="text-xl font-bold"><?php echo $car['car_price_per_day']; ?>€/<?= __('day', $lang);?></p>
          </div>
        </div>
        <div class="p-2 mb-3 mt-2 w-full border-black flex flex-col justify-between md:bg-white md:border-none md:mb-0 md:mt-0 md:rounded-none">
          <div class="flex flex-row gap-1">
            <img src="/car-rent-services/assets/icons/car-seats.png" class="w-6 h-6" alt="Car seats">
            <p><?php echo $car['car_seats']; ?> <?= __('seats', $lang);?></p>
          </div>

          <div class="flex flex-row gap-1">
            <?php if ($car['car_fuel'] == "Diesel" || $car['car_fuel'] == "Gasoline") {
            ?>
              <img src="/car-rent-services/assets/icons/gas-fuel.png" class="w-6 h-6" alt="Car gas fuel">
            <?php } elseif ($car['car_fuel'] == "Hybrid") {
            ?>
              <img src="/car-rent-services/assets/icons/hybrid-fuel.png" class="w-6 h-6" alt="Car hybrid fuel">
            <?php } else {
            ?>
              <img src="/car-rent-services/assets/icons/electric-fuel.png" class="w-6 h-6" alt="Car electric">
            <?php
            } ?>
            <p><?= __($car['car_fuel'], $lang); ?></p>
          </div>
        
        <div class="flex flex-row gap-1">
          <img src="/car-rent-services/assets/icons/car-mileage.png" class="w-6 h-6" alt="Car seats">
          <p><?= __('Mileage', $lang);?>: <?php if ($car['car_unlimited_mileage'] == 1) {
                         echo __('Unlimited', $lang);
                      } else {
                         echo __('Limited', $lang);
                      }; ?>
          </p>
        </div>
        </div>



      <!-- Formulario para ver detalles coche -->
      <form method="POST" class="w-full" action="/car-rent-services/views/forms/cars/form-car-details.php">
        <input type="hidden" name="car-id" value="<?php echo $car['car_id']; ?>">
        <input type="hidden" name="pickup-date" value="<?php echo $pickup_date; ?>">
        <input type="hidden" name="pickup-time" value="<?php echo $pickup_time; ?>">
        <input type="hidden" name="dropoff-date" value="<?php echo $dropoff_date; ?>">
        <input type="hidden" name="dropoff-time" value="<?php echo $dropoff_time; ?>">
        <input type="submit" value="<?php echo number_format($car['car_price_per_day'] * dateDiff($pickup_date, $dropoff_date), 2) . '€'; ?>" name="form-car-details" class="bg-blue-500 text-white font-semibold min-h-12 py-2 px-4 rounded-md w-full hover:bg-blue-600 transition text-center block">
      </form>
  </div>
<?php
    }
    if (count($cars) == 0) {
      ?>
        <p><?= __('There are no cars available at the moment. Please try again later', $lang);?>.</p>
      <?php
    }
  }
  mysqli_close($conn);
?>
</div>


<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>