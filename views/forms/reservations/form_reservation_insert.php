<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>

<main>
  <div class="div_border">
  <h1 class="text-center text-2xl p-2">Insert reservation</h1>

    <form action="/student073/dwes/views/db/reservations/db_reservation_insert.php" method="POST">

      <label>User ID</label>
      <input type="number" name="user_id" class="standard_input" required>

      <label>Premise ID</label>
      <input type="number" name="premise_id" class="standard_input" required>

      <label>Date in</label>
      <input type="date" name="date_in" class="standard_input" required>

      <label>Date out</label>
      <input type="date" name="date_out" class="standard_input" required>

      <input type="submit" value="Submit" name="form_reservation_insert" class="button_action">
    </form>

  </div>
</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>