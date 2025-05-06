<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<?php

require $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

$car_id = $_POST['car-id'];
$pickup_date = $_POST['pickup-date'];
$pickup_time = $_POST['pickup-time'];
$dropoff_date = $_POST['dropoff-date'];
$dropoff_time = $_POST['dropoff-time'];
$extras_data = $_POST['extras-data'];

$query = "SELECT car_price_per_day FROM cars WHERE car_id = $car_id";
$result = mysqli_query($conn, $query);
$car_price_per_day = 0;
if ($row = mysqli_fetch_assoc($result)) {
    $car_price_per_day = $row['car_price_per_day'];
}

?>

<form id="payment-form" class="flex flex-col justify-between w-full">
  <div id="card-element" class="flex flex-col justify-between w-full"></div>
  <button id="submit">Pagar</button>
  <div id="error-message"></div>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>const carPricePerDay = <?php echo $car_price_per_day; ?>;</script>

<script>
  const carId = "<?php echo $car_id; ?>";
  const pickupDate = "<?php echo $pickup_date; ?>";
  const pickupTime = "<?php echo $pickup_time; ?>";
  const dropoffDate = "<?php echo $dropoff_date; ?>";
  const dropoffTime = "<?php echo $dropoff_time; ?>";
  const extras = <?php echo $extras_data; ?>;

   // Calcular número de días
   const date1 = new Date(pickupDate);
  const date2 = new Date(dropoffDate);
  const days = Math.max(1, Math.ceil((date2 - date1) / (1000 * 60 * 60 * 24)));

  const rentPrice = days * carPricePerDay;

  let total = rentPrice;
  extras.forEach(item => {
    total += item.qty * item.price;
  });

  const stripe = Stripe('pk_test_51RLMoJPbBgCevtAVM56KGc8qoSIFFNFmcvm0Hw3Nzz1XaVI5Ezr1NU1S5mc9UFXudEULLN917pKDVDUMic4yt5DN00sY6PLas9');
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Enviar los datos del formulario al servidor para crear el PaymentIntent y obtener el clientSecret
    const formData = new FormData();
    formData.append('car-id', carId);
    formData.append('pickup-date', pickupDate);
    formData.append('pickup-time', pickupTime);
    formData.append('dropoff-date', dropoffDate);
    formData.append('dropoff-time', dropoffTime);
    formData.append('extras-data', JSON.stringify(extras));
    formData.append('total-amount', total.toFixed(2));

    const response = await fetch('/car-rent-services/views/db/cars/db-car-book-pay.php', {
      method: 'POST',
      body: formData
    });

    const data = await response.json();

    // Asegurarse de que el clientSecret se ha recibido
    const clientSecret = data.clientSecret;

    if (clientSecret) {
      // Confirmar el pago
      const result = await stripe.confirmCardPayment(clientSecret, {
        payment_method: {
          card: card
        }
      });

      if (result.error) {
        document.getElementById('error-message').textContent = result.error.message;
      } else {
        if (result.paymentIntent.status === 'succeeded') {
          // Crear formulario oculto para enviar datos por POST
          const confirmForm = document.createElement('form');
          confirmForm.method = 'POST';
          confirmForm.action = '/car-rent-services/views/db/reservations/db-reservation-confirm.php';

          const addField = (name, value) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            confirmForm.appendChild(input);
          };

          addField('car-id', carId);
          addField('pickup-date', pickupDate);
          addField('pickup-time', pickupTime);
          addField('dropoff-date', dropoffDate);
          addField('dropoff-time', dropoffTime);
          addField('extras-data', JSON.stringify(extras));

          document.body.appendChild(confirmForm);
          confirmForm.submit();
        }

      }
    } else {
      document.getElementById('error-message').textContent = 'Hubo un error al crear el pago. Intenta nuevamente.';
    }
  });
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>