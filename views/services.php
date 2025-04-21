<?php
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<main>
  <h1 class="title">Our services</h1>

  <div class="div_content_available">
    <div class='product_div'>
      <img src="/student073/dwes/assets/images/general/gym.jpg" class="photo_preview">
      <div class="info_preview">
        <p>Gym</p>
        <small>Stay fit and energized with our state-of-the-art gym, equipped with the latest cardio machines and free weights. Perfect for all your fitness needs.</small>
        </a>
      </div>
    </div>

    <div class='product_div'>
      <img src="/student073/dwes/assets/images/general/spa.jpg" class="photo_preview">
      <div class="info_preview">
        <p>Spa</p>
        <small>Relax and rejuvenate in our luxurious spa, offering a range of treatments designed to soothe your body and mind. Experience tranquility like never before.</small>
      </div>
    </div>

    <div class='product_div'>
      <img src="/student073/dwes/assets/images/general/restaurant.jpg" class="photo_preview">
      <div class="info_preview">
        <p>Restaurant</p>
        <small>Indulge in a culinary journey at our restaurant, where exquisite flavors and a delightful ambiance come together for an unforgettable dining experience.</small>
      </div>
    </div>
  </div>
  <form action="/student073/dwes/views/forms/reservations/form_service_book.php" method="POST">
      <input type="submit" value="Book now" class="button_action" name="form_service_pick">
  </form>
</main>

<?php
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>