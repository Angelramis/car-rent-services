<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /car-rent-services/index.php");
    exit();
  }
?>

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl p-2">Insert premise</h1>
    
    <form action="/car-rent-services/views/db/premises/db_premise_insert.php" method="POST" enctype="multipart/form-data">
      <label>Premise category</label>
      <select name="premise_category" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500">
        <option value="1">Room</option>
        <option value="2">Suite</option>
        <option value="3">Villa</option>
        <option value="4">Apartment</option>
      </select>

      <label>Premise number</label>
      <input type="number" name="premise_number" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required> <!-- importante required -->

      <label>Beds quantity</label>
      <input type="number" name="beds_quantity" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Rooms quantity</label>
      <input type="number" name="rooms_quantity" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Price per day</label>
      <input type="deciaml" name="price_per_day" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>

      <label>Premise status</label>
      <select name="premise_status" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>
        <option value="Good">Good</option>
        <option value="Maintenance">Maintenance</option>
      </select>
    
      <label>Premise image</label>
      <input type="file" name="premise_image" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500">

      <input type="submit" value="Submit" name="form_premise_insert" class="button_action">
    </form>
  </div>

</main>






<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>