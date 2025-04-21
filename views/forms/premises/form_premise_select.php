<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>

<main>
  <div class="div_border">
  <h1 class="text-center text-2xl p-2">Premises</h1>
  <form action="/student073/dwes/views/db/premises/db_premise_select.php" method="POST">
    <input type="submit" value="Submit" name="form_premise_select" class="px-14 py-3 rounded-md shadow-md bg-yellow-300 hover:bg-yellow-200 cursor-pointer">
  </form>

  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>