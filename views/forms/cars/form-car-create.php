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

      <form action="/car-rent-services/views/db/cars/db-car-create.php" name="form-car-update" method="POST" class="w-full" enctype="multipart/form-data">
        <div class="w-full grid grid-cols-2 gap-2">
          <nav class="flex flex-col gap-1 p-2">
            <label for="car-brand">Brand</label>
            <input type="text" id="car-brand" class="bg-gray-200 rounded-md border-[1px] p-1" name="car-brand" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-model">Model</label>
            <input type="text" id="car-model" name="car-model" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-plate">Plate</label>
            <input type="text" id="car-plate" name="car-plate" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-price-per-day">Price per day(€)</label>
            <input type="number" step="0.01" id="car-price-per-day" placeholder="XX,XX" name="car-price-per-day" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-doors">Doors</label>
            <input type="number" id="car-doors" name="car-doors" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-seats">Seats</label>
            <input type="number" id="car-seats" name="car-seats" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-space-bags">Bags space</label>
            <input type="number" id="car-space-bags" name="car-space-bags" class="bg-gray-200 rounded-md border-[1px] p-1"required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-fuel">Fuel</label>
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
            <label for="car-min-age">Minimum age</label>
            <input type="number" id="car-min-age" name="car-min-age" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="car-image">Image</label>
            <input type="file" id="car-image" name="car-image" class="bg-gray-200 rounded-md border-[1px] p-1" required>
          </nav>

          <nav class="flex flex-row items-center gap-2 p-2">
            <label for="car-active">Active</label>
            <input type="checkbox" id="car-active" name="car-active" class="w-6 h-6" checked>
          </nav>
        </div>
        <nav class="flex flex-row justify-between">
          <nav class="flex flex-row gap-2">
            <input type="submit" value="Create" name="form-car-create" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-600 hover:cursor-pointer transition text-center block">
          </nav>
        </nav>
      </form>

</div>

<script>
  function checkInputs() {
    
  }
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>