<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /car-rent-services/index.php");
    exit();
  }
?>

<main>
  <div class="div_border">
  <h1 class="text-center text-2xl p-2">Insert reservation</h1>

    <form action="/car-rent-services/views/db/reservations/db_reservation_insert.php" method="POST">

      <label>User ID</label>
      <input type="number" name="user_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Premise ID</label>
      <input type="number" name="premise_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Date in</label>
      <input type="date" name="date_in" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Date out</label>
      <input type="date" name="date_out" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <input type="submit" value="Submit" name="form_reservation_insert" class="button_action">
    </form>

  </div>
</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>