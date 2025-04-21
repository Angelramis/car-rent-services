<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">Update reservation</h1>
<main>
<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha hecho submit form, iniciar gestión
  if (isset($_POST['form_reservation_update'])) {
    
    // Guardar en variables inputs values igual llamado que en BBDD
    $reservation_number = htmlspecialchars($_POST['reservation_number']);
    $user_fullname = htmlspecialchars($_POST['user_fullname']);
    $user_nif = htmlspecialchars($_POST['user_nif']);
    $premise_number = htmlspecialchars($_POST['premise_number']);
    $date_in = htmlspecialchars($_POST['date_in']);
    $date_out = htmlspecialchars($_POST['date_out']);
    $reservation_date = htmlspecialchars($_POST['reservation_date']);
    $reservation_state = htmlspecialchars($_POST['reservation_state']);

    // Consulta UPDATE SQL con datos obtenidos.
    $sql_query = "UPDATE 073_reservations SET 
                  premise_number = '$premise_number', 
                  date_in = '$date_in', 
                  date_out = '$date_out', 
                  reservation_date = '$reservation_date',
                  reservation_state = '$reservation_state'
                  WHERE reservation_number = $reservation_number;";


    // Ejecutar consulta SQL a la BBDD
    $execute_query = mysqli_query($conn, $sql_query);

    // Verificar si la consulta se ha ejecutado correctamente
    if ($execute_query) {
        echo "Reservation updated succesfully.<br>";
          
         // Consulta para obtener datos actualizados
         $query_select = "SELECT * 
                          FROM `073_reservations` 
                          WHERE reservation_number = $reservation_number;";
                          
         $result_query = mysqli_query($conn, $query_select);
 
         // Verificar si se ha obtenido resultado
         if ($result_query && mysqli_num_rows($result_query) > 0) {
             // Obtener el resultado y mostrarlo
             while ($row = mysqli_fetch_assoc($result_query)) {
              ?>
              <div class='product_div'>
                <p> User ID: <?php echo $row['user_id'];?></p>
                <p> Premise ID: <?php echo $row['premise_id'];?></p>
                <p> Date in: <?php echo $row['date_in'];?></p>
                <p> Date out: <?php echo $row['date_out'];?></p>
                <p> Reservation date: <?php echo $row['reservation_date'];?></p>
                <p> Reservation state: <?php echo $row['reservation_state'];?></p>
              </div>
              <?php
             }
         } else {
             echo "Updated premise not found: " . mysqli_error($conn);
         }
     } else {
         echo "Error updating the premise: " . mysqli_error($conn);
     }
 }
 
 // Cerrar conexión con la BBD una vez acabada la consulta
 mysqli_close($conn);
?>  
</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>