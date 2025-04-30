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
          CarRent<p class="hidden text-white font-bold  sm:flex">Services</p>
        </a>
      </div>

      <nav class="pages_nav_bar" id="pages_nav_bar">
          <a href="/car-rent-services/index.php" class="text-white hover:text-yellow-200">Home</a>
          <a href="/car-rent-services/views/user_reservations.php" class="text-white hover:text-yellow-200">My reservations</a>
      </nav>

      <nav class="right_header">
        <?php if (strstr($session_user_roles, 'admin')) {
          // Si dentro de los roles del usuario contiene admin, mostrar html.
          ?>
            <a href="/car-rent-services/views/admin_page.php" class ="a-admin-icon flex p-1">
              <img src="/car-rent-services/assets/icons/admin-icon.png" alt="manual-icon">
              <p class="text-white hover:text-yellow-200 cursor-pointer">Admin</p>
            </a>
          
            <a class ="a-manuals-display-icon flex p-1" onclick="displayPagesMenu('nav_bar_manuals')">
              <img src="/car-rent-services/assets/icons/manual.png" alt="display-icon">
              <p class="text-white hover:text-yellow-200 cursor-pointer">Manuals</p>
            </a>

            <nav class="nav-bar-manuals" id="nav_bar_manuals">
              <a href="/car-rent-services/views/manuals/manual_technical.php" class="text-white">Technical manual</a>
              <a href="/car-rent-services/views/manuals/manual_installation.php" class="text-white">Installation manual</a>
              <a href="/car-rent-services/views/manuals/manual_user.php" class="text-white">User manual</a>
            </nav>
          <?php
          } ?>

      <a class="a-menu-icon" onclick="displayPagesMenu('pages_nav_bar')">
        <img src="/car-rent-services/assets/icons/menu.png" alt="menu-icon">
      </a>

        <a class ="a-account-icon flex p-1" onclick="displayPagesMenu('nav_bar_account')">
          <img src="/car-rent-services/assets/icons/account.png" alt="account-icon">
          <p class="text-white hover:text-yellow-200 cursor-pointer"><?php echo $_SESSION['user_firstname'] ?? 'Account'; ?></p>
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
              <a href="/car-rent-services/views/db/users/db_user_logout.php" class="text-white">Log out</a>
          <?php
          } ?>

        </nav>
      </nav>
    </header>
    <main class="gap-2 min-h-screen">


