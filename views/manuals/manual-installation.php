<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';

// Verificar si el usuario no tiene un rol permitido
if (!strstr($session_user_roles, 'admin',) && !strstr($session_user_roles, 'employee')) {
  header("Location: /car-rent-services/index.php");
  exit();
}
?>

<div class="flex flex-col h-auto gap-3 bg-white shadow-md rounded-md max-w-4xl mx-auto w-full p-4">
  <h1 class="text-center text-2xl p-2 font-bold">Manual de instalación</h1>

  <h2 class="font-bold text-xl">Hardware</h2>
  <p>Ordenador con sistema operativo Windows o Linux</p>
  <p>Conexión a internet</p>
  
  <h2 class="font-bold text-xl">Software</h2>
  <p>Editor: Visual Studio Code</p>
  <p>Tecnologías usadas: PHP, HTML, JS, CSS, Tailwindcss, Stripe para pagos, Composer para funcionalidades, Git para control de versiones</p>  <p>BBDD relacional: MariaDB</p>
  <p>Aplicación BBDD: phpmyadmin</p>
  <p>Servidor web: Apache</p>

  <h2 class="font-bold text-xl">Instalación del proyecto</h2>
  <p>Instala XAMPP o una aplicación que use Apache y Mysql</p>
  <p>Clonar repositorio en Github usando git clone</p>
  <p>Pon el fichero .env con los datos privados, si se han dado, en la raíz del proyecto</p>
  <p>Ejecuta en la terminal <span class="font-bold">composer install</span> en la raíz del proyecto</p>
  <p>Instala las dependendencias de tailwind en tu ordenador: <span class="font-bold">npm install</span></p>
  <p>Usa el comando <span class="font-bold">npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch</span>
    para activar tailwindcss cada vez que entres el proyecto</p>
  <p>Importa en phpmyadmin el archivo .sql de la base de datos del proyecto</p>
</div>



<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>