<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>
<h1 class='text-center text-2xl p-3'>New car</h1>

<?php //Admin models
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/admin-models.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

      <nav class="flex flex-row-reverse gap-2 items-center">
        <form action="/car-rent-services/views/forms/cars/form-car-admin.php" method="POST">
          <input type="submit" value="Cancel" name="form-car-admin" class="mt-2 bg-gray-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-gray-300 hover:cursor-pointer transition text-center block">
        </form>
      </nav>

      <form action="/car-rent-services/views/db/cars/db-car-create.php" id="form-car-create" name="form-car-create" method="POST" class="w-full" enctype="multipart/form-data">
        <div class="w-full grid grid-cols-2 gap-2">
          <nav class="flex flex-col gap-1 p-2">
            <label for="car-brand">Brand<span class="text-red-500">*</span></label>
            <input type="text" id="car-brand" class="bg-gray-200 rounded-md border-[1px] p-1" name="car-brand">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-model">Model<span class="text-red-500">*</span></label>
            <input type="text" id="car-model" name="car-model" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-plate">Plate<span class="text-red-500">*</span></label>
            <input type="text" id="car-plate" name="car-plate" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-price-per-day">Price per day (€)<span class="text-red-500">*</span></label>
            <input type="number" step="0.01" id="car-price-per-day" placeholder="XX,XX" name="car-price-per-day" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-doors">Doors<span class="text-red-500">*</span></label>
            <input type="number" id="car-doors" name="car-doors" min="2" max="10" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-seats">Seats<span class="text-red-500">*</span></label>
            <input type="number" id="car-seats" name="car-seats" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-space-bags">Bags space<span class="text-red-500">*</span></label>
            <input type="number" id="car-space-bags" name="car-space-bags" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-fuel">Fuel<span class="text-red-500">*</span></label>
            <select name="car-fuel" id="car-fuel" class="bg-gray-200 rounded-md border-[1px] p-1">
              <option value="Diesel">Diesel</option>
              <option value="Gasoline">Gasoline</option>
              <option value="Electric">Electric</option>
              <option value="Hybrid">Hybrid</option>
            </select>
          </nav>

          <nav class="flex flex-row gap-2 p-2">
            <label for="car-unlimited-mileage">Unlimited mileage</label>
            <input type="checkbox" id="car-unlimited-mileage" name="car-unlimited-mileage" class="w-6 h-6">
          </nav>

          <nav class="flex flex-row gap-2 p-2">
            <label for="car-free-cancellation">Free cancellation</label>
            <input type="checkbox" id="car-free-cancellation" name="car-free-cancellation" class="w-6 h-6">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-min-age">Minimum age<span class="text-red-500">*</span></label>
            <input type="number" min="16" max="40" id="car-min-age" name="car-min-age" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-image">Image<span class="text-red-500">*</span></label>
            <input type="file" id="car-image" name="car-image" class="bg-gray-200 rounded-md border-[1px] p-1">
          </nav>

          <nav class="flex flex-row items-center gap-2 p-2">
            <label for="car-active">Active</label>
            <input type="checkbox" id="car-active" name="car-active" class="w-6 h-6" checked>
          </nav>
        </div>

        <div id="error-div" class="w-full shadow-md bg-red-500 p-2 mt-2 min-h-12 text-white rounded-md hidden flex-row items-center gap-2">
          <img class="w-6" src="/car-rent-services/assets/icons/error.png" alt="Error icon">
          <p id="error-text"></p>
        </div>

        <nav class="flex flex-row justify-between">
          <nav class="flex flex-row gap-2">
            <input type="submit" value="Create" name="form-car-create" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-600 hover:cursor-pointer transition text-center block">
          </nav>
        </nav>
      </form>

</div>

<script>
  // Validaciones
  let formCarCreate = document.getElementById('form-car-create');

  formCarCreate.addEventListener("submit", function(e) {
    let carBrand = document.getElementById('car-brand').value;
    let carModel = document.getElementById('car-model').value;
    let carPlate = document.getElementById('car-plate').value;
    let carPricePerDay = document.getElementById('car-price-per-day').value;
    let carDoors = document.getElementById('car-doors').value;
    let carSeats = document.getElementById('car-seats').value;
    let carSpaceBags = document.getElementById('car-space-bags').value;
    let carFuel = document.getElementById('car-fuel').value;
    let carMinAge = document.getElementById('car-min-age').value;

    // Validar que no esté ningún campo vacío
    if (!carBrand || !carModel || !carPlate || !carPricePerDay || !carDoors ||
    !carSeats || !carSpaceBags || !carFuel || !carMinAge) {
          e.preventDefault();
          showError("All the fields have to be filled.");
          return;
    }
    
    // Validar longitud car plate
    if (carPlate.length > 10) {
      e.preventDefault();
      showError("The car plate can't have more than 10 characters.");
      return;
    }

    // Validar longitud car price per day
    if (carPricePerDay.length > 8 || carPricePerDay < 2) {
      e.preventDefault();
      showError("The car price per day can't have more than 8 characters, minimum value 2");
      return;
    }

    // Validar longitud bags space
    if (carSpaceBags.length > 2 || (!/^\d+(\.\d+)?$/.test(carSpaceBags))) {
      e.preventDefault();
      showError("The bags space has to be a number and can't have more than 2 characters.");
      return;
    }

    // Validar longitud car seats
    if (carSeats.length > 2 || (!/^\d+(\.\d+)?$/.test(carSeats))) {
      e.preventDefault();
      showError("The car seats has to be a number and can't have more than 2 characters.");
      return;
    }

    // Validar min age
    if (carMinAge.length > 2 || (!/^\d+(\.\d+)?$/.test(carMinAge)) || carMinAge < 16 || carMinAge > 40) {
      e.preventDefault();
      showError("The minimum age has to be a number, can't have more than 2 characters, min value is 16, max value is 40.");
      return;
    }


  });
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>