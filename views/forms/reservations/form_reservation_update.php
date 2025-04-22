<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /car-rent-services/index.php");
    exit();
  }
?>

<?php
  // Capture variables
  $reservation_number = htmlspecialchars($_POST['reservation_number']);
  $user_fullname = "";
  $user_nif = "";
  $premise_number = "";
  $date_in = "";
  $date_out = "";
  $reservation_date = "";
  $reservation_state = "";
  $reservation_extras_json = "";

  // Incluir conexión
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón de submit, iniciar consulta.
  if (isset($_POST['form_reservation_update_call_id'])) {

    // Consulta SQL para obtener los datos
    $sql_query = "SELECT * 
                  FROM `073_reservations_view`
                  WHERE reservation_number = $reservation_number;";

    // Ejecutar consulta SQL
    $result_query = mysqli_query($conn, $sql_query);

    // Verificar si se ha obtenido resultado
    if ($result_query && mysqli_num_rows($result_query) > 0) {
      // Guardar cada resultado en variable para luego incluirlo en values de formulario
      while ($row = mysqli_fetch_assoc($result_query)) {
        $reservation_number = $row['reservation_number'];
        $user_fullname = $row['user_fullname'];
        $user_nif = $row['user_nif'];
        $premise_number = $row['premise_number'];
        $date_in = $row['date_in'];
        $date_out = $row['date_out'];
        $reservation_date = $row['reservation_date'];
        $reservation_state = $row['reservation_state'];
        $reservation_extras_json = $row['reservation_extras_json'];
      }
    } else {
        echo "Element ID not found: " . mysqli_error($conn);
    }
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  // Cerrar conexión con la BBDD una vez acabada la consulta
  mysqli_close($conn);
?>

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl p-2">Update reservation</h1>
    <p>Change the reservation state</p>

    <form action="/car-rent-services/views/db/reservations/db_reservation_update.php" method="POST">
      <input type="hidden" name="reservation_number" value="<?php echo $reservation_number; ?>"> <!-- Campo oculto para enviar a fichero db. -->
  
      <label>User Fullname</label>
      <p class="standard_input  read-only-input"> <?php echo $user_fullname;?> </p>

      <label>Premise number</label>
      <p class="standard_input "> <?php echo $premise_number;?> </p>

      <label>Date in</label>
      <p class="standard_input "> <?php echo $date_in; ?> </p>

      <label>Date out</label>
      <p class="standard_input "> <?php echo $date_out; ?> </p>

      <label>Reservation date</label>
      <p class="standard_input "> <?php echo $reservation_date; ?> </p>
      
      <label>Reservation state</label>

      <?php // Si está cancelada, no permitir cambiar la opción
      if ($reservation_state == 'Cancelled') {
        ?>
          <select name="reservation_state" class="standard_input">
            <option value="Cancelled" selected>Cancelled</option>
          </select>
        <?php
      } else {
        ?>
         <select name="reservation_state" class="standard_input">
          <option value="Booked" <?php if ($reservation_state == 'Booked') {echo 'selected';} ?>>Booked</option>
          <option value="Check-in" <?php if ($reservation_state == 'Check-in') {echo 'selected';} ?>>Check-in</option>
          <option value="Check-out" <?php if ($reservation_state == 'Check-out') {echo 'selected';} ?>>Check-out</option>
          <option value="Cancelled" <?php if ($reservation_state == 'Cancelled') {echo 'selected';} ?>>Cancelled</option>
        </select>
        <?php
      }
      ?>

      <input type="submit" value="Submit" name="form_reservation_update" class="button_action">
    </form>
  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>
