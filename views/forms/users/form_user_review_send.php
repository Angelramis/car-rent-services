<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>
<?php
  // Mandar usuario a log in si no ha iniciado sesión
  if ($session_user_id == 'guest') {
    header("Location: /student073/dwes/views/forms/users/form_user_login.php"); 
  }
?>
<head>
  <link rel="stylesheet" href="/student073/dwes/css/reviews.css">
</head>

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl">Create review</h1>
    <form action="/student073/dwes/views/db/users/db_user_review_send.php" method="POST">
      <label>Review</label>
      <textarea name="review-comment"  rows="4" cols="50" id="review-comment" class="standard_input"></textarea>

      <label>Rate</label>
      <select name="review-rate" id="review-rate" class="standard_input">
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
      </select>
      <input type="submit" value="Send" class="button_action" name="submit-form-review">
    </form>
  </div>
</main>


<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>

