<?php

  // Función para devolver los días de diferencia entre dos fechas
  // Si la diferencia es cero, se asigna 1 
  function dateDiff($start, $end) {
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    $days = $startDate->diff($endDate)->days;
    return ($days === 0) ? 1 : $days;
  }

  // Funcion para cargar traducciones
  function __($key, $lang = 'en') {
    static $translations = [];

    if (!isset($translations[$lang])) {
      $path = $_SERVER['DOCUMENT_ROOT'] . '/lang/' . $lang . '.php';
        if (file_exists($path)) {
            $translations[$lang] = include $path;
        } else {
            $translations[$lang] = [];
        }
    }

    return $translations[$lang][$key] ?? $key;
}
?>