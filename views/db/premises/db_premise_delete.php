<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">Deleted premise</h1>
<main>

<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

   // Si se ha pulsado el botón form submit, iniciar gestión
   if (isset($_POST['form_premise_delete'])) {
    
    // Guardar en variables inputs values -> llamar todo igual que en BBDD
    $premise_id = htmlspecialchars($_POST['premise_id']);

    // Guardar consulta SQL
    $sql_query = "DELETE FROM 073_premises 
                  WHERE premise_id = $premise_id;";

    // Ejecutar la consulta SQL
    $result_query = mysqli_query($conn, $sql_query);

    // Verificar si la consulta ha funcionado
    if ($result_query) {
        // Verificar si se ha afectado alguna fila
        if (mysqli_affected_rows($conn) > 0) {
          ?>
            <p>The premise with id <?php echo $premise_id ?> was successfully deleted.</p>
          <?php
        } else {
            echo "No premise found with id " . $premise_id;
        }
    } else {
        // Gestión de error 
        echo "Error deleting premise: " . mysqli_error($conn) . " Puede tener reservas asignadas.";
    }
  }

  // Cerrar conexión con BBD una vez acabada la consulta
  mysqli_close($conn);
?>  

</main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>