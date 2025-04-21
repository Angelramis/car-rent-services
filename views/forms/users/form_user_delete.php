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
    <h1 class="text-center text-2xl p-2">Delete user</h1>

    <!-- Insert form. Every column name of the BBDD table-->
    <form action="/student073/dwes/views/db/users/db_user_delete.php" method="POST">
      
      <label>User id</label>
      <input type="number" name="user_id" class="standard_input" required> 

      <input type="submit" value="Submit" name="form_user_delete" class="button_action">
    </form>
  </div>
</main>




<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>