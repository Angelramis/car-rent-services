<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

if (isset($_POST['car_id'])) {
  $car_id = htmlspecialchars($_POST['car_id']);

  $sql_car = "SELECT *
              FROM cars
              WHERE car_id = '$car_id';";

  $execute_query = mysqli_query($conn, $sql_car);

  $car = mysqli_fetch_assoc($execute_query);

  if ($execute_query) {
    ?>
    <form action="/car-rent-services/views/db/cars/db-car-update.php" class="">
      <label for="car-model">Brand</label>
      <input type="text" name="car-brand" value="<?php echo $car['car_brand']; ?>">

      <label for="car-model">Model</label>
      <input type="text" name="car-model" value="<?php echo $car['car_model']; ?>">
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
