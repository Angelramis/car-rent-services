<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<main>
<h1 class="text-center text-2xl p-3">Updated user</h1>

<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha hecho submit form, iniciar gestión
  if (isset($_POST['form_user_update'])) {

    // Guardar en variables inputs values igual llamado que en BBDD
    $user_id = htmlspecialchars($_POST['user_id']);
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_pwd = htmlspecialchars($_POST['user_pwd']);
    $user_roles = htmlspecialchars($_POST['user_roles']);
    $user_firstname = htmlspecialchars($_POST['user_firstname']);
    $user_lastname = htmlspecialchars($_POST['user_lastname']);
    $user_nif = htmlspecialchars($_POST['user_nif']);
    $user_phone = htmlspecialchars($_POST['user_phone']);
    $user_address = htmlspecialchars($_POST['user_address']);
    $user_country = htmlspecialchars($_POST['user_country']);
  
    // Consulta UPDATE SQL con datos obtenidos.
    $sql_query = "UPDATE `073_users` SET
                  user_email =  '$user_email',
                  user_pwd =  '$user_pwd',
                  user_roles =  '$user_roles',
                  user_firstname = '$user_firstname', 
                  user_lastname = '$user_lastname', 
                  user_nif = '$user_nif', 
                  user_phone = '$user_phone', 
                  user_country = '$user_country'
                  WHERE user_id = $user_id;";

    // Ejecutar consulta SQL a la BBDD
    $execute_query = mysqli_query($conn, $sql_query);

    // Verificar si la consulta se ha ejecutado correctamente
    if ($execute_query) {
          
         // Consulta para obtener datos actualizados
         $query_select = "SELECT * 
                          FROM `073_users`
                          WHERE user_id = $user_id;";
                          
         $result_query = mysqli_query($conn, $query_select);
 
         // Verificar si se ha obtenido resultado
         if ($result_query && mysqli_num_rows($result_query) > 0) {
             // Obtener el resultado y mostrarlo
             while ($row = mysqli_fetch_assoc($result_query)) {
              ?>
              <div class='product_div'>
                <p> User ID: <?php echo $row['user_id']?></p>
                <p> Email: <?php echo $row['user_email']?></p>
                <p> Password: <?php echo $row['user_pwd']?></p>
                <p> Roles: <?php echo $row['user_roles']?></p>
                <p> Firstname: <?php echo $row['user_firstname']?></p>
                <p> Lastname: <?php echo $row['user_lastname']?></p>
                <p> NIF: <?php echo $row['user_nif']?></p>
                <p> Phone: <?php echo $row['user_phone']?></p>
                <p> Address: <?php echo $row['user_address']?></p>
                <p> Country: <?php echo $row['user_country']?></p>
              </div>
              <?php
             }
         } else {
             echo "Updated element not found: " . mysqli_error($conn);
         }
     } else {
         echo "Error updating the element: " . mysqli_error($conn);
     }
 }
 
 // Cerrar conexión con la BBD una vez acabada la consulta
 mysqli_close($conn);
?>  

</main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>