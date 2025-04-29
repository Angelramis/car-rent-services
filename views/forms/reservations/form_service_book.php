<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>
<?php
  // Archivo llamado al darle a form Book servicio 

  // Control log in
  if ($session_user_id == 'guest') {
    header("Location: /car-rent-services/views/forms/users/form_user_login.php"); 
  }

  // Gestión obtener reservas activas del cliente

  // Conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // SQL obtencion de reservas a nombre de usuario disponibles
  $sql = "SELECT reservation_number
          FROM `073_reservations`
          WHERE user_id = $session_user_id
          AND reservation_state = 'Booked' 
          OR reservation_state = 'Check-in';";

  $execute_query = mysqli_query($conn, $sql);

  $available_reservations = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);

  $reservation_number_options = '';

  foreach ($available_reservations as $reservation) {
    $reservation_number_options .= "<option value=\"{$reservation['reservation_number']}\">{$reservation['reservation_number']}</option>";
  }
   
  // Cerrar conexión con DB
  mysqli_close($conn);
?>

  <main>
    <div class="div_border">
      <h1 class="text-center text-2xl p-2">Book service</h1>
      
      <form name="form_service" action="/car-rent-services/views/db/reservations/db_reservation_service_book.php" method="POST">

        <label>Service</label>
        <select name="service_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required onchange='inputManagement()'>
          <option value="Spa" selected>Spa - 30€/person</option>
          <option value="Gym">Gym - 20€/person</option>
          <option value="Restaurant">Restaurant - 25€/person</option>
        </select>
        
        <label>Reservation number</label>
        <select name="reservation_number" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" id="reservation_number" required onchange='inputManagement()'>
          <?php echo $reservation_number_options; ?>
        </select>

        <label>Quantity of guests</label>
        <input type="number" name="guest_quantity" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required min="1" max="10" onkeyup="inputManagement()">   

        <label>Date</label>
        <input type="date" id="date_input" name="date_input" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required onchange="inputManagement()"> 

        <label>Available hours</label>
        <select id="hoursSelect" name="hours" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" required>
        </select>

        <input type="submit" value="Submit" name="form_reservation_service_book" class="button_action">
      </form>
    </div>
  </main>

<!-- GESTIÓN AJAX -->
<script>
  function inputManagement() {
    /* Capturar datos del formulario */
    
    // Servicio elegido
    let serviceInput = document.form_service.service_name.value;

    let reservationNumberInput = document.form_service.reservation_number.value;

    let guestQuantityInput = document.form_service.guest_quantity.value;

    let dateInput = document.form_service.date_input.value;

    // Si no se ha escrito nada en los primeros inputs, no mostrar nada
    if (reservationNumberInput  == "" || guestQuantityInput  == "") {
      document.getElementById("hoursSelect").innerHTML = "";
      return;
    
    // Si los inputs están rellenados, llamar archivo DB
    } else {
      let httpQuery = new XMLHttpRequest();

      httpQuery.onreadystatechange = function() {
        // Si la consulta es VÁLIDA
        if (this.readyState == 4 && this.status == 200) { 
          
          // Obtener respuesta
          let response = JSON.parse(this.responseText);

          // Insertar fecha minima y maxima a input date
          document.getElementById("date_input").setAttribute("min", response.date_in);
          document.getElementById("date_input").setAttribute("max", response.date_out);

          // Si el input date está rellenado, gestionar horas disponibles
          if (dateInput != "") {
            
            // Obtener el select donde se añadirán las opciones
            let hoursSelect = document.getElementById("hoursSelect");

            // Limpiar options anteriores
            hoursSelect.innerHTML = ""; 

            // Si hay horas disponibles, añadirlas al select
            if (response.available_hours && response.available_hours.length > 0) {
                response.available_hours.forEach(hour => {
                    // Crear el elemento option
                    let option = document.createElement("option");
                    option.value = hour;
                    option.text = `${hour}:00h`;
                    
                    hoursSelect.appendChild(option);
                });
            }
          }
        }
      }
      
      // Declarar datos a enviar
      let parameters = "serviceInput=" + serviceInput +
                      "&reservationNumberInput=" + reservationNumberInput +
                      "&guestQuantityInput=" + guestQuantityInput +
                      "&dateInput=" + dateInput;

      // Conexión con base de datos
      httpQuery.open("POST","/car-rent-services/views/db/reservations/db_reservation_service_book_ajax.php", true);
      httpQuery.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      httpQuery.send(parameters);
    }
  }
</script>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>