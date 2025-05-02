<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';

// Verificar si el usuario no tiene un rol permitido
if (!strstr($session_user_roles, 'admin',)) { // si no tiene rol admin
  // Redirigir al inicio si no tiene permisos
  header("Location: /car-rent-services/index.php");
  exit(); // Salir para evitar que muestre contenido de la página
}
?>

<h1 class='text-center text-2xl p-3'>Admin Page</h1>

<?php //Admin models
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/admin-models.php';
  ?>
  
<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

</div>


<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>