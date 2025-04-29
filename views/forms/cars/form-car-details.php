<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">Offer details</h1>

<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

// Si se ha pulsado el botón form submit, iniciar gestión
if (isset($_POST['form-car-details'])) {
  $car_id = htmlspecialchars($_POST['car-id']);
  $pickup_date = htmlspecialchars($_POST['pickup-date']);
  $pickup_time = htmlspecialchars($_POST['pickup-time']);
  $dropoff_date = htmlspecialchars($_POST['dropoff-date']);
  $dropoff_time = htmlspecialchars($_POST['dropoff-time']);

  // consulta SQL
  $sql_query_car =
    "SELECT *
    FROM cars
    WHERE car_id = $car_id;";

  $sql_query_extras =
    "SELECT *
    FROM extras;";

  // Ejecutar consultas SQL a la BBDD
  $execute_query_car = mysqli_query($conn, $sql_query_car);
  $execute_query_extras = mysqli_query($conn, $sql_query_extras);


  // Solo se espera un resultado, un coche
  $car_details = mysqli_fetch_assoc($execute_query_car);
  $extras = mysqli_fetch_all($execute_query_extras, MYSQLI_ASSOC);

  if ($execute_query_car && $extras && mysqli_num_rows($execute_query_car) > 0) {

    $pickup = new DateTime($pickup_date);
    $dropoff = new DateTime($dropoff_date);

    $rent_days_interval = $pickup->diff($dropoff);

    // Precio diario del coche * cantidad de dias de reserva
    $rent_price = $car_details['car_price_per_day'] * ($rent_days_interval->days);
?>

    <section class="bg-white shadow-md -mt-12 rounded-md max-w-4xl mx-auto relative flex items-center w-full p-4 h-16">

      <div class="text-left !p-3">
        <p class="font-semibold text-gray-900">Car Rent Services (Menorca)</p>
        <p class="text-gray-600 text-sm"><?php echo $pickup_date . " - " . $pickup_time . "h to " . $dropoff_date . " - " . $dropoff_time . "h"; ?>
        </p>
      </div>

      </div>
    </section>

    <div class="border border-gray-300 rounded-lg shadow-md !p-3 !mt-2 bg-white w-full">
      <div class="flex flex-col gap-2  md:flex-row md:justify-between ">
        <h3 class="text-lg font-bold"><?php echo $car_details['car_brand'] . " " . $car_details['car_model']; ?>
          <small>or similar</small>
        </h3>

      </div>
      <div class="flex flex-col items-center relative mt-2  md:flex-row-reverse gap-2 ">
        <div>
          <img src="https://strato.ownerscars.net/img/grupo/A500_.jpg" alt="A - Fiat 500" class="max-w-full lg:max-w-none w-full rounded-lg">
        </div>
        <ul class="text-gray-800 space-y-2 text-sm basis-3/4 w-full">
          <li class="flex items-center">
            <img src="/car-rent-services/assets/icons/car-transmission.png" class="w-6" alt="Car seats">
            <span class="ml-1"><?php echo $car_details['car_fuel']; ?>
            </span>
          </li>

          <li class="flex items-center">
            <img src="/car-rent-services/assets/icons/gas-fuel.png" class="w-6" alt="Car seats">
            <span class="ml-1 first-letter-capitalize">Full To Full</span>
          </li>
          <li class="flex items-center">
            <img src="/car-rent-services/assets/icons/car-mileage.png" class="w-6" alt="Car seats">
            <span class="ml-1 first-letter-capitalize">Mileage: <?php if ($car_details['car_unlimited_mileage'] == 1) {
                                                                  echo "Unlimited";
                                                                } else {
                                                                  "Limited";
                                                                }; ?></span>
          </li>
          <li class="flex items-center">
            <img src="/car-rent-services/assets/icons/basic-insurance.png" class="w-6" alt="Car seats">
            <span class="ml-1 first-letter-capitalize">Basic insurance with franchise</span>
          </li>
          <li class="flex items-center">
            <img src="/car-rent-services/assets/icons/credit-card.png" class="w-6" alt="Car seats">
            <span class="ml-1 first-letter-capitalize">Required deposit</span>
          </li>


        </ul>

      </div>

      <div class="mt-4 mb-4 p-4 border border-gray-300 rounded-md">
        <div class="pt-2 mt-2">
          <h3 class="font-semibold text-lg mb-2">Avaliable extras</h3>

          <?php foreach ($extras as $extra) { ?>

            <div class="flex flex-col md:grid md:grid-cols-3 items-center md:justify-between border-b py-2">
              <p class="text-sm font-medium"><?php echo $extra['extra_name']; ?></p>
              <p class="text-sm font-medium"><?php echo $extra['extra_unit_price']; ?>€</p>
              <div class="">
                <?php if ($extra['extra_checkbox'] == 1) { ?>
                  <input type="checkbox" class="extra-input w-5 h-5" data-type="checkbox" data-price="<?php echo $extra['extra_unit_price']; ?>">

                <?php } else { ?>
                  <input type="number" class="extra-input h-5" data-type="number" data-price="<?php echo $extra['extra_unit_price']; ?>" min="0" max="6" value="0">
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

        <div class="flex items-center justify-between  py-2">
          <span class="text-sm font-bold">Total</span>
          <span class="text-sm font-bold" id="total-price"><?php echo $rent_price; ?>€</span>
        </div>
      </div>
      <div class="w-full flex flex-row-reverse">
        <button class="bg-green-500 text-white px-3 py-1 rounded text-sm mt-2">
          Continue
        </button>
      </div>
    </div>


    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const baseRentPrice = <?php echo $rent_price; ?>;
        const totalPriceEl = document.getElementById('total-price');
        const extraInputs = document.querySelectorAll('.extra-input');

        function calculateTotal() {
          let total = baseRentPrice;

          extraInputs.forEach(input => {
            const price = parseFloat(input.getAttribute('data-price'));

            if (input.getAttribute('data-type') === 'checkbox') {
              if (input.checked) {
                total += price;
              }
            } else if (input.getAttribute('data-type') === 'number') {
              const quantity = parseInt(input.value) || 0;
              total += price * quantity;
            }
          });

          totalPriceEl.textContent = total.toFixed(2) + ' €';
        }

        extraInputs.forEach(input => {
          input.addEventListener('change', calculateTotal);
        });
      });
    </script>


<?php


  } else {
    echo "Error con la consulta" . mysqli_error($con);
  }
}
// Cerrar conexión con BBD una vez acabada la consulta
mysqli_close($conn);
?>

<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>