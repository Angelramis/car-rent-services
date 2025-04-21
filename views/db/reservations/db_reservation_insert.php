<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">New Reservation</h1>

<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón form submit, iniciar gestión
  if (isset($_POST['form_reservation_insert'])) {
    // Guardar en variables inputs values -> llamar todo igual que en BBDD
    $user_id = htmlspecialchars($_POST['user_id']);
    $premise_id = htmlspecialchars($_POST['premise_id']);
    $date_in = htmlspecialchars($_POST['date_in']);
    $date_out = htmlspecialchars($_POST['date_out']);
    $reservation_state = "Booked";

    // Guardar consulta SQL
    $sql_query = 
    "INSERT INTO `073_reservations`(user_id, premise_id, date_in, date_out, reservation_state)
    VALUES('$user_id', '$premise_id', '$date_in', '$date_out', '$reservation_state');";

    // Guardar consulta de muestra por pantalla del resultado de la consulta
    $query_select = "SELECT * 
                  FROM 073_reservations
                  ORDER BY reservation_number DESC
                  LIMIT 1;";
    
     // Ejecutar consulta SQL a la BBDD
     $execute_query = mysqli_query($conn, $sql_query);

     if ($execute_query) {
      //Guardar resultado de la consulta
      $result_query = mysqli_query($conn, $query_select);
 
      // Verificar si se ha obtenido resultado
      if ($result_query && mysqli_num_rows($result_query) > 0) {
        // Obtener el resultado y mostrarlo
        while ($row = mysqli_fetch_assoc($result_query)) {
          ?>
          <div class='product_div'>
            <p> User ID: <?php echo $row['user_id']?></p>
            <p> Premise ID: <?php echo $row['premise_id']?></p>
            <p> Date in <?php echo $row['date_in']?></p>
            <p> Date out <?php echo $row['date_out']?></p>
            <p> Reservation date <?php echo $row['reservation_date']?></p>
            <p> Reservation state <?php echo $row['reservation_state']?></p>
          </div>
          <?php
        }
      } else { 
        echo "No se ha encontrado el resultado de la consulta" . mysqli_error($con);
      }
    } else {
      echo "Error con la consulta" . mysqli_error($con);
    }
  }
  // Cerrar conexión con BBD una vez acabada la consulta
  mysqli_close($conn);
?>  

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>