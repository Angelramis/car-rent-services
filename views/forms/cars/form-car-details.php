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
  $sql_query =
    "SELECT *
    FROM cars
    WHERE car_id = $car_id;";

  // Ejecutar consulta SQL a la BBDD
  $execute_query = mysqli_query($conn, $sql_query);

  // Solo se espera un resultado, un coche
  $car_details = mysqli_fetch_assoc($execute_query);

  if ($execute_query && mysqli_num_rows($execute_query) > 0) {

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
        <h3 class="text-lg font-bold"><?php echo $car_details['car_model']; ?>
          <small>or similar</small>
        </h3>

      </div>
      <div class="flex flex-col items-center relative mt-2  md:flex-row-reverse gap-2 ">
        <div>
          <img src="https://strato.ownerscars.net/img/grupo/A500_.jpg" alt="A - Fiat 500" class="max-w-full lg:max-w-none w-full rounded-lg">
        </div>
        <ul class="text-gray-800 space-y-2 text-sm basis-3/4 w-full">
          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-manual-gearbox">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M5 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path d="M12 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path d="M19 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path d="M5 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path d="M12 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path d="M5 8l0 8"></path>
              <path d="M12 8l0 8"></path>
              <path d="M19 8v2a2 2 0 0 1 -2 2h-12"></path>
            </svg>

            <span class="ml-1"><?php echo $car_details['car_fuel']; ?>
            </span>
          </li>

          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-gas-station">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M14 11h1a2 2 0 0 1 2 2v3a1.5 1.5 0 0 0 3 0v-7l-3 -3"></path>
              <path d="M4 20v-14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v14"></path>
              <path d="M3 20l12 0"></path>
              <path d="M18 7v1a1 1 0 0 0 1 1h1"></path>
              <path d="M4 11l10 0"></path>
            </svg>
            <span class="ml-1 first-letter-capitalize">Full To Full</span>
          </li>
          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-route-square">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M3 17h4v4h-4z"></path>
              <path d="M17 3h4v4h-4z"></path>
              <path d="M11 19h5.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h4.5"></path>
            </svg>
            <span class="ml-1 first-letter-capitalize">Mileage: <?php if ($car_details['car_unlimited_mileage'] == 1) {
                                                                  echo "Unlimited";
                                                                } else {
                                                                  "Limited";
                                                                }; ?></span>
          </li>
          <li class="flex items-center">
            <span class="text-gray-800 weigth [&amp;>svg]:stroke-[1]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shield-half">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
                <path d="M12 3v18"></path>
              </svg></span>
            <span class="ml-1 first-letter-capitalize">Basic insurance with franchise</span>
          </li>
          <li class="flex items-center">
            <span class="text-gray-800 weigth [&amp;>svg]:stroke-[1]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"></path>
                <path d="M3 10l18 0"></path>
                <path d="M7 15l.01 0"></path>
                <path d="M11 15l2 0"></path>
              </svg></span>
            <span class="ml-1 first-letter-capitalize">Required deposit</span>
          </li>


        </ul>

      </div>

      <div class="space-y-4" id="seguros">
        <p class="text-lg font-semibold">Select an insurance: </p>
        <div class="grid grid-cols-1 md:grid-cols-[repeat(auto-fit,_minmax(0,_1fr))] gap-4">


          <label class="flex items-center space-x-3 bg-white p-4 rounded-lg shadow-md cursor-pointer border border-gray-300 hover:border-blue-500 transition relative">
            <input type="radio" name="selected_service" value="561" class="w-5 h-5 text-blue-600" wire:click="toggleSeguroMultiple({&quot;id&quot;:561,&quot;name&quot;:&quot;ServicioSeguro&quot;,&quot;daily_price&quot;:&quot;0.00&quot;,&quot;min_price&quot;:&quot;0.00&quot;,&quot;max_price&quot;:&quot;0.00&quot;,&quot;max_units&quot;:1,&quot;select_type&quot;:&quot;multiple&quot;,&quot;created_at&quot;:&quot;2025-02-06T10:44:57.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-02-06T10:44:57.000000Z&quot;,&quot;required&quot;:0,&quot;provider_ref&quot;:&quot;ServicioSeguro&quot;,&quot;calc_type&quot;:&quot;Fixed&quot;,&quot;ref_code&quot;:&quot;8&quot;,&quot;deposit&quot;:&quot;0.00&quot;,&quot;display_name&quot;:&quot;Ninguna Cobertura&quot;,&quot;franchise&quot;:&quot;800.00&quot;,&quot;related_data&quot;:null,&quot;active&quot;:1,&quot;labels&quot;:&quot;seguro am&quot;,&quot;units&quot;:0,&quot;service_price&quot;:0,&quot;pivot&quot;:{&quot;group_provider_id&quot;:1,&quot;group_provider_service_id&quot;:561}})">

            <div>
              <p class="text-gray-900 font-medium">No coverage
              </p>
              <p class="text-gray-500 text-sm">Price: <span class="font-semibold text-green-600">0.00€</span>
              </p>

              <p class="text-gray-500 text-sm">Deposit: <span class="font-semibold">0.00€</span>
              </p>
              <p class="text-gray-500 text-sm">Franchise: <span class="font-semibold">800.00€</span>
              </p>
            </div>

          </label>
          <label class="flex items-center space-x-3 bg-white p-4 rounded-lg shadow-md cursor-pointer border border-gray-300 hover:border-blue-500 transition relative">
            <input type="radio" name="selected_service" value="556" class="w-5 h-5 text-blue-600" wire:click="toggleSeguroMultiple({&quot;id&quot;:556,&quot;name&quot;:&quot;ServicioSeguro&quot;,&quot;daily_price&quot;:&quot;18.15&quot;,&quot;min_price&quot;:&quot;18.15&quot;,&quot;max_price&quot;:&quot;99999.00&quot;,&quot;max_units&quot;:1,&quot;select_type&quot;:&quot;multiple&quot;,&quot;created_at&quot;:&quot;2025-02-04T06:24:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-02-06T10:51:22.000000Z&quot;,&quot;required&quot;:0,&quot;provider_ref&quot;:&quot;ServicioSeguro&quot;,&quot;calc_type&quot;:&quot;Fixed&quot;,&quot;ref_code&quot;:&quot;10&quot;,&quot;deposit&quot;:&quot;0.00&quot;,&quot;display_name&quot;:null,&quot;franchise&quot;:&quot;0.00&quot;,&quot;related_data&quot;:null,&quot;active&quot;:1,&quot;labels&quot;:&quot;AutosMenorca Autos Menorca&quot;,&quot;units&quot;:0,&quot;service_price&quot;:127.04999999999998,&quot;pivot&quot;:{&quot;group_provider_id&quot;:1,&quot;group_provider_service_id&quot;:556}})">


            <div>
              <p class="text-gray-900 font-medium">Secure service
              </p>

              <p class="text-gray-500 text-sm">Price: <span class="font-semibold text-green-600">127.05€</span>
              </p>

              <p class="text-gray-500 text-sm">Deposit: <span class="font-semibold">0.00€</span>
              </p>
              <p class="text-gray-500 text-sm">Franchise: <span class="font-semibold">0.00€</span>
              </p>
            </div>

          </label>

        </div>
      </div>

      <div class="mt-4 mb-4 p-4 border border-gray-300 rounded-md">
        <div class="pt-2 mt-2">
          <h3 class="font-semibold text-lg mb-2">Avaliable extras</h3>


          <div class="flex items-center justify-between border-b py-2">
            <p class="text-sm font-medium">Lift service 50€</p>
            <div class="flex space-x-2">
              <input type="checkbox" name="" id="">
            </div>
          </div>


          <div class="flex items-center justify-between border-b py-2">
            <p class="text-sm font-medium">Child seat service 50€</p>

            <div class="flex space-x-2">
              <input type="number" name="" id="">
            </div>
          </div>

          <div class="flex items-center justify-between border-b py-2">
            <p class="text-sm font-medium">Second driver 35€</p>
            <input type="checkbox" name="" id="">

          </div>
        </div>
      </div>

      <div class="bg-gradient-to-b from-blue-300 to-blue-100 p-4 rounded-lg">
        <p class="text-center font-bold">Reservation</p>
        <div class="flex items-center justify-between border-b py-2">
          <span class="text-sm font-medium">Rent</span>
          <span class="text-sm font-medium">108.22 €</span>
        </div>

        <div class="flex items-center justify-between  py-2">
          <span class="text-sm font-bold">Total</span>
          <span class="text-sm font-bold">108.22 €</span>
        </div>

      </div>

    </div>

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