<?php
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/header.php';
?>

  <div class="flex flex-col w-full gap-2 min-h-screen bg-white rounded-xl shadow-lg p-6">
  <?php
    // include conexion a bbdd
    include $_SERVER['DOCUMENT_ROOT'].'/views/db/db_includes/db_connection.php';

    if (!($session_user_id == 'guest')) {
      // Guardar consulta SQL
      $sql_query = "SELECT * 
                    FROM `reservations_view`
                    WHERE user_id = '$session_user_id';";

      // Ejecutar consulta SQL
      $execute_query = pg_query($conn, $sql_query);
      $reservations = pg_fetch_all($execute_query);

      if ($execute_query && pg_num_rows($execute_query) > 0) {
        /* Mostrar sus reservas activas*/
        foreach ($reservations as $reservation) {
          ?>
            <div class="flex flex-col items-center justify-center w-full bg-white text-left rounded-md shadow-md p-2 md:grid md:grid-cols-3  md:gap-2">
              <p><?= __('Reservation number', $lang);?>: <?php echo $reservation['rs_number'];?></p>
              <p><?= __('Fullname', $lang);?>: <?php echo $reservation['user_fullname'];?></p>
              <p><?= __('NIF', $lang);?>: <?php echo $reservation['user_nif'];?></p>
              <p><?= __('Pick up date', $lang);?>: <?php echo $reservation['rs_pickup_date'] . " - " . $reservation['rs_pickup_time']; ?>h</p>
              <p><?= __('Drop off date', $lang);?>: <?php echo $reservation['rs_dropoff_date']. " - " . $reservation['rs_dropoff_time']; ?>h</p>
              <p><?= __('Car plate', $lang);?>: <?php echo $reservation['car_plate'];?></p>
              <p><?= __('Total price', $lang);?>: <?php echo $reservation['rs_total_price'];?>€</p>
              <p><?= __('Status', $lang);?>: <?= __($reservation['rs_status'], $lang); ?></p>
              <p><?= __('Creation date', $lang);?>: <?php echo $reservation['rs_created_at'];?></p>
            </div>
          <?php
        }
      } else {
        ?> 
        <p class="text-left"><?= __("You don't have any reservation", $lang);?>.</p>
        <?php
      }

      pg_close($conn);

    /* Si el usuario no ha iniciado sesión aún, redirigirlo al log in */
    } else if ($session_user_id == 'guest') {
      header("Location: /views/forms/users/form-user-login.php"); 
    }
  ?>  
  </div>


<?php
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/footer.php';
?>