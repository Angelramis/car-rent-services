<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/header.php';
?>

<?php

// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/views/db/db_includes/db_connection.php';

          // Cerrar la sesión y redirigir a la página principal.
          session_unset();
          header("Location: /index.php");
          exit();
      
// Cerrar la conexión a la base de datos
pg_close($conn);
?>
