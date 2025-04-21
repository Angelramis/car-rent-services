<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>
<main>
  <div class="border_div">
    <h1 class="text-center text-2xl p-3">Deleted reservation</h1>

    <?php
      // include conexion a bbdd
      include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

      // Si se ha pulsado el botón form submit, iniciar gestión
      if (isset($_POST['form_reservation_delete'])) {
        
        // Guardar en variables inputs values -> llamar todo igual que en BBDD
        $reservation_number = htmlspecialchars($_POST['reservation_number']);

        // Guardar consulta SQL
        $sql_query = "DELETE FROM 073_reservations 
                      WHERE reservation_number = $reservation_number;";

        // Ejecutar la consulta SQL
        $result_query = mysqli_query($conn, $sql_query);

        // Verificar si la consulta ha funcionado
        if ($result_query) {
            // Verificar si se ha afectado alguna fila
            if (mysqli_affected_rows($conn) > 0) {
                echo "The reservation with number " . $reservation_number . " was successfully deleted.";
            } else {
                echo "No reservation found with number " . $reservation_number;
            }
        } else {
            // Gestión de error 
            echo "Error deleting: " . mysqli_error($conn) . " Puede tener otras tablas asignadas.";
        }
      }


      // Cerrar conexión con BBD una vez acabada la consulta
      mysqli_close($conn);
    ?>  

  </div>
<main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>