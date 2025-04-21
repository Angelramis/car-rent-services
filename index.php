<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<head>
  <link rel="stylesheet" href="/student073/dwes/css/index.css">
  <link rel="stylesheet" href="/student073/dwes/css/reviews.css">
</head>


<main class="gap-2">
  <h2 class="text-xl">Welcome, <?php echo $session_user_firstname; ?></h2>

  <h1 class="title">Hilton Hotel</h1>

  <img src="/student073/dwes/assets/images/general/main_photo_hotel.jpg" class="hotel_main_image">

  <p class="subtitle">Welcome to Hilton Hotel, your ideal retreat in Cancun. Our hotel combines elegance, comfort and exceptional service to offer you an unforgettable experience.</p>

  <a href="/student073/dwes/views/forms/premises/form_premise_book.php" class="p-2">
    <input type="button" value="Book now" class="button_action">
  </a>

  <p class="subtitle">Experience unparalleled elegance and world-class service at Hilton, where luxury meets 
                      comfort in every detail for an unforgettable stay.</p>

  <img src="/student073/dwes/assets/images/general/hilton_exterior.jpg" class="hotel_main_image">

  <p class="subtitle">See what our customers say about us</p>

  <a href="/student073/dwes/views/forms/users/form_user_review_send.php" class="button_action">Create review</a>

  <div class="reviews-list">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/users/db_users_reviews_show.php'; ?>
  </div>

</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>