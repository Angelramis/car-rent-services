<?php
// FUNCIONES PHP

// Escribir logs hechos por usuarios en archivo login-log
function actualizarLoginLog($user_email) {
  // Declarar archivo log
  $file = $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/logs/login-log.json';

  // Comprobación previa de si existe el archivo
  if (file_exists($file)) {
    // Leer el contenido del archivo
    $content = file_get_contents($file);
    $logs = json_decode($content, true);

    // Si el archivo está vacío, crear un array vacío
    if (!is_array($logs)) {
      $logs = [];
    }

    // Obtener fecha actual
    $date = date('Y-m-d');

    // Actualizar el log del usuario
    // Si el usuario no está, insertarlo en el array
    if (!isset($logs[$user_email])) {
      $logs[$user_email] = ["log-in" => []];
    }
    
    // Si ya existe, insertar la nueva fecha en su array fechas
    $logs[$user_email]["log-in"][] = $date;

    // Guardar el JSON actualizado en el archivo
    file_put_contents($file, json_encode($logs, JSON_PRETTY_PRINT));

  } else {
    echo "File doesn't exist";
  }
}
?>