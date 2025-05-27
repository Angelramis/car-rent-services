<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>

<h1 class="text-2xl font-medium"><?= __('Rent a car', $lang);?> <span class="text-[#1389e4]"> <?= __('fast', $lang);?></span> <?= __('and', $lang);?> <span class="text-[#1389e4]"><?= __('easy', $lang);?></span> </h1>

<form action="/views/forms/cars/form-car-book-availables.php" id="form-cars-search" method="POST"
  class="bg-white shadow-md flex flex-col flex-wrap gap-2 text-left !p-3 !mt-2 w-full items-center justify-center rounded-md max-w-4xl mx-auto relative md:grid md:grid-cols-5 md:min-h-20 lg:flex-row lg:min-h-20">
  <div class="flex flex-col items-center justify-center w-full">
    <label for="pickup-date" class="w-full mb-1"><?= __('Pick up date', $lang);?></label>
    <input type="date" min="<?php echo date('Y-m-d'); ?>" id="pickup-date" name="pickup-date" class="border-[1px] rounded-md border-gray-500 h-10 min-w-36 w-full p-1" value="<?php echo date('Y-m-d', strtotime('+4 days')); ?>">
  </div>
  
  <div class="flex flex-col items-center justify-center w-full">
    <label for="pickup-time" class="w-full mb-1"><?= __('Hour', $lang);?></label>
    <select name="pickup-time" id="pickup-time" class="border-[1px] rounded-md border-gray-500 h-10 min-w-36 w-full p-1">
      <option value="06:00">06:00h</option>
      <option value="06:30">06:30h</option>
      <option value="07:00">07:00h</option>
      <option value="07:30">07:30h</option>
      <option value="08:00">08:00h</option>
      <option value="08:30">08:30h</option>
      <option value="09:00">09:00h</option>
      <option value="09:30">09:30h</option>
      <option value="10:00" selected>10:00h</option>
      <option value="10:30">10:30h</option>
      <option value="11:00">11:00h</option>
      <option value="11:30">11:30h</option>
      <option value="12:00">12:00h</option>
      <option value="12:30">12:30h</option>
      <option value="13:00">13:00h</option>
      <option value="13:30">13:30h</option>
      <option value="14:00">14:00h</option>
      <option value="14:30">14:30h</option>
      <option value="15:00">15:00h</option>
      <option value="15:30">15:30h</option>
      <option value="16:00">16:00h</option>
      <option value="16:30">16:30h</option>
      <option value="17:00">17:00h</option>
      <option value="17:30">17:30h</option>
      <option value="18:00">18:00h</option>
      <option value="18:30">18:30h</option>
      <option value="19:00">19:00h</option>
      <option value="19:30">19:30h</option>
      <option value="20:00">20:00h</option>
      <option value="20:30">20:30h</option>
      <option value="21:00">21:00h</option>
    </select>
  </div>

  <div class="flex flex-col items-center justify-center w-full">
    <label for="dropoff-date" class="w-full mb-1"><?= __('Drop off date', $lang);?></label>
    <input type="date" name="dropoff-date" id="dropoff-date" min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>" class=" border-[1px] rounded-md border-gray-500 h-10 min-w-36 w-full p-1" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
  </div>

  <div class="flex flex-col items-center justify-center w-full">
    <label for="dropoff-time" class="w-full mb-1"><?= __('Hour', $lang);?></label>
    <select name="dropoff-time" id="dropoff-time" class="border-[1px] rounded-md border-gray-500 h-10 min-w-36 w-full p-1">
      <option value="06:00">06:00h</option>
      <option value="06:30">06:30h</option>
      <option value="07:00">07:00h</option>
      <option value="07:30">07:30h</option>
      <option value="08:00">08:00h</option>
      <option value="08:30">08:30h</option>
      <option value="09:00">09:00h</option>
      <option value="09:30">09:30h</option>
      <option value="10:00" selected>10:00h</option>
      <option value="10:30">10:30h</option>
      <option value="11:00">11:00h</option>
      <option value="11:30">11:30h</option>
      <option value="12:00">12:00h</option>
      <option value="12:30">12:30h</option>
      <option value="13:00">13:00h</option>
      <option value="13:30">13:30h</option>
      <option value="14:00">14:00h</option>
      <option value="14:30">14:30h</option>
      <option value="15:00">15:00h</option>
      <option value="15:30">15:30h</option>
      <option value="16:00">16:00h</option>
      <option value="16:30">16:30h</option>
      <option value="17:00">17:00h</option>
      <option value="17:30">17:30h</option>
      <option value="18:00">18:00h</option>
      <option value="18:30">18:30h</option>
      <option value="19:00">19:00h</option>
      <option value="19:30">19:30h</option>
      <option value="20:00">20:00h</option>
      <option value="20:30">20:30h</option>
      <option value="21:00">21:00h</option>
    </select>
  </div>

  <input type="submit" value="<?= __('Search', $lang);?>" name="form-car-search" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-full hover:bg-blue-600 transition text-center block">

