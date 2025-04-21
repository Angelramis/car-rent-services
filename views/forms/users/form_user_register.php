<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<main>
  <div class="div_border widther">
    <h1 class="text-center text-2xl">Register</h1>
    <form class="flex flex-col text-center p-5" action="/student073/dwes/views/db/users/db_user_register.php" method="POST">
      
      <label>Email</label>
      <input type="text" name="user_email" class="standard_input" value="<?php echo isset($_COOKIE['user_email']) ? htmlspecialchars($_COOKIE['user_email']) : ''; ?>">

      <label>NIF</label>
      <input type="text" name="user_nif" class="standard_input" value="<?php echo isset($_COOKIE['user_nif']) ? htmlspecialchars($_COOKIE['user_nif']) : ''; ?>">

      <label>Name</label>
      <input type="text" name="user_firstname" class="standard_input" value="<?php echo isset($_COOKIE['user_firstname']) ? htmlspecialchars($_COOKIE['user_firstname']) : ''; ?>">

      <label>Last name</label>
      <input type="text" name="user_lastname" class="standard_input" value="<?php echo isset($_COOKIE['user_lastname']) ? htmlspecialchars($_COOKIE['user_lastname']) : ''; ?>">

      <label>Phone</label>
      <input type="text" name="user_phone" class="standard_input" value="<?php echo isset($_COOKIE['user_phone']) ? htmlspecialchars($_COOKIE['user_phone']) : ''; ?>">

      <label>Address</label>
      <input type="text" name="user_address" class="standard_input" value="<?php echo isset($_COOKIE['user_address']) ? htmlspecialchars($_COOKIE['user_address']) : ''; ?>">

      <label>Country</label>
      <input type="text" name="user_country" class="standard_input" value="<?php echo isset($_COOKIE['user_country']) ? htmlspecialchars($_COOKIE['user_country']) : ''; ?>">

      <label>Password</label>
      <input type="password" name="user_pwd" class="standard_input" value="<?php echo isset($_COOKIE['user_pwd']) ? htmlspecialchars($_COOKIE['user_pwd']) : ''; ?>">

      <label>Repeat password</label>
      <input type="password" name="user_pwd_repeated" class="standard_input" value="<?php echo isset($_COOKIE['user_pwd_repeated']) ? htmlspecialchars($_COOKIE['user_pwd_repeated']) : ''; ?>">
      
      <input type="submit" value="Submit" name="form_user_register" class="button_action">
    </form>
  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>