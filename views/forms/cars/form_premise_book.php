<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

  <main>
    <div class="div_border">
      <h1 class="text-center text-2xl p-2">Book a premise</h1>
      
      <form action="/car-rent-services/views/forms/premises/form_premise_book_availables.php" method="POST">

        <label>Date in</label>
        <input type="date" name="date_in" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" 
               value="<?php echo isset($_COOKIE['date_in']) ? $_COOKIE['date_in'] : ''; ?>" required> 
                <!-- Si hay cookie guardada poner dato, si no, vacío -->
        
        <label>Date out</label>
        <input type="date" name="date_out" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" 
        value="<?php echo isset($_COOKIE['date_out']) ? $_COOKIE['date_out'] : ''; ?>" required> 

        <label>Quantity of guests</label>
        <input type="number" name="guest_quantity" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500"  
               value="<?php echo isset($_COOKIE['guest_quantity']) ? $_COOKIE['guest_quantity'] : ''; ?>" required min="1" max="10"> 

        <input type="submit" value="Submit" name="form_premise_book" class="button_action">
      </form>
    </div>
  </main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>