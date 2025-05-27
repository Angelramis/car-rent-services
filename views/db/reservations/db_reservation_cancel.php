<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/header.php';
?>


<main>
<h1 class="text-center text-2xl p-3">Cancel reservation</h1>
<?php

  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón form submit, iniciar gestión
  if (isset($_POST['form_reservation_cancel'])) {
    
    // Guardar en variables inputs de formulario
    $reservation_number = htmlspecialchars($_POST['reservation_number']);

    // Guardar consulta SQL
    $sql_query = 
    "UPDATE `073_reservations`
    SET reservation_state = 'Cancelled'
    WHERE reservation_number = $reservation_number;";

     
  // Guardar consulta de muestra por pantalla del resultado de la consulta
    $query_select = "SELECT reservation_number
                  FROM `073_reservations_view`
                  WHERE reservation_number = $reservation_number;";

     // Ejecutar consulta SQL a la BBDD
     $execute_query = pg_query($conn, $sql_query);
     
     if ($execute_query) {
          //Guardar resultado de la consulta
         $result_query = pg_query($conn, $query_select);
 
         // Verificar si se ha obtenido resultado
         if ($result_query) {
             
            // Obtener el resultado y mostrarlo
            while ($row = pg_fetch_assoc($result_query)) {
              ?>
                <div class='div_border'>
                  <p>The reservation with number <?php echo $row['reservation_number']?> has been sucessfully cancelled.</p>
                </div>
              <?php
            }
         } else { 
      echo "No se ha encontrado el resultado de la consulta" . pg_last_error($conn);
    }
  } else {
    echo "Error con la consulta" . pg_last_error($conn);
  }
}
  // Cerrar conexión con BBD una vez acabada la consulta
  pg_close($conn);
?>  

<a href="/index.php">
  <input type="button" value="Home" class="button_action">
</a>

</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/footer.php';
?>