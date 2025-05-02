<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // si no tiene rol admin
    // Redirigir al inicio si no tiene permisos
    header("Location: /car-rent-services/index.php");
    exit(); // Salir para evitar que muestre contenido de la página
  }
?>

  <h1 class='text-center text-2xl p-3'>Admin Page</h1>
  <div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">
  <nav class="w-full flex flex-row gap-3 justify-center">
      
      <form action="/car-rent-services/views/forms/cars/form-car-admin.php" method="POST" class="flex p-1 gap-1 rounded-lg transition hover:bg-blue-300 hover:cursor-pointer">
          <img src="/car-rent-services/assets/icons/car.png" alt="display-icon" class="h-6 w-6">
            <input type="submit" class="text-black" value="Cars" name="form-car-admin">
      </form>


    
    <nav class="flex flex-col items-center">
      <a class="a-displayer-premises flex p-1 gap-1 hover:text-yellow-200 cursor-pointer">
        <img src="/car-rent-services/assets/icons/user.png" alt="display-icon" class="h-6 w-6">
          <p class="text-black">Users</p>
      </a>
    </nav>
    

    <nav class="flex flex-col items-center">
      <a class="a-displayer-premises flex p-1 gap-1 hover:text-yellow-200 cursor-pointer">
        <img src="/car-rent-services/assets/icons/reservation.png" alt="display-icon" class="h-6 w-6">
          <p class="text-black">Reservations</p>
      </a>
    </nav>
  </nav>
</div>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>