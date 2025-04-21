<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<main>

  <div class="div_border widther">
    <h1 class="text-center text-2xl">Log in</h1>
    <form class="flex flex-col text-center p-5" action="/student073/dwes/views/db/users/db_user_login.php" method="POST">
      
      <label>Email</label>
      <input type="text" name="user_email" class="standard_input">

      <label>Password</label>
      <input type="password" name="user_pwd" class="standard_input">

      <input type="submit" value="Submit" name="form_user_login" class="button_action">
    </form>
    <p>Don't have an account? <a href="/student073/dwes/views/forms/users/form_user_register.php" class="text-yellow-600 hover:text-yellow-200 cursor-pointer">Register here.</a></p>
  </div>

</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>