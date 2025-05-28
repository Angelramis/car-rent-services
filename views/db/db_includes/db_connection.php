<?php

// Cargar variables del .env
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '')->load();

// Datos BBDD
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname =  $_ENV['DB_NAME'];
$port =  $_ENV['DB_PORT'];

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Crear conexión con BBDD
$conn = pg_connect($conn_string);

// Verificar que la conexión esté funcionando correctamente
if (!$conn) {
  echo "Error de conexión " . pg_last_error();
  exit();
}
