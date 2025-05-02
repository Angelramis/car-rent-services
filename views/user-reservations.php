<?php
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

  <h1 class="title">My reservations</h1>

  <div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">
  <?php
    // include conexion a bbdd
    include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

    if (!($session_user_id == 'guest')) {
      // Guardar consulta SQL
      $sql_query = "SELECT * 
                    FROM `reservations_view`
                    WHERE user_id = '$session_user_id';";

      // Ejecutar consulta SQL
      $execute_query = mysqli_query($conn, $sql_query);

      $reservations = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);

      if ($execute_query && mysqli_num_rows($execute_query) > 0) {
        /* Mostrar sus reservas activas*/
        foreach ($reservations as $reservation) {
          ?>
            <div class="flex flex-col items-center justify-center w-full bg-white text-left rounded-md shadow p-2 md:grid md:grid-cols-4  md:gap-2">
              <p>Reservation number: <?php echo $reservation['rs_number'];?></p>
              <p>User fullname: <?php echo $reservation['user_fullname'];?></p>
              <p>User NIF: <?php echo $reservation['user_nif'];?></p>
              <p>Pickup Date: <?php echo $reservation['rs_pickup_date'];?></p>
              <p>Pickup Time: <?php echo $reservation['rs_pickup_time'];?></p>
              <p>Dropoff Date: <?php echo $reservation['rs_dropoff_date'];?></p>
              <p>Dropoff Time: <?php echo $reservation['rs_dropoff_time'];?></p>
              <p>Car plate: <?php echo $reservation['car_plate'];?></p>
              <p>Total price: <?php echo $reservation['rs_total_price'];?>€</p>
              <p>Status: <?php echo $reservation['rs_status'];?></p>
              <p>Creation date: <?php echo $reservation['rs_created_at'];?></p>
            </div>
          <?php
        }
      } else {
        ?> 
        <p class="text-left">You don't have any reservations.</p>
        <?php
      }

      // Cerrar conexión con BBD una vez acabada la consulta
      mysqli_close($conn);

    /* Si el usuario no ha iniciado sesión aún, redirigirlo al log in */
    } else if ($session_user_id == 'guest') {
      header("Location: /car-rent-services/views/forms/users/form-user-login.php"); 
    }
  ?>  
  </div>


<?php
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>