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
    <h1 class="text-center text-2xl p-2">Delete user</h1>

    <!-- Insert form. Every column name of the BBDD table-->
    <form action="/car-rent-services/views/db/users/db_user_delete.php" method="POST">
      
      <label>User id</label>
      <input type="number" name="user_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required> 

      <input type="submit" value="Submit" name="form_user_delete" class="button_action">
    </form>
  </div>
</main>




<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>