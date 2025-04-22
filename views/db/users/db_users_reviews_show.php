<?php
  // Incluir conexión a la base de datos
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // Consultar las reviews aceptadas
  $sql_select_reviews = "SELECT user_firstname, user_lastname, review_date, review_comment, review_rate 
                          FROM `073_reviews`
                          JOIN `073_users` ON 073_reviews.user_id = 073_users.user_id
                          WHERE review_accepted = '1'
                          AND review_reviewed = '1'
                          ORDER BY review_date DESC
                          LIMIT 5;";

  $execute_query = mysqli_query($conn, $sql_select_reviews);

  $reviews = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);

  foreach ($reviews as $review) {
    ?>
    <div class="review-card">
      <div class="review-head">
        <p><?php echo $review['user_firstname'] . " " . $review['user_lastname'] ?></p>
        <p class="font-bold"><?php echo $review['review_rate']?>/5</p>
        <p><?php echo $review['review_date']?></p>
      </div>
      <p class="review-comment"><?php echo $review['review_comment']?></p>
    </div>
    <?php
  }

  // Cerrar conexión con la BBDD
  mysqli_close($conn);
?>