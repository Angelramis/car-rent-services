<?php

  // Archivo de gestión AJAX llamado desde formulario reservar un servicio

  // Datos introducidos en inputs del form
  $serviceInput = htmlspecialchars(strval($_POST['serviceInput']));
  $reservationNumberInput = htmlspecialchars(intval($_POST['reservationNumberInput']));
  $guestQuantityInput = htmlspecialchars(intval($_POST['guestQuantityInput']));
  $dateInput = htmlspecialchars(strval($_POST['dateInput']));

  // Variables
  $available_hours = null;

  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Consulta para obtener las horas del servicio escogido
  $sql_service_hours = "SELECT timetable_json
                        FROM `073_services`
                        WHERE service_id = '$serviceInput';";

  // Consulta para obtener el date_in y date_out según el numero
  // de reserva seleccionado
  $sql_reservation_dates = "SELECT date_in, date_out
                            FROM `073_reservations`
                            WHERE reservation_number = '$reservationNumberInput';";


  // Consulta para obtener las horas ocupadas
  $sql_busy_hours = "SELECT rs_time
                    FROM `073_reservations_services_view_capacity`
                    WHERE service_id = '$serviceInput' 
                    AND rs_date = $dateInput
                    AND available_capacity < '$guestQuantityInput';";

  // Ejecutar consultas SQL

  $execute_reservation_dates = mysqli_query($conn, $sql_reservation_dates);

  // Si hay una fecha introducida en el input
  if ($dateInput != "") {
    // Obtener horarios del servicio
    $execute_service_hours = mysqli_query($conn, $sql_service_hours);
    $service_hours_row = mysqli_fetch_assoc($execute_service_hours);
    
    // Decodificar JSON de horarios disponibles
    $service_hours = json_decode($service_hours_row['timetable_json'], true);

    // Obtener horas ocupadas
    $execute_busy_hours = mysqli_query($conn, $sql_busy_hours);
    $busy_hours = mysqli_fetch_all($execute_busy_hours, MYSQLI_ASSOC);

    // Extraer solo horas ocupadas
    $busy_hours_list = array_column($busy_hours, 'rs_time');

    // Calcular horas disponibles eliminando las ocupadas
    $available_hours = array_diff($service_hours, $busy_hours_list);
  }
  

  // Obtener el date_in y date_out de la reserva
  $reservation_dates = mysqli_fetch_assoc($execute_reservation_dates);

  $date_in = $reservation_dates['date_in'] ?? null;
  $date_out = $reservation_dates['date_out']  ?? null;

  $response = json_encode([
    "date_in" => $date_in,
    "date_out" => $date_out,
    "available_hours" => array_values($available_hours ?? []) 
  ]);

  // Retornar respuesta
  echo $response;

  // Cerrar conexión con DB
  mysqli_close($conn);
?>