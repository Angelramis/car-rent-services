<?php
session_start();
$session_user_id = $_SESSION['user_id'] ?? 'guest';
$session_user_firstname = $_SESSION['user_firstname'] ?? 'User';
$session_user_roles = $_SESSION['user_roles'] ?? 'None';

if (empty($_SERVER['DOCUMENT_ROOT'])) {
    // Ajustar ruta al usarse en Render
    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
}

include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/functions.php';

$flagMap = [
  'en' => 'uk',
  'es' => 'spain',
  'fr' => 'france',
  'de' => 'germany'
];

if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

$currentFlag = $flagMap[$lang] ?? 'uk';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Car Rent Services</title>

  <link rel="stylesheet" href="/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="/src/output.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="/assets/images/general/logo-car-rent-services.png">
</head>

<body class="bg-[#f7f7f7] flex flex-col items-center">
  <header>
    <div class="logo_contanier_header">
      <a href="/index.php" class="flex text-white font-bold">
        <img src="/assets/images/general/logo-car-rent-services.png" class="w-12" alt="Logo car rent services">
      </a>
    </div>

    <nav class="right_header">
      <div class="lang-selector">
        <a href="#">
          <img src="/assets/images/flags/flag-<?= $currentFlag ?>.png" alt="Lang flag" class="w-14">
        </a>
        <div class="lang-dropdown shadow-md rounded-md">
          <a href="#" onclick="setLang('en')">
            <img src="/assets/images/flags/flag-uk.png" alt="English"> English
          </a>
          <a href="#" onclick="setLang('es')">
            <img src="/assets/images/flags/flag-spain.png" alt="Español"> Español
          </a>
          <a href="#" onclick="setLang('fr')">
            <img src="/assets/images/flags/flag-france.png" alt="Français"> Français
          </a>
          <a href="#" onclick="setLang('de')">
            <img src="/assets/images/flags/flag-germany.png" alt="Deutsch"> Deutsch
          </a>
        </div>
      </div>  
        <?php if (strstr($session_user_roles, 'admin')) {
          // Si dentro de los roles del usuario contiene admin, mostrar html.
        ?>
          <form action="/views/forms/cars/form-car-admin.php" method="POST" class="a-admin-icon flex p-1 transition rounded-lg hover:bg-yellow-400 cursor-pointer">
              <img src="/assets/icons/admin-icon.png" alt="manual-icon">
            <input type="submit" class="text-white" value="Admin" name="form-car-admin">
          </form>
        <?php
        } ?>

        <a class="a-account-icon flex p-1 transition rounded-lg hover:bg-yellow-400 cursor-pointer" onclick="displayPagesMenu('nav_bar_account')">
          <img src="/assets/icons/account.png" alt="account-icon">
          <p class="text-white"><?php echo $_SESSION['user_firstname'] ?? 'Account'; ?></p>
        </a>

        <nav class="nav_bar_account" id="nav_bar_account">

          <?php if ($session_user_id == 'guest') {
            // Si el usuario no ha iniciado sesión, mostrar html de log in.
          ?>
            <a href="/views/forms/users/form-user-login.php" class="text-white transition rounded-lg p-1 hover:bg-yellow-400 cursor-pointer"><?= __('Log in', $lang);?></a>
            <a href="/views/forms/users/form-user-register.php" class="text-white transition rounded-lg p-1 hover:bg-yellow-400 cursor-pointer"><?= __('Register', $lang);?></a>
          <?php
          } ?>

          <?php if ($session_user_id != 'guest') {
            // Si el usuario ha iniciado sesión, mostrar html de log out.
          ?>
            <a href="/views/user-reservations.php" class="a-manuals-display-icon flex p-1 transition rounded-lg items-center hover:bg-yellow-400 cursor-pointer">
              <img src="/assets/icons/reservation-white.png" alt="display-icon">
              <p class="text-white"><?= __('Reservations', $lang);?></p>
            </a>
            <a href="/views/db/users/db_user_logout.php" class="text-white transition rounded-lg p-1 hover:bg-yellow-400 cursor-pointer"><?= __('Log out', $lang);?></a>
          <?php
          } ?>

        </nav>
    </nav>
  </header>
  <main class="flex flex-col items-center w-full p-[15px] max-w-[850px] mt-[52px] gap-2 min-h-screen">