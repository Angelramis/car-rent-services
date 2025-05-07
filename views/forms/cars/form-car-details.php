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

<form id="extras-form" method="POST" action="/car-rent-services/views/forms/cars/form-car-book-pay.php">
  <input type="hidden" name="car-id" value="<?php echo $car_id; ?>">
  <input type="hidden" name="pickup-date" value="<?php echo $pickup_date; ?>">
  <input type="hidden" name="pickup-time" value="<?php echo $pickup_time; ?>">
  <input type="hidden" name="dropoff-date" value="<?php echo $dropoff_date; ?>">
  <input type="hidden" name="dropoff-time" value="<?php echo $dropoff_time; ?>">
  <input type="hidden" name="extras-data" id="extras-data">
</form>

<div class="flex flex-col h-auto bg-white shadow-md rounded-md max-w-4xl mx-auto w-full p-4">
  <p class="font-semibold text-gray-900">Car Rent Services (Menorca)</p>
  <p class="text-gray-600 text-sm"><?php echo $pickup_date . " - " . $pickup_time . "h to " . $dropoff_date . " - " . $dropoff_time . "h"; ?></p>
</div>

<div class="border border-gray-300 rounded-lg shadow-md !p-3 !mt-2 bg-white w-full">
  <div class="flex flex-col gap-2 md:flex-row md:justify-between">
    <h3 class="text-lg font-bold"><?php echo $car_details['car_brand'] . " " . $car_details['car_model']; ?> <small>or similar</small></h3>
  </div>
  <div class="flex flex-col items-center relative mt-2 md:flex-row-reverse gap-2">
    <div>
      <img src="<?php echo $car_details['car_image']; ?>" alt="Car image" class="max-w-full lg:max-w-none w-full rounded-lg">
    </div>
    <ul class="text-gray-800 space-y-2 text-sm basis-3/4 w-full">
      <li class="flex items-center"><img src="/car-rent-services/assets/icons/car-transmission.png" class="w-6" alt="Transmission"><span class="ml-1"><?php echo $car_details['car_fuel']; ?></span></li>
      <li class="flex items-center"><img src="/car-rent-services/assets/icons/gas-fuel.png" class="w-6" alt="Fuel"><span class="ml-1">Full To Full</span></li>
      <li class="flex items-center"><img src="/car-rent-services/assets/icons/car-mileage.png" class="w-6" alt="Mileage"><span class="ml-1">Mileage: <?php echo $car_details['car_unlimited_mileage'] ? 'Unlimited' : 'Limited'; ?></span></li>
      <li class="flex items-center"><img src="/car-rent-services/assets/icons/basic-insurance.png" class="w-6" alt="Insurance"><span class="ml-1">Basic insurance with franchise</span></li>
      <li class="flex items-center"><img src="/car-rent-services/assets/icons/credit-card.png" class="w-6" alt="Deposit"><span class="ml-1">Required deposit</span></li>
    </ul>
  </div>

  <div class="mt-4 mb-4 p-4 border border-gray-300 rounded-md">
    <div class="pt-2 mt-2">
      <h3 class="font-semibold text-lg mb-2">Available extras</h3>
      <?php foreach ($extras as $extra) { ?>
        <div class="extra-div flex flex-col mb-4 md:flex-row md:justify-between">
          <p class="text-sm font-medium extra-name"><?php echo $extra['extra_name']; ?></p>
          <div class="flex flex-row gap-2 md:flex-row-reverse">
            <p class="text-sm font-medium"><?php echo $extra['extra_unit_price']; ?>€</p>
            <?php if ($extra['extra_checkbox'] == 1) { ?>
              <input type="checkbox" class="extra-input w-5 h-5" data-type="checkbox" data-price="<?php echo $extra['extra_unit_price']; ?>">
            <?php } else { ?>
              <input type="number" class="extra-input h-5" data-type="number" data-price="<?php echo $extra['extra_unit_price']; ?>" min="0" max="5" value="0">
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <div class="bg-gradient-to-b from-blue-300 to-blue-100 p-4 rounded-lg">
    <p class="text-center font-bold">Reservation</p>
    <div class="flex items-center justify-between border-b py-2">
      <span class="text-sm font-medium">Rent</span>
      <span class="text-sm font-medium"><?php echo $rent_price; ?>€</span>
    </div>
    <div id="selected-extras-list" class="text-sm text-gray-700 space-y-1 mt-2"></div>
    <div class="flex items-center justify-between py-2">
      <span class="text-sm font-bold">Total</span>
      <span class="text-sm font-bold" id="total-price"><?php echo $rent_price; ?>€</span>
    </div>
  </div>

  <div class="w-full flex flex-row-reverse">
    <button id="continue-button" class="bg-green-500 text-white px-3 py-1 rounded text-sm mt-2">Continue</button>
  </div>

  <div id="user-form-container" class="hidden mt-4">
    <h2 class="text-xl font-bold mb-2">Not logged in</h2>
    <div class="mb-4 mt-4 text-gray-600 text-left">
      <a href="/car-rent-services/views/forms/users/form-user-login.php" class="text-blue-600">Already have an account? Login here</a>
    </div>
    <a href="/car-rent-services/views/forms/users/form-user-register.php">
      <button name="form-user-login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">Register</button>
    </a>
  </div>
</div>

<script>
  let userLogged = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

  document.addEventListener('DOMContentLoaded', function() {
    const baseRentPrice = <?php echo $rent_price; ?>;
    const totalPriceEl = document.getElementById('total-price');
    const extrasListContainer = document.getElementById('selected-extras-list');

    function calculateTotal() {
      let total = baseRentPrice;
      extrasListContainer.innerHTML = '';

      document.querySelectorAll('.extra-div').forEach(div => {
        const input = div.querySelector('.extra-input');
        if (!input) return;

        const price = parseFloat(input.getAttribute('data-price'));
        const type = input.getAttribute('data-type');
        const label = div.querySelector('.extra-name')?.textContent.trim();

        if (type === 'checkbox' && input.checked) {
          total += price;
          extrasListContainer.innerHTML += `<div class="flex justify-between"><span>${label}</span><span>${price.toFixed(2)}€</span></div>`;
        }

        if (type === 'number') {
          const qty = parseInt(input.value) || 0;
          if (qty > 0) {
            const subtotal = qty * price;
            total += subtotal;
            extrasListContainer.innerHTML += `<div class="flex justify-between"><span>${label} x${qty}</span><span>${subtotal.toFixed(2)}€</span></div>`;
          }
        }
      });

      totalPriceEl.textContent = total.toFixed(2) + ' €';
    }

    document.querySelectorAll('.extra-input').forEach(input => {
      input.addEventListener('change', calculateTotal);
    });

    calculateTotal();

    const continueBtn = document.getElementById('continue-button');
    const userFormContainer = document.getElementById('user-form-container');

    continueBtn.addEventListener('click', function(e) {
      e.preventDefault();

      if (!userLogged) {
        userFormContainer.classList.remove('hidden');
        userFormContainer.scrollIntoView({ behavior: 'smooth' });
        return;
      }

      const extras = [];
      document.querySelectorAll('.extra-div').forEach(div => {
        const input = div.querySelector('.extra-input');
        if (!input) return;

        const type = input.getAttribute('data-type');
        const price = parseFloat(input.getAttribute('data-price'));
        const label = div.querySelector('.extra-name')?.textContent.trim();

        if (type === 'checkbox' && input.checked) {
          extras.push({ name: label, qty: 1, price });
        }

        if (type === 'number') {
          const qty = parseInt(input.value) || 0;
          if (qty > 0) {
            extras.push({ name: label, qty, price });
          }
        }
      });

      document.getElementById('extras-data').value = JSON.stringify(extras);
      document.getElementById('extras-form').submit();
    });
  });
</script>

<?php
  } else {
    echo "<p class='text-red-500 text-center mt-4'>Error con la consulta: " . mysqli_error($conn) . "</p>";
  }
}

mysqli_close($conn);

include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>