<?php

  // Función para devolver los días de diferencia entre dos fechas
  // Si la diferencia es cero, se asigna 1 
  function dateDiff($start, $end) {
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    $days = $startDate->diff($endDate)->days;
    return ($days === 0) ? 1 : $days;
  }

?>