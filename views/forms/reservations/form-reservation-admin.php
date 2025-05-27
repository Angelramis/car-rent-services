<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>

<h1 class='text-center text-2xl p-3'>Reservations</h1>

<?php //Admin models
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/admin-models.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

  if (isset($_POST['form-reservation-admin'])) {
    $sql_reservations = "SELECT * 
                        FROM reservations_view;";

    $execute_query = pg_query($conn, $sql_reservations);
    $reservations = pg_fetch_all($execute_query);
  ?>
    <nav class="w-full mb-2">
      <form action="" method="GET">
        <nav class="flex flex-row gap-2 items-center">
          <img src="/assets/icons/search.png" alt="search" class="w-7 h-7">
          <input type="text" id="buscador" name="buscador" placeholder="Number, NIF or fullname..." class="w-48 h-8 p-2 rounded-md shadow
          focus:ring-blue-500 focus:border-blue-500">
        </nav>
      </form>
    </nav>

    <div class="w-full grid grid-cols-9 bg-gray-300 rounded-md items-center p-1">
      <p>Number</p>
      <p>User NIF</p>
      <p>User Fullname</p>
      <p>Car Plate</p>
      <p>Pickup</p>
      <p>Dropoff</p>
      <p>Status</p>
      <p>Creation</p>
      <p>Total price</p>
    </div>
    <div id="resultados" class="w-full flex flex-col">
      <?php
      foreach ($reservations as $rs) {
      ?>
        <form action="/views/forms/reservations/form-reservation-edit.php" method="POST" onclick="this.submit()" class="w-full grid grid-cols-9 items-center gap-2 rounded-md shadow px-2 py-4 transition hover:cursor-pointer hover:bg-blue-300">
          <input type="hidden" name="rs_number" value="<?php echo $rs['rs_number']; ?>">
          <p><?php echo $rs['rs_number']; ?></p>
          <p><?php echo $rs['user_nif']; ?></p>
          <p><?php echo $rs['user_fullname']; ?></p>
          <p><?php echo $rs['car_plate']; ?></p>
          <p><?php echo $rs['rs_pickup_date'] . " - " . $rs['rs_pickup_time']; ?>h</p>
          <p><?php echo $rs['rs_dropoff_date'] . " - " . $rs['rs_dropoff_time']; ?>h</p>
          <p><?php echo $rs['rs_status']; ?></p>
          <p><?php echo $rs['rs_created_at']; ?></p>
          <p><?php echo $rs['rs_total_price']; ?></p>
          <img src="/assets/icons/edit.png" alt="Edit" class="w-7">
        </form>
      <?php
      }
      ?>
    </div>
  <?php
  }


  pg_close($conn);
  ?>

</div>
<script>
  // Gestión AJAX buscador
  document.addEventListener("DOMContentLoaded", function() {
    const buscador = document.getElementById("buscador");
    const resultadosContainer = document.getElementById("resultados");

    buscador.addEventListener("input", function() {
      const search = buscador.value;

      resultadosContainer.innerHTML = "";

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "/views/db/reservations/db-reservation-search-ajax.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onload = function() {
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
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>