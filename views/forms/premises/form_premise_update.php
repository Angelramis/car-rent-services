<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>

<?php
  // Capture variables
  $premise_id = htmlspecialchars($_POST['premise_id']);
  $premise_categories = []; // Tabla premise_categories

  $premise_category_id = ""; // clave foranea premises
  $premise_number = "";
  $beds_quantity = "";
  $rooms_quantity = "";
  $price_per_day = "";
  $premise_status = "";

  // Incluir conexión
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón de submit, iniciar consulta.
  if (isset($_POST['form_premise_update_call_id'])) {

    // Consulta SQL para obtener los datos de la premisa específica
    $sql_query = "SELECT * 
                  FROM `073_premises`
                  WHERE premise_id = $premise_id";

    // Ejecutar consulta SQL
    $result_query = mysqli_query($conn, $sql_query);

    // Verificar si se ha obtenido resultado
    if ($result_query && mysqli_num_rows($result_query) > 0) {
      // Guardar cada resultado en variable para luego incluirlo en values de formulario
      while ($row = mysqli_fetch_assoc($result_query)) {
        $premise_category_id = $row['premise_category_id'];
        $premise_number = $row['premise_number'];
        $beds_quantity = $row['beds_quantity'];
        $rooms_quantity = $row['rooms_quantity'];
        $price_per_day = $row['price_per_day'];
        $premise_status = $row['premise_status'];
      }
    } else {
        echo "Premise ID not found: " . mysqli_error($conn);
    }
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  $sql_premise_categories = "SELECT premise_category_id, premise_category_name 
                            FROM `073_premise_categories`";
  
  $result_premise_categories = mysqli_query($conn, $sql_premise_categories);

  // Verificar si se han obtenido categorías y guardarlas en array premise_categories
  if ($result_premise_categories && mysqli_num_rows($result_premise_categories) > 0) {
      while ($row = mysqli_fetch_assoc($result_premise_categories)) {
          $premise_categories[$row['premise_category_id']] = $row['premise_category_name'];  // Guardar id como clave y nombre como valor
      }
  } else {
      echo "No categories found: " . mysqli_error($conn);
  }

  // Cerrar conexión con la BBDD una vez acabada la consulta
  mysqli_close($conn);
?>

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl p-2">Update premise</h1>
    <p>Change the desired columns</p>

    <form action="/student073/dwes/views/db/premises/db_premise_update.php" method="POST">
      <label>Premise category</label>
      <select name="premise_category" class="standard_input">
        <?php
         // Generar las opciones de manera dinámica con los datos de premise_categories
          foreach ($premise_categories as $premise_category_id_each => $premise_category_name) {
            // Verificar si el id coincide con la categoría seleccionada de la premisa
            $selected = ($premise_category_id_each == $premise_category_id) ? 'selected' : ''; 
            echo "<option value='$premise_category_id_each' $selected>$premise_category_name</option>"; 
          }
        ?>
      </select>

      <input type="hidden" name="premise_id" value="<?php echo $premise_id; ?>"> <!-- Campo oculto para enviar a fichero db update. -->

      <label>Premise number</label>
      <input type="number" name="premise_number" class="standard_input" value="<?php echo $premise_number; ?>" required>

      <label>Beds quantity</label>
      <input type="number" name="beds_quantity" class="standard_input" value="<?php echo $beds_quantity; ?>" required>

      <label>Rooms quantity</label>
      <input type="number" name="rooms_quantity" class="standard_input" value="<?php echo $rooms_quantity; ?>" required>

      <label>Price per day</label> <!-- valor number incluye los decimales -->
      <input type="number" name="price_per_day" class="standard_input" step="0.01" value="<?php echo $price_per_day; ?>" required>

      <label>Premise status</label>
      <select name="premise_status" class="standard_input" required>
        <option value="Good" <?php echo ($premise_status === 'Good') ? 'selected' : ''; ?>>Good</option> <!--  Pregunta boolean, si el valor formulario concide con valor en BBDD, poner como opcion seleccioanda en form -->
        <option value="Maintenance" <?php echo ($premise_status === 'Maintenance') ? 'selected' : ''; ?>>Maintenance</option> <!-- no hay ids al ser enum -->
      </select>

      <input type="submit" value="Submit" name="form_premise_update" class="px-14 py-3 mt-5 rounded-md shadow-md bg-yellow-300 hover:bg-yellow-200 cursor-pointer">
    </form>
  </div>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>