</form>

<div id="error-div" class="w-full shadow-md bg-red-500 p-2 mt-2 min-h-12 text-white rounded-md hidden flex-row items-center gap-2">
  <img class="w-6" src="/assets/icons/error.png" alt="Error icon">
  <p id="error-text"></p>
</div>

<img src="/assets/images/general/car-portada.webp" alt="Car" class="mt-4 w-full max-w-xl">

<section id="info-cards" class="flex w-full flex-col gap-2 mt-2 min-h-42 rounded-md">
  <div class="flex flex-col h-auto w-full shadow-md rounded-md bg-white text-left p-2 items-center gap-2 md:flex-row md:h-44">
    <img src="/assets/images/general/best-prices.webp" alt="Car keys" class="w-full max-w-44 p-2 rounded-md object-contain md:h-full md:w-96">
    <div>
      <p class="font-bold text-xl"><?= __('Best prices', $lang);?></p>
      <p><?= __('Enjoy competitive rates with no hidden fees, quality car rentals that fit your budget.', $lang);?></p>
    </div>
  </div>
  <div class="flex flex-col h-auto w-full shadow-md rounded-md bg-white text-left p-2 items-center gap-2 md:flex-row md:h-44">
    <img src="/assets/images/general/car-fleet.png" alt="Car keys" class="w-full max-w-44 p-2 rounded-md object-contain md:h-full md:w-96">
    <div>
      <p class="font-bold text-xl"><?= __('Large car fleet', $lang);?></p>
      <p><?= __('Choose from a wide variety of well-maintained vehicles to suit every need and preference.', $lang);?></p>
    </div>
  </div>
  <div class="flex flex-col h-auto w-full shadow-md rounded-md bg-white text-left p-2 items-center gap-2 md:flex-row md:h-44">
    <img src="/assets/images/general/security.png" alt="Car keys" class="w-full max-w-44 p-2 rounded-md object-contain md:h-full md:w-96">
    <div>
      <p class="font-bold text-xl"><?= __('Transparency and security', $lang);?></p>
      <p><?= __('Clear rental terms, secure payments, and full customer support for a worry-free experience.', $lang);?></p>
    </div>
  </div>
</section>


<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>

<script>
  // Validaciones
  let formCars = document.getElementById('form-cars-search');
  let errorDiv = document.getElementById('error-div');

  // Al darle a submit al formulario
  formCars.addEventListener("submit", function(e) {
    let pickupDateInput = document.getElementById('pickup-date');
    let pickupTimeInput = document.getElementById('pickup-time');
    let dropoffDateInput = document.getElementById('dropoff-date');
    let dropoffTimeInput = document.getElementById('dropoff-time');

    // Obtener valores
    let pickupDateValue = pickupDateInput.value; 
    let pickupTimeValue = pickupTimeInput.value;
    let dropoffDateValue = dropoffDateInput.value; 
    let dropoffTimeValue = dropoffTimeInput.value;

    // Combinar fecha y hora en formato ISO compatible
    let pickupDateTimeString = `${pickupDateValue}T${pickupTimeValue}`; // "2025-05-08T10:00"
    let dropoffDateTimeString = `${dropoffDateValue}T${dropoffTimeValue}`;

    // Crear el objeto Date completo
    let pickupDateTime = new Date(pickupDateTimeString);
    let dropoffDateTime = new Date(dropoffDateTimeString);

    // Obtener la fecha actual
    let nowDate = new Date();
  
    // Comparación
    if (pickupDateTime < nowDate) {
      e.preventDefault();
      showError("The pick-up date and time can't be less than the current date and time.");
    }

    if (dropoffDateTime < nowDate) {
      e.preventDefault();
      showError("The drop-off date and time can't be less than the current date and time.");
    }

    if (pickupDateValue > dropoffDateValue) {
      e.preventDefault();
      showError("The drop-off date can't be less than de pickup date.");
    }

    // Comprobar campos vacíos
    if (!pickupDateValue || !pickupTimeValue || !dropoffDateValue || !dropoffTimeValue) {
      e.preventDefault();
      showError("All the fields needs to be filled.");
    }
});
</script>
