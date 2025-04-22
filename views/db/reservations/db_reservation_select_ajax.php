<?php
  // Datos introducidos en el input del form
  $query = htmlspecialchars(strval($_GET['query']));

  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  $sql_query ="SELECT * 
              FROM `073_reservations_view`
              WHERE user_nif LIKE '%$query%';";

  $result_query = mysqli_query($conn, $sql_query);

  while ($row = mysqli_fetch_array($result_query)) {
    ?>
      <div class='product_div'>
        <p> Reservation number: <?php echo $row['reservation_number'];?></p>
        <p> User Fullname: <?php echo $row['user_fullname'];?></p>
        <p> User NIF: <?php echo $row['user_nif'];?></p>
        <p> Premise id: <?php echo $row['premise_id'];?></p>
        <p> Date in: <?php echo $row['date_in'];?></p>
        <p> Date out: <?php echo $row['date_in'];?></p>
        <p> Reservation date: <?php echo $row['reservation_date'];?></p>
        <p> Reservation state: <?php echo $row['reservation_state'];?></p>

        <!-- Botón editar reserva si no ha sido cancelada-->
         <?php if ($row['reservation_state'] !== 'Cancelled') { ?>
          <form action="/car-rent-services/views/forms/reservations/form_reservation_update.php" method="POST">
                <input type="text" name="reservation_number" class="hidden" required value="<?php echo $row['reservation_number'];?>">
                <input type="submit" value="Update" name="form_reservation_update_call_id" class="button_action">
          </form>
        <?php } else {
            echo '<p class="p-5 text-red-500 font-medium">Cancelled</p>';
              } ?>
      </div>
    <?php
  }

  // Cerrar conexión con la base de datos
  mysqli_close($conn);  
?>