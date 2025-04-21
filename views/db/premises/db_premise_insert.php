<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">New Premise</h1>
<main>

<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón form submit, iniciar gestión
  if (isset($_POST['form_premise_insert'])) {

    // Guardar en variables inputs values -> llamar todo igual que en BBDD
    $premise_category = htmlspecialchars($_POST['premise_category']);
    $premise_number = htmlspecialchars($_POST['premise_number']);
    $beds_quantity = htmlspecialchars($_POST['beds_quantity']);
    $rooms_quantity = htmlspecialchars($_POST['rooms_quantity']);
    $price_per_day = htmlspecialchars($_POST['price_per_day']);
    $premise_status = htmlspecialchars($_POST['premise_status']);

    // Gestión de la imagen
    $target_dir = $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/assets/images/premises/'; // Carpeta donde guardar imagen
    $max_image_size = 2 * 1024 * 1024; // 2MB
    $min_width = 800;
    $min_height = 400;

    // Guardar consulta SQL
    $sql_query = 
    "INSERT INTO 073_premises(premise_category_id, premise_number, beds_quantity, rooms_quantity, price_per_day, premise_status, premise_image)
    VALUES('$premise_category', '$premise_number', '$beds_quantity', '$rooms_quantity', '$price_per_day', '$premise_status', '$image_path');"
    ;

    // Guardar consulta de muestra por pantalla del resultado de la consulta
    $query_select = "SELECT * 
                  FROM `073_premises`
                  ORDER BY premise_id DESC
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
                <h2 class='text-xl font-bold'> Premise: </h2>
                <p> Premise ID:<?php echo $row['premise_id']?></p>
                <p> Category ID: <?php echo $row['premise_category_id'] ?></p>
                <p> Premise Number: <?php echo $row['premise_number'] ?></p>
                <p> Beds Quantity: <?php echo $row['beds_quantity'] ?></p>
                <p> Rooms Quantity: <?php echo $row['rooms_quantity'] ?></p>
                <p> Price per Day: <?php echo $row['price_per_day'] ?></p>
                <p> Premise Status: <?php echo $row['premise_status'] ?></p>
              </div>
              <?php
            }
         } else { 
      echo "No se ha encontrado el resultado de la consulta" . mysqli_error($con);
    }
  } else {
    echo "Error con la consulta" . mysqli_error($con);
  }
}

  // Cerrar conexión con BBD una vez acabada la consulta
  mysqli_close($conn);
?>  

</main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>