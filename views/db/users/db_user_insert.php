<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">New user</h1>
<main>

<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón form submit, iniciar gestión
  if (isset($_POST['form_user_insert'])) {
    
    // Guardar en variables inputs values -> llamar todo igual que en BBDD
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_pwd = htmlspecialchars($_POST['user_pwd']);
    $user_roles = htmlspecialchars($_POST['user_roles']);
    $user_firstname = htmlspecialchars($_POST['user_firstname']);
    $user_lastname = htmlspecialchars($_POST['user_lastname']);
    $user_nif = htmlspecialchars($_POST['user_nif']);
    $user_phone = htmlspecialchars($_POST['user_phone']);
    $user_address = htmlspecialchars($_POST['user_address']);
    $user_country = htmlspecialchars($_POST['user_country']);

    // Guardar consulta SQL
    $sql_query = 
    "INSERT INTO `073_users`(user_email, user_pwd, user_roles, user_firstname, user_lastname, user_nif, user_phone, user_address, user_country)
    VALUES('$user_email', '$user_pwd', '$user_roles', '$user_firstname', '$user_lastname', '$user_nif', '$user_phone', '$user_address', '$user_country');"
    ;

    // Guardar consulta de muestra por pantalla del resultado de la consulta
    $query_select = "SELECT * 
                      FROM `073_users`
                      ORDER BY user_id DESC
                      LIMIT 1;";
    
     // Ejecutar consulta SQL a la BBDD
     $execute_query = mysqli_query($conn, $sql_query);

     if ($execute_query) {
          //Guardar resultado de la consulta
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
      echo "No se ha encontrado el resultado de la consulta" . mysqli_error($conn);
    }
  } else {
    echo "Error con la consulta" . mysqli_error($conn);
  }
}

  // Cerrar conexión con BBD una vez acabada la consulta
  mysqli_close($conn);
?>  

</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>