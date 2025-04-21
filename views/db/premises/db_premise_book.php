<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<main>
  <h1 class="text-center text-2xl p-3">Book a premise</h1>

  <?php
    // include conexion a bbdd
    include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

    // Si se ha pulsado el botón form submit, iniciar gestión
    if (isset($_POST['form_premise_book'])) {
      // Guardar en variables inputs values
      $premise_id = htmlspecialchars($_POST['premise_id']);
      $date_in = htmlspecialchars($_POST['date_in']);
      $date_out = htmlspecialchars($_POST['date_out']);

      // Mandar usuario al log in si no ha iniciado sesión
      if ($session_user_id == 'guest') {
        header("Location: /student073/dwes/views/forms/users/form_user_login.php"); 
      }

      // Guardar consulta SQL
      $sql_query = 
                "INSERT INTO 073_reservations(user_id, premise_id, date_in, date_out)
                VALUES('$session_user_id', '$premise_id', '$date_in', '$date_out');";

      // Guardar consulta de muestra por pantalla del resultado de la consulta
      $query_select = "SELECT * 
                    FROM `073_reservations_view`
                    ORDER BY reservation_number DESC
                    LIMIT 1;";

      // Ejecutar consulta SQL a la BBDD
      $execute_query = mysqli_query($conn, $sql_query);
      
      if ($execute_query) {
        //Guardar resultado de la consulta
        $result_query = mysqli_query($conn, $query_select);
  
        // Verificar si se ha obtenido resultado
        if ($result_query) {
          // Obtener el resultado y mostrarlo
          while ($row = mysqli_fetch_assoc($result_query)) {
            ?>
            <div class='div_border'>
              <h2 class='text-xl font-bold'>Invoice </h2>
              <p>User fullname: <?php echo $row['user_fullname'];?></p>
              <p>User NIF: <?php echo $row['user_nif'];?></p>
              <p>Premise number: <?php echo $row['premise_number']; ?></p>
              <p>Date in: <?php echo $row['date_in']; ?></p>
              <p>Date out: <?php echo $row['date_out']; ?></p>
              <p>Reservation date: <?php echo $row['reservation_date']; ?></p>
              <p>Total days: <?php echo $row['total_days']; ?></p>
              <p>Subtotal: <?php echo $row['subtotal']; ?>€</p>
              <p>Hotel Hilton</p>
            </div>
            <?php
          }
        } else { 
          echo "No se ha encontrado el resultado de la consulta" . mysqli_error($conn);
        }
      } else {
        echo "Error con la consulta" . mysqli_error($conn);
      }
    }
    // Cerrar conexión con BBD una vez acabada la consulta
    mysqli_close($conn);
  ?>  

  <a href="/student073/dwes/index.php">
    <input type="button" value="Home" class="button_action">
  </a>

</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>