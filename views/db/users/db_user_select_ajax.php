<?php
  // Datos introducidos en el input del form
  $query = htmlspecialchars(strval($_POST['query']));

  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  $sql_query ="SELECT * 
              FROM `073_users`
              WHERE user_nif LIKE '%$query%';";

  // Ejecutar consulta SQL
  $result_query = mysqli_query($conn, $sql_query);  

    // Mostrar resultados, obteneniendo e imprimiendo cada fila existente.
    while ($row = mysqli_fetch_assoc($result_query)) {
      ?>
      <div class='product_div'>
        <p> Email: <?php echo $row['user_email'];?></p>
        <p> Password: <?php echo $row['user_pwd'];?></p>
        <p> Roles: <?php echo $row['user_roles'];?></p>
        <p> Job category: <?php echo $row['user_job_category'];?></p>
        <p> Firstname: <?php echo $row['user_firstname'];?></p>
        <p> Lastname: <?php echo $row['user_lastname'];?></p>
        <p> NIF: <?php echo $row['user_nif'];?></p>
        <p> Phone: <?php echo $row['user_phone'];?></p>
        <p> Address: <?php echo $row['user_address'];?></p>
        <p> Country: <?php echo $row['user_country'];?></p>
      </div>
      <?php
    }

  // Cerrar conexión con DB
  mysqli_close($conn);
?>  
