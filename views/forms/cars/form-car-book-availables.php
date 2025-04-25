<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>


<h1 class="text-2xl font-medium">Available cars</h1>

<div class="grid grid-cols-1 m-2 gap-3">
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

    // Seleccionar las permisas dentro de la disponibilidad introducida en fechas y en estado disponible.
    // haciendo un join con tabla premise_categories para obtener el nombre de la categoría.
    // Mostrandose en orden aleatorio.
    $sql_query = "SELECT *
                  FROM cars;";

    // Ejecutar consulta SQL con BBDD
    $execute_query = mysqli_query($conn, $sql_query);

    $cars = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);

    // Mostrar resultados, obteniendo e imprimiendo cada fila existente.
    foreach ($cars as $car) {
  ?>
      <div class="bg-white md:border md:border-gray-300 md:rounded-lg md:shadow-md md:p-4 md:mt-2 md:max-w md:grid md:grid-cols-4 md:gap-2">
        <img src="/car-rent-services/assets/images/cars/test.webp" class="w-44 shadow-md">
        <div class="p-2 mb-3 mt-2  border-black flex flex-col justify-between md:bg-white md:border-none md:mb-0 md:mt-0 md:rounded-none">
          <p><?php echo $car['car_brand'] . " " . $car['car_model']; ?></p>
          <p><?php echo $car['car_price_per_day']; ?>€/day</p>
          <p><?php echo $car['car_seats']; ?> seats</p>
          <p><?php echo $car['car_fuel']; ?></p>
          <p>Mileage: <?php if ($car['car_unlimited_mileage'] == 1) {echo "Unlimited";}else{"Limited";}; ?></p>
        </div>

        <!-- Formulario para ver detalles coche -->
        <form method="POST" action="/car-rent-services/views/forms/cars/form-car-details.php">
          <input type="hidden" name="car-id" value="<?php echo $car['car_id']; ?>">
          <input type="hidden" name="pickup-date" value="<?php echo $pickup_date; ?>">
          <input type="hidden" name="pickup-time" value="<?php echo $pickup_time; ?>">
          <input type="hidden" name="dropoff-date" value="<?php echo $dropoff_date; ?>">
          <input type="hidden" name="dropoff-time" value="<?php echo $dropoff_time; ?>">
          <input type="submit" value="Book" name="form-car-details" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 px-4 rounded-md w-full hover:bg-blue-600 transition text-center block">
        </form>
      </div>
  <?php
    }
  }
  mysqli_close($conn);
  ?>
</div>


<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>