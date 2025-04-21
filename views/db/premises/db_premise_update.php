<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">Updated premise</h1>
<main>
  
<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha hecho submit form, iniciar gestión
  
  if (isset($_POST['form_premise_update'])) {
    // Guardar en variables inputs values igual llamado que en BBDD
    $premise_id = htmlspecialchars($_POST['premise_id']);
    $premise_category = htmlspecialchars($_POST['premise_category']);
    $premise_number = htmlspecialchars($_POST['premise_number']);
    $beds_quantity = htmlspecialchars($_POST['beds_quantity']);
    $rooms_quantity = htmlspecialchars($_POST['rooms_quantity']);
    $price_per_day = htmlspecialchars($_POST['price_per_day']);
    $premise_status = htmlspecialchars($_POST['premise_status']);


    // Consulta UPDATE SQL con datos obtenidos.
    $sql_query = "UPDATE `073_premises` SET 
                  premise_category_id = '$premise_category', 
                  premise_number = '$premise_number',
                  beds_quantity = '$beds_quantity', 
                  rooms_quantity = '$rooms_quantity', 
                  price_per_day = '$price_per_day', 
                  premise_status = '$premise_status' 
                  WHERE premise_id = $premise_id;";


    // Ejecutar consulta SQL a la BBDD
    $execute_query = mysqli_query($conn, $sql_query);


    // Verificar si la consulta se ha ejecutado correctamente
    if ($execute_query) {
        echo "Premise updated succesfully.<br>";
          
         // Consulta para obtener datos actualizados
         $query_select = "SELECT * FROM 073_premises WHERE premise_id = $premise_id;";
         $result_query = mysqli_query($conn, $query_select);
 
         // Verificar si se ha obtenido resultado
         if ($result_query && mysqli_num_rows($result_query) > 0) {
             // Obtener el resultado y mostrarlo
             while ($row = mysqli_fetch_assoc($result_query)) {
              ?>
              <div class='product_div'>
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
             echo "Updated premise not found: " . mysqli_error($conn);
         }
     } else {
         echo "Error updating the premise: " . mysqli_error($conn);
     }
 }
 
 // Cerrar conexión con la BBD una vez acabada la consulta
 mysqli_close($conn);
?>  




<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>