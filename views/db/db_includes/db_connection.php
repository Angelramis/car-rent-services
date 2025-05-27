<?php
// Datos BBDD
$host = 'dpg-d0qqm9adbo4c73cbqsdg-a.frankfurt-postgres.render.com';
$user = 'admin';
$password = 'bvcF43Sct7HqXN2SRe5087jASoXGNUZw';
$dbname = 'car_rent_services';
$port = 5432;

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Crear conexión con BBDD
$conn = pg_connect($conn_string);

// Verificar que la conexión esté funcionando correctamente
if (!$conn) {
  echo "Error de conexión " . pg_last_error();
  exit();
}
