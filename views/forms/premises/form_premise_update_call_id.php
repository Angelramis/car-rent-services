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
    <h1 class="text-center text-2xl p-2">Update premise</h1>
    <form action="/car-rent-services/views/forms/premises/form_premise_update.php" method="POST">
      
      <label>Premise id</label>
      <input type="number" name="premise_id" class="standard_input" required> 

      <input type="submit" value="Submit" name="form_premise_update_call_id" class="button_action">
    </form>
  </div>

</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>