<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<h1 class='text-center text-2xl p-3'>Cars</h1>

<?php //Admin models
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/admin-models.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';
  // Mostrar coches en bbdd

  if (isset($_POST['form-car-admin']) || isset($_GET['car-search'])) {
    // Obtener término de búsqueda si existe
    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

    // Construir consulta con filtro si se ha buscado
    if (!empty($search)) {
        $sql_cars = "SELECT * FROM cars 
                     WHERE car_brand LIKE '%$search%' 
                        OR car_model LIKE '%$search%';";
    } else {
        $sql_cars = "SELECT * 
                      FROM cars;";
    }

    $execute_query = mysqli_query($conn, $sql_cars);
    $cars = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
  ?>
      <nav class="w-full mb-2 flex flex-row justify-between items-center">
        <form action="/car-rent-services/views/forms/cars/form-car-admin.php" method="GET">
          <nav class="flex flex-row gap-2 items-center">
            <img src="/car-rent-services/assets/icons/search.png" alt="search" class="w-7 h-7">
            <input type="text" id="buscador" name="user_nif" class="w-48 h-8 p-2 rounded-md shadow
          focus:ring-blue-500 focus:border-blue-500" placeholder="Model or brand...">
          </nav>
        </form>
        <form action="/car-rent-services/views/forms/cars/form-car-create.php" method="POST">
          <input type="submit" value="Create car" name="form-car-create" class="bg-blue-500 text-white font-semibold min-h-12 py-1 !px-8 rounded-md w-auto hover:bg-blue-600 transition text-center block">
        </form>
      </nav>

      <div class="w-full grid grid-cols-12 bg-gray-300 rounded-md items-center p-1">
        <p>Brand</p>
        <p>Model</p>
        <p>Price per day</p>
        <p>Doors</p>
        <p>Seats</p>
        <p>Bags space</p>
        <p>Fuel</p>
        <p>Unlimited mileage</p>
        <p>Free cancellation</p>
        <p>Min age</p>
        <p>Active</p>
      </div>
      <div id="resultados" class="w-full flex flex-col">
      <?php
      foreach ($cars as $car) {
      ?>
        <form id="resultados" action="/car-rent-services/views/forms/cars/form-car-edit.php" method="POST" onclick="this.submit()" class="w-full grid grid-cols-12 items-center gap-2 rounded-md shadow px-2 py-4 transition hover:cursor-pointer hover:bg-blue-300">
          <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">

          <p><?php echo $car['car_brand']; ?></p>
          <p><?php echo $car['car_model']; ?></p>
          <p><?php echo $car['car_price_per_day']; ?></p>
          <p><?php echo $car['car_doors']; ?></p>
          <p><?php echo $car['car_seats']; ?></p>
          <p><?php echo $car['car_space_bags']; ?></p>
          <p><?php echo $car['car_fuel']; ?></p>

          <p><?php echo $car['car_unlimited_mileage']; ?></p>
          <p><?php echo $car['car_free_cancellation']; ?></p>
          <p><?php echo $car['car_min_age']; ?></p>
          <p><?php echo $car['car_active']; ?></p>

          <img src="/car-rent-services/assets/icons/edit.png" alt="Edit" class="w-7">

        </form>

  <?php
      }
      ?>
       </div>
       <?php
    }
   

  mysqli_close($conn);
  ?>

</div>

<script>
  // Gestión AJAX buscador
  document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscador");
    const resultadosContainer = document.getElementById("resultados");

    buscador.addEventListener("input", function () {
      const search = buscador.value;

      resultadosContainer.innerHTML = "";

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "/car-rent-services/views/db/cars/db-car-search-ajax.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        if (xhr.status === 200) {
          resultadosContainer.innerHTML = xhr.responseText;
        } else {
          console.error("Error en la solicitud AJAX");
        }
      };

      xhr.send("search=" + encodeURIComponent(search));
    });
  });
</script>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>