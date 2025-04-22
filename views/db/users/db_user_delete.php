<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">Deleted user</h1>

<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

   // Si se ha pulsado el botón form submit, iniciar gestión
   if (isset($_POST['form_user_delete'])) {
    
    // Guardar en variables inputs values -> llamar todo igual que en BBDD
    $user_id = htmlspecialchars($_POST['user_id']);

    // Guardar consulta SQL
    $sql_query = "DELETE FROM 073_users 
                  WHERE user_id = $user_id;";

    // Ejecutar la consulta SQL
    $result_query = mysqli_query($conn, $sql_query);

    // Verificar si la consulta ha funcionado
    if ($result_query) {
        // Verificar si se ha afectado alguna fila
        if (mysqli_affected_rows($conn) > 0) {
          ?>
            <p>The user with id <?php echo $user_id ?> was successfully deleted</p>
          <?php
        } else {
            echo "No user found with id " . $user_id;
        }
    } else {
        // Gestión de error 
        echo "Error deleting user: " . mysqli_error($conn) . " Puede tener otras tablas asignadas.";
    }
  }

  // Cerrar conexión con BBD una vez acabada la consulta
  mysqli_close($conn);
?>  


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>