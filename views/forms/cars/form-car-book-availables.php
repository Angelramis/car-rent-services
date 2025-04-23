<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>


<h1 class="text-2xl font-medium">Available cars</h1>

<div class="div_content_available">
  <?php

  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón de submit, iniciar consulta.
  if (isset($_POST['form-car-search'])) {

    // Variables
    $pickup_date = htmlspecialchars($_POST['pickup-date']);
    $pickup_date = htmlspecialchars($_POST['pickup-time']);
    $dropoff_date = htmlspecialchars($_POST['dropoff-date']);
    $dropoff_time = htmlspecialchars($_POST['dropoff-time']);

    // Seleccionar las permisas dentro de la disponibilidad introducida en fechas y en estado disponible.
    // haciendo un join con tabla premise_categories para obtener el nombre de la categoría.
    // Mostrandose en orden aleatorio.
    $sql_query = "SELECT *
                  FROM cars;";

    // Ejecutar consulta SQL con BBDD
    $result_query = mysqli_query($conn, $sql_query);

    // Mostrar resultados, obteniendo e imprimiendo cada fila existente.
    while ($row = mysqli_fetch_assoc($result_query)) {
  ?>
      <div class="product_div">
        <img src="/car-rent-services/assets/images/cars/test.jpg" class="photo_preview">
        <div class="info_preview">
          <!-- <p>Category: <?php echo $row['premise_category_name']; ?> </p> -->
          <p><?php echo $row['car_brand']; ?></p>
        </div>
        <!-- Formulario para ver detalles coche -->
        <form method="POST" action="/car-rent-services/views/forms/cars/form-car-details.php">
          <input type="hidden" name="premise_id" value="<?php echo $row['car_id']; ?>">
          <input type="hidden" name="pickup-date" value="<?php echo $pickup_date; ?>">
          <input type="hidden" name="pickup-time" value="<?php echo $pickup_time; ?>">
          <input type="hidden" name="dropoff-date" value="<?php echo $dropoff_date; ?>">
          <input type="hidden" name="dropoff-time" value="<?php echo $dropoff_time; ?>">
          <input type="submit" value="Book" name="form-car-details" class="button_action">
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