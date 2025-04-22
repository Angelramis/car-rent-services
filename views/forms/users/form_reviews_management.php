<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
  
  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin')) { // Si no es admin
    header("Location: /car-rent-services/index.php");
    exit();
  }
?>
<head>
  <link rel="stylesheet" href="/car-rent-services/css/reviews.css">
</head>

<?php

// Incluir conexión a la base de datos
include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

// Consultar las reviews aceptadas
$sql_select_reviews = "SELECT review_id, user_firstname, user_lastname, review_date, review_comment, review_rate 
                        FROM `073_reviews`
                        JOIN `073_users` ON 073_reviews.user_id = 073_users.user_id
                        WHERE review_accepted = '0'
                        AND review_reviewed = '0'
                        ORDER BY review_date DESC;";

$execute_query = mysqli_query($conn, $sql_select_reviews);

$reviews = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);

?>

<main>
  <div class="div_border widther">
  <h1 class="text-center text-2xl mb-4">Pending reviews</h1>
  <div class="div_content_available">
    <?php
      if ($reviews) {

      foreach ($reviews as $review) {
        ?>
        <div class="product_div">
          <div class="review-head">
            <p><?php echo $review['user_firstname'] . " " . $review['user_lastname'] ?></p>
            <p><?php echo $review['review_rate']?>/5</p>
            <p><?php echo $review['review_date']?></p>
          </div>
          <p class="review-comment"><?php echo $review['review_comment']?></p>
          <form action="/car-rent-services/views/db/users/db_review_update.php" method="POST">
            <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
            <button type="submit" name="form_review_update" value="1" class="button_action">Accept</button>
            <button type="submit" name="form_review_update" value="0" class="button_action">Refuse</button>
          </form>
        </div>
        <?php
      }
    } else {
      ?>
      <p>There are no reviews to check.</p>
      <?php
    }
    
    ?>
    </div>
  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>