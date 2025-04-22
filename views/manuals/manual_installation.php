<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
  
  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',) && !strstr($session_user_roles, 'employee')) { 
    header("Location: /car-rent-services/index.php");
    exit();
  }
?>

<head> <!-- Head extra -->
  <link rel="stylesheet" href="/car-rent-services/css/manuals.css">
</head>

<main>
  <div class="div_manual">
  <h1 class=" text-center text-2xl">Installation Manual</h1>
  <h2 class="text-2xl">Hardware</h2>
    <p>Ordenador</p>
  <h2 class="text-2xl">Software</h2>
    <p>Sistema operativo: Windows</p>
    <p>Navegador: Chrome. Usable para el resto.</p>
    <p>Servidor web: Apache</p>
    <p>Editor: Visual Studio Code</p>
    <p>Cliente FTP: Filezilla Client</p>
    <p>Servidor FTP: Filezilla Servidor</p>
    <p>BBDD relacional: mariadb</p>
    <p>Gestor de BBDD: phpmyadmin</p>
    <p>Programa BBDD: XAMPP</p>
    <h2 class="text-xl">Lenguajes usados:</h2>
    <h2>Programación:</h2>
    <p>Programación cliente: JavaScript</p>
    <p>Programación servidor: PHP</p>
    <p>Programación BBDD: SQL</p>

    <h2>Maquetación:</h2>
    <p>Estructura de página web: HTML</p>
    <p>Diseño web: Framework Tailwindcss y CSS manual.</p>
  </div>
</main>
<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>