<?php
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<main>
  <h1 class="title">My reservations</h1>
  <p>Your active reservations</p>

  <div class="div_content_available">
  <?php
    // include conexion a bbdd
    include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

    if (!($session_user_id == 'guest')) {
      // Guardar consulta SQL
      $sql_query = "SELECT * 
                    FROM `073_reservations_view`
                    WHERE user_id = '$session_user_id' 
                    AND reservation_state = 'Booked'
                    OR reservation_state = 'Check-in';";

      // Ejecutar consulta SQL
      $result_query = mysqli_query($conn, $sql_query);

      if ($result_query && mysqli_num_rows($result_query) > 0) {
        /* Mostrar sus reservas activas*/
        while ($row = mysqli_fetch_assoc($result_query)) {
          ?>
          <div class='product_div'>
            <p> Reservation number: <?php echo $row['reservation_number'];?></p>
            <p> User fullname: <?php echo $row['user_fullname'];?></p>
            <p> User NIF: <?php echo $row['user_nif'];?></p>
            <p> Premise number: <?php echo $row['premise_number'];?></p>
            <p> Date in: <?php echo $row['date_in'];?></p>
            <p> Date out: <?php echo $row['date_out'];?></p>
            <p> Reservation date: <?php echo $row['reservation_date'];?></p>
            <p> Reservation state: <?php echo $row['reservation_state'];?></p>
            <p class="font-bold"> Services:</p>
            <?php
              // Columna conteniendo el JSON
              $reservation_extras_json = $row['reservation_extras_json'];

              // Decodificar JSON para convertir a objeto
              $reservation_extras = json_decode($reservation_extras_json, true);

              // Comprueba decodificación y si el resultado no es null
              if (is_array($reservation_extras)) {
                foreach ($reservation_extras['services'] as $service) {
                  ?>
                  <p> Service: <?php echo $service['name'];?></p>
                  <p> Guests: <?php echo $service['guest_quantity'];?></p>
                  <p> Unit price: <?php echo $service['unit_price'];?></p>
                  <p> Date: <?php echo $service['date'];?></p>
                  <p> Service subtotal: <?php echo $service['subtotal'];?>€</p>
                  <?php
                }
              } else {
                ?>
                  <p>No services.</p>
                <?php
              }
              ?>
              <form action="/student073/dwes/views/db/reservations/db_reservation_cancel.php" method="POST">
                <input type="text" name="reservation_number" class="hidden" required value="<?php echo $row['reservation_number']?>">
                <input type="submit" value="Cancel" name="form_reservation_cancel" class="button_action">
              </form>
            </div>
          <?php
        }
      } else {
        ?> 
        <p class="text-left">You don't have any active reservations.</p>
        <?php
      }

      // Cerrar conexión con BBD una vez acabada la consulta
      mysqli_close($conn);

    /* Si el usuario no ha iniciado sesión aún, redirigirlo al log in */
    } else if ($session_user_id == 'guest') {
      header("Location: /student073/dwes/views/forms/users/form_user_login.php"); 
    }
  ?>  
  </div>

</main>

<?php
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>