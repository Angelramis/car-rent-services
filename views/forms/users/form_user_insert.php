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
    <h1 class="text-center text-2xl p-2">Insert user</h1>

    <form action="/student073/dwes/views/db/users/db_user_insert.php" method="POST">
      
      <label>Email</label>
      <input type="email" name="user_email" class="standard_input" required>
      
      <label>Password</label>
      <input type="text" name="user_pwd" class="standard_input" required>

      <label>User roles</label>
      <select name="user_roles" class="standard_input">
        <option value="user">User</option>
        <option value="admin">Admin</option>
        <option value="employee">Employee</option>
      </select>

      <label>Firstname</label>
      <input type="text" name="user_firstname" class="standard_input" required>

      <label>Lastname</label>
      <input type="text" name="user_lastname" class="standard_input" required>

      <label>NIF</label>
      <input type="text" name="user_nif" class="standard_input" required>

      <label>Phone</label>
      <input type="text" name="user_phone" class="standard_input" required>
    
      <label>Address</label>
      <input type="text" name="user_address" class="standard_input" required>

      <label>Country</label>
      <input type="text" name="user_country" class="standard_input" required>

      <input type="submit" value="Submit" name="form_user_insert" class="button_action">
    </form>

  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>