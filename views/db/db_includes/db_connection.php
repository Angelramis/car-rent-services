<?php
  // Datos BBDD
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "car-rent-services"; 

  // Crear conexión con BBDD
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Verificar que la conexión esté funcionando correctamente
  if (!$conn) {
    echo "Error de conexión " . mysqli_connect_error();
    exit();
  }

?>

