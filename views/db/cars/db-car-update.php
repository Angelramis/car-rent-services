<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>
<div class="flex flex-col justify-center w-auto min-w-[400px] h-auto min-h-[200px] bg-white rounded-xl shadow-lg p-6">

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';


// Verificar si los datos del formulario se han enviado
if (isset($_POST['form-car-update'])) {

    // Obtener los valores del formulario
    $car_id = htmlspecialchars($_POST['car-id']);
    $car_brand = htmlspecialchars($_POST['car-brand']);
    $car_model = htmlspecialchars($_POST['car-model']);
    $car_plate = htmlspecialchars($_POST['car-plate']);
    $car_price_per_day = htmlspecialchars($_POST['car-price-per-day']);
    $car_doors = htmlspecialchars($_POST['car-doors']);
    $car_seats = htmlspecialchars($_POST['car-seats']);
    $car_space_bags = htmlspecialchars($_POST['car-space-bags']);
    $car_fuel = htmlspecialchars($_POST['car-fuel']);
    $car_unlimited_mileage = isset($_POST['car-unlimited-mileage']) ? 'TRUE' : 'FALSE';
    $car_free_cancellation = isset($_POST['car-free-cancellation']) ? 'TRUE' : 'FALSE';
    $car_min_age = htmlspecialchars($_POST['car-min-age']);
    $car_active = isset($_POST['car-active']) ? 'TRUE' : 'FALSE';


    // -- Gestión imagen --

    // Si se ha subido una imagen, iniciar gestión
    $car_image_sql = ""; // si no hay imagen en la consulta no hacer update
    if (!empty($_FILES['car-image']['name'])) {
      $ruta_absoluta = '/assets/images/cars/';
      $nombre_img = basename($_FILES['car-image']['name']);
      $hoy = date('Ymd_His');
  
      // Limpiar espacios, caracteres especiales y concatenar fecha de hoy al nombre imagen
      $nombre_img = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $nombre_img);
      $extension = pathinfo($nombre_img, PATHINFO_EXTENSION);
      $nombre_img = pathinfo($nombre_img, PATHINFO_FILENAME) . '_' . $hoy . '.' . $extension;
  
      // Ruta para subir a la BBDD
      $ruta_final_subir = $ruta_absoluta . $nombre_img;
  
      // Copiar imagen subida al proyecto
      if (!move_uploaded_file($_FILES['car-image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $ruta_absoluta . $nombre_img)) {
        echo "<p style='color:red'>Error uploading image</p>";
        exit;
      }
      $car_image_sql = "car_image = '$ruta_final_subir',";
    }
      // FIN gestión imagen --



    // Preparar la consulta de actualización
    $sql_update = "UPDATE cars SET
                    car_brand = '$car_brand',
                    car_model = '$car_model',
                    car_plate = '$car_plate',
                    car_price_per_day = '$car_price_per_day',
                    car_doors = '$car_doors',
                    car_seats = '$car_seats',
                    car_space_bags = '$car_space_bags',
                    car_fuel = '$car_fuel',
                    car_unlimited_mileage = $car_unlimited_mileage,
                    car_free_cancellation = $car_free_cancellation,
                    car_min_age = '$car_min_age'," . 
                    ($car_image_sql ? "$car_image_sql" : "") .
                    "car_active = $car_active
                  WHERE car_id = '$car_id'";

    // Ejecutar la consulta
    if (pg_query($conn, $sql_update)) {
        ?>
        <div class="flex flex-col items-center">
          <p>Successfully updated</p>
          <form action="/views/forms/cars/form-car-admin.php" method="POST">
          <input type="submit" value="Back" name="form-car-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
        </form>
        </div>
      <?php
    } else {
        // Si la actualización falla, mostrar mensaje error
        echo "<p>Error updating car information: " . pg_last_error($conn) . "</p>";
    }
}

// Cerrar la conexión a la base de datos
pg_close($conn);
?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>