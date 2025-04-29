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
    <h1 class="text-center text-2xl p-2">Insert user</h1>

    <form action="/car-rent-services/views/db/users/db_user_insert.php" method="POST">
      
      <label>Email</label>
      <input type="email" name="user_email" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>
      
      <label>Password</label>
      <input type="text" name="user_pwd" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>User roles</label>
      <select name="user_roles" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500">
        <option value="user">User</option>
        <option value="admin">Admin</option>
        <option value="employee">Employee</option>
      </select>

      <label>Firstname</label>
      <input type="text" name="user_firstname" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Lastname</label>
      <input type="text" name="user_lastname" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>NIF</label>
      <input type="text" name="user_nif" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Phone</label>
      <input type="text" name="user_phone" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>
    
      <label>Address</label>
      <input type="text" name="user_address" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Country</label>
      <input type="text" name="user_country" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <input type="submit" value="Submit" name="form_user_insert" class="button_action">
    </form>

  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>