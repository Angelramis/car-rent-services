<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // si no tiene rol admin
    // Redirigir al inicio si no tiene permisos
    header("Location: /car-rent-services/index.php");
    exit(); // Salir para evitar que muestre contenido de la página
  }
?>

<head>
  <link rel="stylesheet" href="/car-rent-services/css/admin-page.css">
</head>

<main>
  <h1 class="title">Admin page</h1>

  <nav class="nav-forms">
      
    <nav class="premises_forms_container flex flex-col items-center">
      <a class="a-displayer-premises text-white flex p-1 hover:text-yellow-200 cursor-pointer" onclick="displayPagesMenu('premises_admin_menu');">
        <img src="/car-rent-services/assets/icons/display.png" alt="display-icon" class="h-6 w-6">
          <p class="text-white">Premises</p>
      </a>

      <!--Displayable menu for forms href-->
      <nav class="premises_admin_menu hidden" id="premises_admin_menu">
        <a href="/car-rent-services/views/forms/premises/form_premise_select.php" class="premises_select_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Select</p>
        </a>

        <a href="/car-rent-services/views/forms/premises/form_premise_insert.php" class="premises_insert_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Insert</p>
        </a>

        <a href="/car-rent-services/views/forms/premises/form_premise_update_call_id.php" class="premises_update_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Update</p>
        </a>

        <a href="/car-rent-services/views/forms/premises/form_premise_delete.php" class="premises_delete_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Delete</p>
        </a>
      </nav>
    </nav>

    
    <nav class="customers_forms_container flex flex-col items-center">
      <!--Display icon-->
      <a class="a-displayer-premises flex p-1 hover:text-yellow-200 cursor-pointer" onclick="displayPagesMenu('users_admin_menu');">
        <img src="/car-rent-services/assets/icons/display.png" alt="display-icon" class="h-6 w-6">
          <p class="text-white">Users</p>
      </a>

      
      <nav class="users_form_menu hidden" id="users_admin_menu">
        <a href="/car-rent-services/views/forms/users/form_user_select.php" class="customers_select_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Select</p>
        </a>

        <a href="/car-rent-services/views/forms/users/form_user_insert.php" class="customers_insert_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Insert</p>
        </a>

        <a href="/car-rent-services/views/forms/users/form_user_update_call_id.php" class="customers_update_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Update</p>
        </a>

        <a href="/car-rent-services/views/forms/users/form_user_delete.php" class="customers_delete_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Delete</p>
        </a>

        <a href="/car-rent-services/views/forms/users/form_reviews_management.php" class="customers_delete_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Reviews Management</p>
        </a>
      </nav>
    </nav>
    

    <nav class="reservations_forms_container flex flex-col items-center">
      <!--Display icon-->
      <a class="a-displayer-premises flex p-1 hover:text-yellow-200 cursor-pointer" onclick="displayPagesMenu('reservations_admin_menu');">
        <img src="/car-rent-services/assets/icons/display.png" alt="display-icon" class="h-6 w-6">
          <p class="text-white">Reservations</p>
      </a>

      <!--Displayable menu for forms href-->
      <nav class="reservations_form_menu hidden" id="reservations_admin_menu">
        <a href="/car-rent-services/views/forms/reservations/form_reservation_select.php" class="reservations_select_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Select</p>
        </a>

        <a href="/car-rent-services/views/forms/reservations/form_reservation_insert.php" class="reservations_insert_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Insert</p>
        </a>

        <a href="/car-rent-services/views/forms/reservations/form_reservation_update_call_id.php" class="reservations_update_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Update</p>
        </a>

        <a href="/car-rent-services/views/forms/reservations/form_reservation_delete.php" class="reservations_delete_href">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Delete</p>
        </a>
      </nav>
    </nav>

    <nav class="invoices_forms_container flex flex-col items-center">
      <a class="a-displayer-premises flex p-1 hover:text-yellow-200 cursor-pointer" onclick="displayPagesMenu('invoices_admin_menu');">
        <img src="/car-rent-services/assets/icons/display.png" alt="display-icon" class="h-6 w-6">
          <p class="text-white">Analytics</p>
      </a>

      <!--Displayable menu for forms href-->
      <nav class="hidden" id="invoices_admin_menu">
        <a href="/car-rent-services/views/forms/analytics/form_invoice_select.php">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Daily Invoice</p>
        </a>

        <a href="/car-rent-services/views/forms/analytics/form_users_country_select.php">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Users Country</p>
        </a>

        <a href="/car-rent-services/views/forms/analytics/form_users_login.php">
          <p class="text-white hover:text-yellow-200 cursor-pointer">Users Login</p>
        </a>

      </nav>
    </nav>



  </nav>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>