<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<main>
<h1 class="text-center text-2xl p-3">Review</h1>

<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // Si se ha hecho submit form, iniciar gestión
  if (isset($_POST['submit-form-review'])) {

    // Variables de los inputs
    $review_comment = htmlspecialchars($_POST['review-comment']);
    $review_rate = htmlspecialchars($_POST['review-rate']);
    $review_date = date('Y-m-d H:i:s');
    
    // Consultas SQL

    // Obtener reserva del cliente válida más reciente
    $sql_latest_reservation = "SELECT reservation_number, user_fullname 
                              FROM `073_reservations_view`
                              WHERE user_id = '$session_user_id'
                              AND reservation_state = 'Check-out'
                              OR reservation_state = 'Booked' -- para prueba temporal 
                              ORDER BY reservation_date DESC 
                              LIMIT 1;";

    $execute_query_latest_reservation = mysqli_query($conn, $sql_latest_reservation);

    if ($execute_query_latest_reservation) {
      // Obtener datos de la reserva
      $row = mysqli_fetch_assoc($execute_query_latest_reservation);
      $reservation_number = $row['reservation_number'];
      $user_fullname = $row['user_fullname'];

      // Insertar review
      $sql_insert_review = "INSERT INTO `073_reviews`
                            (user_id, reservation_number, review_date, review_comment, review_rate, review_accepted) 
                            VALUES ('$session_user_id', '$reservation_number', '$review_date', '$review_comment', '$review_rate', 'false');";

      try {
        $execute_query_review = mysqli_query($conn, $sql_insert_review);
      } catch (\Throwable $th) {
        echo "Error creating the review: Only one per completed reservation is accepted";
        ?>
          <a href="/car-rent-services/index.php">
            <button class="button_action">Home</button>
          </a>
        <?php
        exit();
      }

      // Verificar si la consulta se ha ejecutado correctamente
      if ($execute_query_review) {
        echo "Review created successfully";
        ?>
          <a href="/car-rent-services/index.php">
          <button class="button_action">Home</button>
        </a>
        <?php
        
      } else {
        echo "Error creating the review: " . mysqli_error($conn);
      }
    } else {
      echo "Error getting the reservation: " . mysqli_error($conn);
    }
 
    // Cerrar conexión con la BBDD
    mysqli_close($conn);
  }
?>  

</main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>