<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

if (isset($_POST['form-car-details'])) {
  $car_id = htmlspecialchars($_POST['car-id']);
  $pickup_date = htmlspecialchars($_POST['pickup-date']);
  $pickup_time = htmlspecialchars($_POST['pickup-time']);
  $dropoff_date = htmlspecialchars($_POST['dropoff-date']);
  $dropoff_time = htmlspecialchars($_POST['dropoff-time']);

  $sql_query_car = "SELECT * 
                    FROM cars 
                    WHERE car_id = $car_id;";

  $sql_query_extras = "SELECT * 
                      FROM extras;";

  $execute_query_car = mysqli_query($conn, $sql_query_car);
  $execute_query_extras = mysqli_query($conn, $sql_query_extras);

  $car_details = mysqli_fetch_assoc($execute_query_car);
  $extras = mysqli_fetch_all($execute_query_extras, MYSQLI_ASSOC);

  if ($execute_query_car && $extras && mysqli_num_rows($execute_query_car) > 0) {

    $pickup = new DateTime($pickup_date);
    $dropoff = new DateTime($dropoff_date);
    $rent_days_interval = $pickup->diff($dropoff);

    $rent_price = $car_details['car_price_per_day'] * ($rent_days_interval->days);
?>

    <form id="extras-form" method="POST" action="">
      <input type="hidden" name="car-id" value="<?php echo $car_id; ?>">
      <input type="hidden" name="pickup-date" value="<?php echo $pickup_date; ?>">
      <input type="hidden" name="pickup-time" value="<?php echo $pickup_time; ?>">
      <input type="hidden" name="dropoff-date" value="<?php echo $dropoff_date; ?>">
      <input type="hidden" name="dropoff-time" value="<?php echo $dropoff_time; ?>">
      <input type="hidden" name="extras-data" id="extras-data">
    </form>

    <div class="flex flex-col h-auto bg-white shadow-md rounded-md max-w-4xl mx-auto w-full p-4">
      <p class="font-semibold text-gray-900">Car Rent Services (<?= __('Menorca', $lang); ?>)</p>
      <p class="text-gray-600 text-sm"><?php echo $pickup_date . " - " . $pickup_time . "h to " . $dropoff_date . " - " . $dropoff_time . "h"; ?></p>
    </div>

    <div class="border border-gray-300 rounded-lg shadow-md !p-3 !mt-2 bg-white w-full">
      <div class="flex flex-col gap-2 md:flex-row md:justify-between">
        <h3 class="text-lg font-bold"><?php echo $car_details['car_brand'] . " " . $car_details['car_model']; ?> <small><?= __('or similar', $lang); ?></small></h3>
      </div>
      <div class="flex flex-col items-center relative mt-2 md:flex-row-reverse gap-2">
        <div>
          <img src="<?php echo $car_details['car_image']; ?>" alt="Car image" class="max-w-full lg:max-w-none w-full rounded-lg">
        </div>
        <ul class="text-gray-800 space-y-2 text-sm basis-3/4 w-full">
          <li class="flex items-center"><img src="/car-rent-services/assets/icons/car-transmission.png" class="w-6" alt="Transmission"><span class="ml-1"><?php echo $car_details['car_fuel']; ?></span></li>
          <li class="flex items-center"><img src="/car-rent-services/assets/icons/gas-fuel.png" class="w-6" alt="Fuel"><span class="ml-1"><?= __('Full To Full', $lang); ?></span></li>
          <li class="flex items-center"><img src="/car-rent-services/assets/icons/car-mileage.png" class="w-6" alt="Mileage"><span class="ml-1"><?= __('Mileage', $lang); ?>: <?php echo $car_details['car_unlimited_mileage'] ? 'Unlimited' : 'Limited'; ?></span></li>
          <li class="flex items-center"><img src="/car-rent-services/assets/icons/basic-insurance.png" class="w-6" alt="Insurance"><span class="ml-1"><?= __('Basic insurance with franchise', $lang); ?></span></li>
          <li class="flex items-center"><img src="/car-rent-services/assets/icons/credit-card.png" class="w-6" alt="Deposit"><span class="ml-1"><?= __('Required deposit', $lang); ?></span></li>
        </ul>
      </div>

      <div class="mt-4 mb-4 p-4 border border-gray-300 rounded-md">
        <div class="pt-2 mt-2">
          <h3 class="font-semibold text-lg mb-2"><?= __('Available extras', $lang); ?></h3>
          <?php foreach ($extras as $extra) { ?>
            <div class="extra-div flex flex-col mb-4 md:flex-row md:justify-between">
              <p class="text-sm font-medium extra-name"><?= __($extra['extra_name'], $lang) ?></p>
              <div class="flex flex-row gap-2 md:flex-row-reverse">
                <p class="text-sm font-medium"><?php echo $extra['extra_unit_price']; ?>€</p>
                <?php if ($extra['extra_checkbox'] == 1) { ?>
                  <input type="checkbox" class="extra-input w-5 h-5" data-type="checkbox" data-price="<?php echo $extra['extra_unit_price']; ?>">
                <?php } else { ?>
                  <input type="number" id="child-seat-input" class="extra-input h-5" data-type="number" data-price="<?php echo $extra['extra_unit_price']; ?>" min="0" max="5" value="0">
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <div id="error-div" class="w-full shadow-md bg-red-500 p-2 my-2 min-h-12 text-white rounded-md hidden flex-row items-center gap-2">
        <img class="w-6" src="/car-rent-services/assets/icons/error.png" alt="Error icon">
        <p id="error-text"></p>
      </div>

      <div class="bg-gradient-to-b from-blue-300 to-blue-100 p-4 rounded-lg">
        <p class="text-center font-bold"><?= __('Reservation', $lang); ?></p>
        <div class="flex items-center justify-between border-b py-2">
          <span class="text-sm font-medium"><?= __('Rent', $lang); ?></span>
          <span class="text-sm font-medium"><?php echo number_format($rent_price, 2); ?>€</span>
        </div>
        <div id="selected-extras-list" class="text-sm text-gray-700 space-y-1 mt-2"></div>
        <div class="flex items-center justify-between py-2">
          <span class="text-sm font-bold"><?= __('Total', $lang); ?></span>
          <span class="text-sm font-bold" id="total-price"><?php echo $rent_price; ?>€</span>
        </div>
      </div>
      <?php if ($session_user_id != 'guest'): ?>
        <div class="w-full mt-4 space-y-4">
          <div>
            <label class="block text-sm font-medium mb-1 text-gray-700" for="card-number-element"><?= __('Card number', $lang); ?></label>
            <div id="card-number-element" class="StripeElement p-3 rounded border border-gray-300 bg-white"></div>
          </div>

          <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
              <label class="block text-sm font-medium mb-1 text-gray-700" for="card-expiry-element"><?= __('Expiration date', $lang); ?></label>
              <div id="card-expiry-element" class="StripeElement p-3 rounded border border-gray-300 bg-white"></div>
            </div>

            <div class="flex-1">
              <label class="block text-sm font-medium mb-1 text-gray-700" for="card-cvc-element"><?= __('CVC', $lang); ?></label>
              <div id="card-cvc-element" class="StripeElement p-3 rounded border border-gray-300 bg-white"></div>
            </div>
          </div>
        </div>

        <button id="submit" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-600 transition text-center block">Pay</button>
        <div id="loading-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
          <div class="bg-white rounded-lg shadow-lg p-6 flex items-center space-x-3">
            <img src="/car-rent-services/assets/icons/loading.png" alt="Loading" class="w-6 h-6 animate-spin">
            <span class="text-gray-800 font-semibold"><?= __('Processing transaction, please wait...', $lang); ?></span>
          </div>
        </div>

        <div id="error-message"></div>
      <?php else: ?>
        <div id="user-form-container" class="mt-4">
          <h2 class="text-xl font-bold mb-2"><?= __('Register to rent a car', $lang); ?></h2>
          <div class="mb-4 mt-2 text-gray-600 text-left">
            <a href="/car-rent-services/views/forms/users/form-user-login.php" class="text-blue-600"><?= __('Already have an account? Login here', $lang); ?></a>
          </div>
          <a href="/car-rent-services/views/forms/users/form-user-register.php">
            <button name="form-user-login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300"><?= __('Register', $lang); ?></button>
          </a>
        </div>
      <?php endif; ?>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
      const carId = "<?php echo $car_id; ?>";
      const pickupDate = "<?php echo $pickup_date; ?>";
      const pickupTime = "<?php echo $pickup_time; ?>";
      const dropoffDate = "<?php echo $dropoff_date; ?>";
      const dropoffTime = "<?php echo $dropoff_time; ?>";
      const baseRentPrice = <?php echo $rent_price; ?>;

      let selectedExtras = [];
      let totalAmount = baseRentPrice;

      const extrasInputs = document.querySelectorAll('.extra-input');
      const selectedExtrasList = document.getElementById('selected-extras-list');
      const totalPriceEl = document.getElementById('total-price');
      const extrasDataInput = document.getElementById('extras-data');

      function updateTotal() {
        selectedExtras = [];
        let extraTotal = 0;

        extrasInputs.forEach(input => {
          const price = parseFloat(input.dataset.price);
          const type = input.dataset.type;

          if (type === 'checkbox' && input.checked) {
            selectedExtras.push({
              name: input.closest('.extra-div').querySelector('.extra-name').textContent,
              quantity: 1,
              price
            });
            extraTotal += price;
          }

          if (type === 'number' && parseInt(input.value) > 0) {
            const qty = parseInt(input.value);
            selectedExtras.push({
              name: input.closest('.extra-div').querySelector('.extra-name').textContent,
              quantity: qty,
              price
            });
            extraTotal += price * qty;
          }
        });

        totalAmount = baseRentPrice + extraTotal;
        totalPriceEl.textContent = `${totalAmount.toFixed(2)}€`;

        // Actualizar lista de extras seleccionados
        selectedExtrasList.innerHTML = selectedExtras.map(e =>
          `<div class="flex justify-between"><span>${e.name} x${e.quantity}</span><span>${(e.price * e.quantity).toFixed(2)}€</span></div>`
        ).join("");

        // Actualizar campo hidden del form
        extrasDataInput.value = JSON.stringify(selectedExtras);
      }

      extrasInputs.forEach(input => {
        input.addEventListener('change', updateTotal);
      });

      // Inicializar cálculo por si hay valores precargados
      updateTotal();

      const stripe = Stripe('pk_test_51RLMoJPbBgCevtAVM56KGc8qoSIFFNFmcvm0Hw3Nzz1XaVI5Ezr1NU1S5mc9UFXudEULLN917pKDVDUMic4yt5DN00sY6PLas9');

      const elements = stripe.elements();
      const cardNumber = elements.create('cardNumber');
      const cardExpiry = elements.create('cardExpiry');
      const cardCvc = elements.create('cardCvc');

      cardNumber.mount('#card-number-element');
      cardExpiry.mount('#card-expiry-element');
      cardCvc.mount('#card-cvc-element');

      const form = document.getElementById('extras-form');
      const errorDiv = document.getElementById('error-message');

      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        document.getElementById('loading-popup').classList.remove('hidden');
        document.getElementById('submit').disabled = true;
        document.getElementById('submit').classList.add('opacity-50', 'cursor-not-allowed');

        const formData = new FormData();
        formData.append('car-id', carId);
        formData.append('pickup-date', pickupDate);
        formData.append('pickup-time', pickupTime);
        formData.append('dropoff-date', dropoffDate);
        formData.append('dropoff-time', dropoffTime);
        formData.append('extras-data', JSON.stringify(selectedExtras));
        formData.append('total-amount', totalAmount.toFixed(2));

        try {
          const response = await fetch('/car-rent-services/views/db/cars/db-car-book-pay.php', {
            method: 'POST',
            body: formData
          });

          const data = await response.json();

          if (!data.clientSecret) {
            hideLoadingPopup();
            errorDiv.textContent = "<?= __('The payment could not be generated. Please try again.', $lang); ?>";
            return;
          }

          const result = await stripe.confirmCardPayment(data.clientSecret, {
            payment_method: {
              card: cardNumber
            }
          });

          if (result.error) {
            hideLoadingPopup();

            errorDiv.textContent = result.error.message;
          } else if (result.paymentIntent.status === 'succeeded') {
            // Redireccionar o enviar datos para guardar la reserva
            const confirmForm = document.createElement('form');
            confirmForm.method = 'POST';
            confirmForm.action = '/car-rent-services/views/db/reservations/db-reservation-confirm.php';

            const addHiddenInput = (name, value) => {
              const input = document.createElement('input');
              input.type = 'hidden';
              input.name = name;
              input.value = value;
              confirmForm.appendChild(input);
            };

            addHiddenInput('car-id', carId);
            addHiddenInput('pickup-date', pickupDate);
            addHiddenInput('pickup-time', pickupTime);
            addHiddenInput('dropoff-date', dropoffDate);
            addHiddenInput('dropoff-time', dropoffTime);
            addHiddenInput('extras-data', JSON.stringify(selectedExtras));
            addHiddenInput('total-amount', totalAmount.toFixed(2));

            document.body.appendChild(confirmForm);
            confirmForm.submit();
          }
        } catch (error) {
          hideLoadingPopup();
          errorDiv.textContent = "<?= __('An error ocurred processing the payment.', $lang); ?>";
          console.error(error);
        }
      });
    </script>

    <script>
      document.getElementById('submit').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('extras-form').dispatchEvent(new Event('submit'));
      });
    </script>

    <script>
      function hideLoadingPopup() {
        document.getElementById('loading-popup').classList.add('hidden');
        document.getElementById('submit').disabled = false;
        document.getElementById('submit').classList.remove('opacity-50', 'cursor-not-allowed');
      }
    </script>

<?php
  } else {
    echo "<p class='text-red-500 text-center mt-4'>Error con la consulta: " . mysqli_error($conn) . "</p>";
  }
}

mysqli_close($conn);

include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>