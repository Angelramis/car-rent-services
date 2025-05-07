<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<h1 class='text-center text-2xl p-3'>Users</h1>

<?php //Admin models
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/admin-models.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';
  // Mostrar coches en bbdd

  if (isset($_POST['form-user-admin'])) {
    $sql_users = "SELECT * 
                  FROM users;";


    $execute_query = mysqli_query($conn, $sql_users);
    $users = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
  ?>
    <nav class="w-full mb-2">
      <form action="" method="GET">
        <nav class="flex flex-row gap-2 items-center">
          <img src="/car-rent-services/assets/icons/search.png" alt="search" class="w-7 h-7">
          <input type="text" id="buscador" name="buscador" placeholder="NIF or Firstname..." class="w-48 h-8 p-2 rounded-md shadow
          focus:ring-blue-500 focus:border-blue-500">
        </nav>
      </form>
    </nav>

    <div class="w-full grid grid-cols-8 bg-gray-300 rounded-md items-center p-1">
      <p>Roles</p>
      <p>NIF</p>
      <p>Firstname</p>
      <p>Lastname</p>
      <p>Phone</p>
      <p>Birthdate</p>
      <p>License</p>
    </div>
    <div id="resultados" class="w-full flex flex-col">
      <?php
      foreach ($users as $user) {
      ?>
        <form action="/car-rent-services/views/forms/users/form-user-edit.php" method="POST" onclick="this.submit()" class="w-full grid grid-cols-8 items-center gap-2 rounded-md shadow px-2 py-4 transition hover:cursor-pointer hover:bg-blue-300">
          <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
          <p><?php echo $user['user_roles']; ?></p>
          <p><?php echo $user['user_nif']; ?></p>
          <p><?php echo $user['user_firstname']; ?></p>
          <p><?php echo $user['user_lastname']; ?></p>
          <p><?php echo $user['user_phone']; ?></p>
          <p><?php echo $user['user_birthdate']; ?></p>
          <p><?php echo $user['user_license_number']; ?></p>
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
  document.addEventListener("DOMContentLoaded", function() {
    const buscador = document.getElementById("buscador");
    const resultadosContainer = document.getElementById("resultados");

    buscador.addEventListener("input", function() {
      const search = buscador.value;

      resultadosContainer.innerHTML = "";

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "/car-rent-services/views/db/users/db-user-search-ajax.php", true);
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
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>