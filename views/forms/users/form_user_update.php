<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
 
  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>

<?php
  // Capture variables
  $user_email = htmlspecialchars($_POST['user_email']);
  $user_id = "";
  $user_pwd = "";
  $user_roles = "";
  $user_firstname = "";
  $user_lastname = "";
  $user_nif = "";
  $user_phone = "";
  $user_address = "";
  $user_country = "";

  // Incluir conexión
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón de submit, iniciar consulta.
  if (isset($_POST['form_user_update_call_id'])) {

    // Consulta SQL para obtener los datos
    $sql_query = "SELECT * 
                  FROM `073_users`
                  WHERE user_email = '$user_email'";

    // Ejecutar consulta SQL
    $result_query = mysqli_query($conn, $sql_query);

    // Verificar si se ha obtenido resultado
    if ($result_query && mysqli_num_rows($result_query) > 0) {
      // Guardar cada resultado en variable para luego incluirlo en values de formulario
      while ($row = mysqli_fetch_assoc($result_query)) {
        $user_id = $row['user_id'];
        $user_email = $row['user_email'];
        $user_pwd = $row['user_pwd'];
        $user_roles = $row['user_roles'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_nif = $row['user_nif'];
        $user_phone = $row['user_phone'];
        $user_address = $row['user_address'];
        $user_country = $row['user_country'];
      }
    } else {
        echo "Element ID not found: " . mysqli_error($conn);
    }
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  // Cerrar conexión con la BBDD una vez acabada la consulta
  mysqli_close($conn);
?>

<main>
  <h1 class="text-center text-2xl p-2">Update user</h1>
  <p>Change the desired columns</p>


  <form action="/student073/dwes/views/db/users/db_user_update.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> <!-- Campo oculto para enviar a fichero db. -->
 
    <label>Email</label>
    <input type="email" name="user_email" class="standard_input" value="<?php echo $user_email; ?>" required>

    <label>Password</label>
    <input type="text" name="user_pwd" class="standard_input" value="<?php echo $user_pwd; ?>" required>

    <label>User roles</label>
    <input type="text" name="user_roles" class="standard_input" value="<?php echo $user_roles; ?>" required>

    <label>Firstname</label>
    <input type="text" name="user_firstname" class="standard_input" value="<?php echo $user_firstname; ?>" required>

    <label>Lastname</label>
    <input type="text" name="user_lastname" class="standard_input" value="<?php echo $user_lastname; ?>" required>

    <label>NIF</label>
    <input type="text" name="user_nif" class="standard_input" value="<?php echo $user_nif; ?>" required>

    <label>Phone</label>
    <input type="text" name="user_phone" class="standard_input" value="<?php echo $user_phone; ?>" required>

    <label>Address</label>
    <input type="text" name="user_address" class="standard_input" value="<?php echo $user_address; ?>" required>

    <label>Country</label>
    <input type="text" name="user_country" class="standard_input" value="<?php echo $user_country; ?>" required>

    <input type="submit" value="Submit" name="form_user_update" class="button_action">
  </form>
</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>
