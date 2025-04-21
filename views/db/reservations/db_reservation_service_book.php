<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<main>
  <h1 class="text-center text-2xl p-3">Service book</h1>
  <?php
    // Archivo al darle a submit para pagar un servicio

    // Conexion a bbdd
    include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

    // Si se ha pulsado el botón form submit, iniciar gestión
    if (isset($_POST['form_reservation_service_book'])) {
      // Guardar en variables inputs de formulario
      $reservation_number = htmlspecialchars($_POST['reservation_number']);
      $service_name = htmlspecialchars($_POST['service_name']);
      $guest_quantity = htmlspecialchars($_POST['guest_quantity']);
      $date = htmlspecialchars($_POST['date_input']);
      $hour = htmlspecialchars($_POST['hours']);

      // Obtener precio específico del servicio
      if ($service_name == "Gym") {
        $unit_price = 20;
      } else if ($service_name == "Spa") {
        $unit_price = 30;
      } else if ($service_name == "Restaurant") {
        $unit_price = 25;
      }

      // Consultas SQL

      // Obtener el JSON actual de la reserva si ya tiene servicios contratados
      $query = "SELECT reservation_extras_json, reservation_state 
                FROM `073_reservations` 
                WHERE reservation_number = $reservation_number;";

      // Insertar reserva de servicio en tabla corresponidente
      $sql_insert_reservation_services = 
      "INSERT INTO `073_reservations_services`
       (reservation_number, service_id, users_qty, rs_unit_price, rs_date, rs_time, rs_state)
       VALUES($reservation_number, '$service_name', $guest_quantity, $unit_price, '$date', $hour, 'Booked');";

      // Ejecutar consultas SQL
      $result = mysqli_query($conn, $query);
      $execute_insert_reservation_services = mysqli_query($conn, $sql_insert_reservation_services);

      if ($result) {
        // Si ya hay un JSON de servicios, decodificarlo
        $row = mysqli_fetch_assoc($result);

        // Comprobar si el estado de la reserva es válido para contratar el servicio
        if ($row['reservation_state'] !== 'Booked' && $row['reservation_state'] !== 'Check-in') {
          ?>
            <p class="error">Error: the selected reservation is not active: <?php echo $row['reservation_state']; ?></p>
          <?php
        } else {
          // Si ya hay un JSON con servicios, decodificarlo
          $existing_services_json = $row['reservation_extras_json'];
          // Si existe el JSON en la BBDD, decodificarlo, si no, asignarle un array vacío
          $services = $existing_services_json ? json_decode($existing_services_json, true) : ["services" => []];

          // Crear el servicio pedido
          $new_service = [
            "name" => $service_name,
            "guest_quantity" => $guest_quantity,
            "unit_price" => $unit_price,
            "date" => $date,
            "subtotal" => $guest_quantity * $unit_price
          ];

          // Añadir el nuevo servicio al array existente de services
          $services["services"][] = $new_service;

          // Volver a codificar el array a JSON para llevarlo a la BBDD
          $updated_services_json = json_encode($services);

          // Consulta SQL para actualizar la columna JSON
          $update_query = "UPDATE `073_reservations` 
                          SET reservation_extras_json = '$updated_services_json' 
                          WHERE reservation_number = $reservation_number;";

          if (mysqli_query($conn, $update_query)) {
            ?>
              <p>Service correctly added.</p>
            <?php
          } else {
            ?>
              <p>Error adding the service: <?php echo(mysqli_error($conn));?></p>
            <?php
          }
        }
      } else {
        ?>
          <p>Error: <?php echo(mysqli_error($conn));?></p>
        <?php
      }

    }

  // Cerrar conexión con la base de datos
  mysqli_close($conn);
  ?>

  <a href="/student073/dwes/index.php">
    <input type="button" value="Home" class="button_action">
  </a>

</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>