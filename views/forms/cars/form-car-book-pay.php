<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<form id="payment-form" class="flex flex-col justify-between w-full">
  <div id="card-element" class="flex flex-col justify-between w-full"></div>
  <button id="submit">Pagar</button>
  <div id="error-message"></div>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe('pk_test_51RLMoJPbBgCevtAVM56KGc8qoSIFFNFmcvm0Hw3Nzz1XaVI5Ezr1NU1S5mc9UFXudEULLN917pKDVDUMic4yt5DN00sY6PLas9'); 
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const res = await fetch('/car-rent-services/views/db/cars/db-car-book-pay.php', { method: 'POST' });
    const { clientSecret } = await res.json();

    const result = await stripe.confirmCardPayment(clientSecret, {
      payment_method: { card: card }
    });

    if (result.error) {
      document.getElementById('error-message').textContent = result.error.message;
    } else {
      if (result.paymentIntent.status === 'succeeded') {
        window.location.href = '/car-rent-services/views/db/reservations/db-reservation-confirm.php';
      }
    }
  });
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>