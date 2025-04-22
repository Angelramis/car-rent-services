<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<?php

// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

          // Cerrar la sesión y redirigir a la página principal.
          session_unset();
          header("Location: /car-rent-services/index.php");
          exit();
      
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
