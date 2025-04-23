<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>




<h1 class="text-2xl font-medium">Rent a car <span class="text-[#1389e4]">fast</span> and <span class="text-[#1389e4]">easy</span> </h1>
<form action="" method="POST" class="flex flex-col flex-wrap gap-2 shadow p-2 rounded-md w-full md:flex-row ">
  <label for="pickup-date">Pickup date</label>
  <input type="date" name="pickup-date" id="">

  <label for="pickup-time">Time</label>
  <select name="pickup-time" id="">
    <option value="06:00">06:00</option>
    <option value="06:30">06:30</option>
    <option value="07:00">07:00</option>
    <option value="07:30">07:30</option>
    <option value="08:00">08:00</option>
    <option value="08:30">08:30</option>
    <option value="09:00">09:00</option>
    <option value="09:30">09:30</option>
    <option value="10:00" selected>10:00</option>
    <option value="10:30">10:30</option>
    <option value="11:00">11:00</option>
    <option value="11:30">11:30</option>
    <option value="12:00">12:00</option>
    <option value="12:30">12:30</option>
    <option value="13:00">13:00</option>
    <option value="13:30">13:30</option>
    <option value="14:00">14:00</option>
    <option value="14:30">14:30</option>
    <option value="15:00">15:00</option>
    <option value="15:30">15:30</option>
    <option value="16:00">16:00</option>
    <option value="16:30">16:30</option>
    <option value="17:00">17:00</option>
    <option value="17:30">17:30</option>
    <option value="18:00">18:00</option>
    <option value="18:30">18:30</option>
    <option value="19:00">19:00</option>
    <option value="19:30">19:30</option>
    <option value="20:00">20:00</option>
    <option value="20:30">20:30</option>
    <option value="21:00">21:00</option>
  </select>

  <label for="pickup-date">Dropoff date</label>
  <input type="date" name="dropoff-date" id="">

  <label for="dropoff-time">Time</label>
  <select name="pickup-time" id="">
    <option value="06:00">06:00</option>
    <option value="06:30">06:30</option>
    <option value="07:00">07:00</option>
    <option value="07:30">07:30</option>
    <option value="08:00">08:00</option>
    <option value="08:30">08:30</option>
    <option value="09:00">09:00</option>
    <option value="09:30">09:30</option>
    <option value="10:00" selected>10:00</option>
    <option value="10:30">10:30</option>
    <option value="11:00">11:00</option>
    <option value="11:30">11:30</option>
    <option value="12:00">12:00</option>
    <option value="12:30">12:30</option>
    <option value="13:00">13:00</option>
    <option value="13:30">13:30</option>
    <option value="14:00">14:00</option>
    <option value="14:30">14:30</option>
    <option value="15:00">15:00</option>
    <option value="15:30">15:30</option>
    <option value="16:00">16:00</option>
    <option value="16:30">16:30</option>
    <option value="17:00">17:00</option>
    <option value="17:30">17:30</option>
    <option value="18:00">18:00</option>
    <option value="18:30">18:30</option>
    <option value="19:00">19:00</option>
    <option value="19:30">19:30</option>
    <option value="20:00">20:00</option>
    <option value="20:30">20:30</option>
    <option value="21:00">21:00</option>
  </select>
  <input type="submit" value="Search">
</form>



<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>