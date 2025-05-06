<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';

// Verificar si el usuario no tiene un rol permitido
if (!strstr($session_user_roles, 'admin',) && !strstr($session_user_roles, 'employee')) {
  header("Location: /car-rent-services/index.php");
  exit();
}
?>
<h1 class="text-center text-2xl p-3">Installation Manual</h1>


<div class="flex flex-col h-auto gap-3 bg-white shadow-md rounded-md max-w-4xl mx-auto w-full p-4">

  <h2 class="font-bold text-xl">Hardware</h2>
  <p>Ordenador con sistema operativo Windows o Linux</p>
  <p>Conexión a internet</p>
  

  <h2 class="font-bold text-xl">Software</h2>
  <p>Editor: Visual Studio Code</p>
  <p>Tecnologías usadas: PHP, HTML, JS, CSS, TAILWIND, STRIPE, COMPOSER, GIT</p>
  <p>BBDD relacional: MariaDB</p>
  <p>Aplicación BBDD: phpmyadmin</p>
  <p>Servidor web: Apache</p>


</div>



<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>