<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<main>
  <h1 class="title">Available premises</h1>

  <div class="div_content_available">
  <?php

    // include conexion a bbdd
    include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

    // Si se ha pulsado el botón de submit, iniciar consulta.
    if (isset($_POST['form_premise_book'])) {

      // Guardar datos introducidos en Cookies. Duración -> 7 días
      setcookie("date_in", $_POST['date_in'], time() + (7 * 24 * 60 * 60), "/");
      setcookie("date_out", $_POST['date_out'], time() + (7 * 24 * 60 * 60), "/");
      setcookie("guest_quantity", $_POST['guest_quantity'], time() + (7 * 24 * 60 * 60), "/");

      // Variables
      $date_in = htmlspecialchars($_POST['date_in']);
      $date_out = htmlspecialchars($_POST['date_out']);
      $guest_quantity = htmlspecialchars($_POST['guest_quantity']);

      // Seleccionar las permisas dentro de la disponibilidad introducida en fechas y en estado disponible.
      // haciendo un join con tabla premise_categories para obtener el nombre de la categoría.
      // Mostrandose en orden aleatorio.
      $sql_query = "SELECT p.*, c.premise_category_name 
                    FROM 073_premises AS p
                    JOIN 073_premise_categories AS c ON p.premise_category_id = c.premise_category_id
                    WHERE p.premise_status = 'Good'
                    AND p.premise_id NOT IN (
                      SELECT premise_id /* Reservas válidas dentro de fecha */
                      FROM 073_reservations
                      WHERE ('$date_in' < date_out) AND ('$date_out' > date_in)
                      AND reservation_state !='Cancelled'
                    )
                    AND beds_quantity >= '$guest_quantity'
                    ORDER BY RAND()";

      // Ejecutar consulta SQL con BBDD
      $result_query = mysqli_query($conn, $sql_query);
    
      // Mostrar resultados, obteniendo e imprimiendo cada fila existente.
      while ($row = mysqli_fetch_assoc($result_query)) {
        ?>
        <div class="product_div">
            <img src="/car-rent-services/assets/images/premises/001.jpg" class="photo_preview">
            <div class="info_preview">
              <p>Category: <?php echo $row['premise_category_name']; ?> </p>
              <p><?php echo $row['beds_quantity']; ?> bed(s)</p>
              <p><?php echo $row['rooms_quantity']; ?> room(s)</p>
              <p><?php echo $row['price_per_day']; ?>€/day</p>
            </div>
            <!-- Formulario para reservar premisa -->
            <form method="POST" action="/car-rent-services/views/db/premises/db_premise_book.php">
              <input type="hidden" name="premise_id" value="<?php echo $row['premise_id']; ?>">
              <input type="hidden" name="date_in" value="<?php echo $date_in; ?>">
              <input type="hidden" name="date_out" value="<?php echo $date_out; ?>">
              <input type="submit" value="Book" name="form_premise_book" class="button_action">
            </form>
        </div>
        <?php
    }
  }
  mysqli_close($conn);
  ?> 
  </div>  
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>