<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>
<div class="flex flex-col justify-center w-auto min-w-[400px] h-auto min-h-[200px] bg-white rounded-xl shadow-lg p-6">

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

if (isset($_POST['form-car-delete'])) {
    $car_id = htmlspecialchars($_POST['car-id']);

    try {
        // 1. Obtener la ruta de la imagen del coche
        $query_image = "SELECT car_image 
                        FROM cars 
                        WHERE car_id = '$car_id';";

        $result_image = pg_query($conn, $query_image);

        if ($result_image && pg_num_rows($result_image) > 0) {
            $car = pg_fetch_assoc($result_image);
            $car_image_path = $car['car_image'];

            // 2. Eliminar la imagen si existe
            if (!empty($car_image_path)) {
                $absolute_path = $_SERVER['DOCUMENT_ROOT'] . $car_image_path;
                if (file_exists($absolute_path)) {
                    unlink($absolute_path);
                }
            }
        }

        // 3. Eliminar el coche de la base de datos
        $sql = "DELETE FROM cars 
                WHERE car_id = '$car_id';";
                
        pg_query($conn, $sql);
        ?>
        <div class="flex flex-col items-center">
          <p>Successfully deleted</p>
          <form action="/views/forms/cars/form-car-admin.php" method="POST">
            <input type="submit" value="Back" name="form-car-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
          </form>
        </div>
        <?php
    } catch (Exception $e) {
        ?>
        <div class="flex flex-col items-center">
          <p>Error: You can't delete a car registered in reservations.</p>
          <form action="/views/forms/cars/form-car-admin.php" method="POST">
            <input type="submit" value="Back" name="form-car-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
          </form>
        </div>
        <?php
    }
}


pg_close($conn);
?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>
