<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>
<?php
  // Mandar usuario a log in si no ha iniciado sesión
  if ($session_user_id == 'guest') {
    header("Location: /car-rent-services/views/forms/users/form_user_login.php"); 
  }
?>
<head>
  <link rel="stylesheet" href="/car-rent-services/css/reviews.css">
</head>

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl">Create review</h1>
    <form action="/car-rent-services/views/db/users/db_user_review_send.php" method="POST">
      <label>Review</label>
      <textarea name="review-comment"  rows="4" cols="50" id="review-comment" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500"></textarea>

      <label>Rate</label>
      <select name="review-rate" id="review-rate" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500">
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

