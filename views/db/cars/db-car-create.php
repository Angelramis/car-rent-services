<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>
<div class="flex flex-col justify-center w-auto min-w-[400px] h-auto min-h-[200px] bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

  $ruta_absoluta = '/car-rent-services/assets/images/cars/';

  // Verificar si los datos del formulario se han enviado
  if (isset($_POST['form-car-create'])) {

    // -- Gestión imagen --
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
    
    // -- FIN gestión imagen --

    
    // Obtener los valores del formulario y sanitizarlos
    $car_brand = htmlspecialchars($_POST['car-brand']);
    $car_model = htmlspecialchars($_POST['car-model']);
    $car_plate = htmlspecialchars($_POST['car-plate']);
    $car_price_per_day = htmlspecialchars($_POST['car-price-per-day']);
    $car_doors = htmlspecialchars($_POST['car-doors']);
    $car_seats = htmlspecialchars($_POST['car-seats']);
    $car_space_bags = htmlspecialchars($_POST['car-space-bags']);
    $car_fuel = htmlspecialchars($_POST['car-fuel']);
    $car_unlimited_mileage = isset($_POST['car-unlimited-mileage']) ? 1 : 0; // 1 si está marcado, 0 si no
    $car_free_cancellation = isset($_POST['car-free-cancellation']) ? 1 : 0;
    $car_min_age = htmlspecialchars($_POST['car-min-age']);
    $car_active = isset($_POST['car-active']) ? 1 : 0; // 1 si está marcado, 0 si no

    $sql_insert = "INSERT INTO cars (
      car_brand,
      car_model,
      car_plate,
      car_price_per_day,
      car_doors,
      car_seats,
      car_space_bags,
      car_fuel,
      car_unlimited_mileage,
      car_free_cancellation,
      car_min_age,
      car_image,
      car_active
  ) VALUES (
      '$car_brand',
      '$car_model',
      '$car_plate',
      '$car_price_per_day',
      '$car_doors',
      '$car_seats',
      '$car_space_bags',
      '$car_fuel',
      '$car_unlimited_mileage',
      '$car_free_cancellation',
      '$car_min_age',
      '$ruta_final_subir',
      '$car_active'
  )";


    // Ejecutar la consulta
    if (mysqli_query($conn, $sql_insert)) {
  ?>
      <div class="flex flex-col items-center">
        <p>Successfully created</p>
        <form action="/car-rent-services/views/forms/cars/form-car-admin.php" method="POST">
          <input type="submit" value="Back" name="form-car-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
        </form>
      </div>
  <?php
    } else {
      // Si la actualización falla, mostrar mensaje error
      echo "<p>Error updating car information: " . mysqli_error($conn) . "</p>";
    }
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
  ?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>