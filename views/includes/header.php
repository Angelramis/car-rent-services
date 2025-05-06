<?php
  session_start();
  $session_user_id = $_SESSION['user_id'] ?? 'guest';
  $session_user_firstname = $_SESSION['user_firstname'] ?? 'User';
  $session_user_roles = $_SESSION['user_roles'] ?? 'None';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Rent Services</title>

    <link rel="stylesheet" href="/car-rent-services/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/car-rent-services/src/output.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <div class="logo_contanier_header">
        <a href="/car-rent-services/index.php" class="flex text-white font-bold">
          CarRent<p class="hidden text-white font-bold sm:flex">Services</p>
        </a>
      </div>

      <nav class="right_header">
        <a href="/car-rent-services/views/user-reservations.php" class ="a-manuals-display-icon flex p-1 transition rounded-lg hover:bg-yellow-400 cursor-pointer">
          <img src="/car-rent-services/assets/icons/reservation-white.png" alt="display-icon">
          <p class="text-white">Reservations</p>
        </a>

        <?php if (strstr($session_user_roles, 'admin')) {
          // Si dentro de los roles del usuario contiene admin, mostrar html.
          ?>
            <form action="/car-rent-services/views/forms/cars/form-car-admin.php" method="POST" class="a-admin-icon flex p-1 transition rounded-lg hover:bg-yellow-400 cursor-pointer"">
              <img src="/car-rent-services/assets/icons/admin-icon.png" alt="manual-icon">
              <input type="submit" class="text-white" value="Admin" name="form-car-admin">
            </form>
          
            <a class ="a-manuals-display-icon flex p-1 transition rounded-lg hover:bg-yellow-400 cursor-pointer" onclick="displayPagesMenu('nav_bar_manuals')">
              <img src="/car-rent-services/assets/icons/manual.png" alt="display-icon">
              <p class="text-white">Manuals</p>
            </a>

            <nav class="nav-bar-manuals" id="nav_bar_manuals">
              <a href="/car-rent-services/views/manuals/manual-installation.php" class="text-white transition rounded-lg p-1 hover:bg-yellow-400 cursor-pointer">Installation manual</a>
              <a href="/car-rent-services/views/manuals/manual-user.php" class="text-white transition rounded-lg p-1 hover:bg-yellow-400 cursor-pointer">User manual</a>
            </nav>
          <?php
          } ?>

      <a class="a-menu-icon transition rounded-lg hover:bg-yellow-400 cursor-pointer" onclick="displayPagesMenu('pages_nav_bar')">
        <img src="/car-rent-services/assets/icons/menu.png" alt="menu-icon">
      </a>

        <a class ="a-account-icon flex p-1 transition rounded-lg hover:bg-yellow-400 cursor-pointer" onclick="displayPagesMenu('nav_bar_account')">
          <img src="/car-rent-services/assets/icons/account.png" alt="account-icon">
          <p class="text-white"><?php echo $_SESSION['user_firstname'] ?? 'Account'; ?></p>
        </a>

        <nav class="nav_bar_account" id="nav_bar_account">

          <?php if ($session_user_id == 'guest') {
            // Si el usuario no ha iniciado sesión, mostrar html de log in.
            ?>
              <a href="/car-rent-services/views/forms/users/form-user-login.php" class="text-white">Log in</a>
              <a href="/car-rent-services/views/forms/users/form-user-register.php" class="text-white">Register</a>
          <?php
          } ?>

          <?php if ($session_user_id != 'guest') {
            // Si el usuario ha iniciado sesión, mostrar html de log out.
            ?>
              <a href="/car-rent-services/views/db/users/db_user_logout.php" class="text-white transition rounded-lg p-1 hover:bg-yellow-400 cursor-pointer">Log out</a>
          <?php
          } ?>

        </nav>
      </nav>
    </header>
    <main class="gap-2 min-h-screen">