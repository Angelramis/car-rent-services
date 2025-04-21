<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<main>
  <h1 class="text-center text-2xl p-3">All premises</h1>
  <div class="div_content_available">
    <?php
      // include conexion a bbdd
      include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

      // Si se ha pulsado el botón de submit, iniciar consulta.
      if (isset($_POST['form_premise_select'])) {
        // Guardar consulta SQL
        $sql_query = "SELECT * FROM 073_premises";

        // Ejecutar consulta SQL con BBDD
        $result_query = mysqli_query($conn, $sql_query);

        // Mostrar resultados, obteneniendo e imprimiendo cada fila existente.
        while ($row = mysqli_fetch_assoc($result_query)) {
          ?>
          <div class='product_div'>
            <p>Premise number: <?php echo $row['premise_number']; ?></p>
            <p>Beds quantity: <?php echo $row['beds_quantity']; ?></p>
            <p>Rooms quantity: <?php echo $row['rooms_quantity']; ?></p>
            <p>Price per day: <?php echo $row['price_per_day']; ?></p>
            <p>Status: <?php echo $row['premise_status']; ?></p>
          </div>
          <?php
        }
      }

      // Cerrar conexión con BBD una vez acabada la consulta
      mysqli_close($conn);
    ?>  
  </div>
</main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>