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
    <title>Hotel Project</title>
  
    <link rel="stylesheet" href="/car-rent-services/public/output.css" rel="stylesheet">

  </head>

  <body>
    <header>
      <div class="logo_contanier_header">
        <a href="/student073/dwes/index.php" class="a-logo flex-shrink-0">
          <img src="/student073/dwes/assets/images/general/logo.png" alt="logo" class="h-8 w-auto">
        </a>
      </div>

      <nav class="pages_nav_bar" id="pages_nav_bar">
          <a href="/student073/dwes/index.php" class="text-white hover:text-yellow-200">Home</a> <!--Rutas absolutas dentro de documentos -->
          <a href="/student073/dwes/views/user_reservations.php" class="text-white hover:text-yellow-200">My reservations</a>
          <a href="/student073/dwes/views/services.php" class="text-white hover:text-yellow-200">Services</a>
          <a href="/student073/dwes/views/weather.php" class="text-white hover:text-yellow-200">Weather</a>
      </nav>

      <nav class="right_header">
        <?php if (strstr($session_user_roles, 'admin')) {
          // Si dentro de los roles del usuario contiene admin, mostrar html.
          ?>
            <a href="/student073/dwes/views/admin_page.php" class ="a-admin-icon flex p-1">
              <img src="/student073/dwes/assets/icons/admin-icon.png" alt="manual-icon">
              <p class="text-white hover:text-yellow-200 cursor-pointer">Admin</p>
            </a>
          
            <a class ="a-manuals-display-icon flex p-1" onclick="displayPagesMenu('nav_bar_manuals')">
              <img src="/student073/dwes/assets/icons/manual.png" alt="display-icon">
              <p class="text-white hover:text-yellow-200 cursor-pointer">Manuals</p>
            </a>

            <nav class="nav-bar-manuals" id="nav_bar_manuals">
              <a href="/student073/dwes/views/manuals/manual_technical.php" class="text-white">Technical manual</a>
              <a href="/student073/dwes/views/manuals/manual_installation.php" class="text-white">Installation manual</a>
              <a href="/student073/dwes/views/manuals/manual_user.php" class="text-white">User manual</a>
            </nav>
          <?php
          } ?>

      <a class="a-menu-icon" onclick="displayPagesMenu('pages_nav_bar')">
        <img src="/student073/dwes/assets/icons/menu.png" alt="menu-icon">
      </a>

        <a class ="a-account-icon flex p-1" onclick="displayPagesMenu('nav_bar_account')">
          <img src="/student073/dwes/assets/icons/account.png" alt="account-icon">
          <p class="text-white hover:text-yellow-200 cursor-pointer"><?php echo $_SESSION['user_firstname'] ?? 'Account'; ?></p>
        </a>

        <nav class="nav_bar_account" id="nav_bar_account">

          <?php if ($session_user_id == 'guest') {
            // Si el usuario no ha iniciado sesión, mostrar html de log in.
            ?>
              <a href="/student073/dwes/views/forms/users/form_user_login.php" class="text-white">Log in</a>
              <a href="/student073/dwes/views/forms/users/form_user_register.php" class="text-white">Register</a>
          <?php
          } ?>

          <?php if ($session_user_id != 'guest') {
            // Si el usuario ha iniciado sesión, mostrar html de log out.
            ?>
              <a href="/student073/dwes/views/db/users/db_user_logout.php" class="text-white">Log out</a>
          <?php
          } ?>

        </nav>
      </nav>
    </header>
