<?php //Includes
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>
<main>
<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // Verificar si se ha enviado el formulario register
  if (isset($_POST['form_user_register'])) {
    // Guardar los datos del formulario y del resto del usuario
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_nif = htmlspecialchars($_POST['user_nif']);
    $user_firstname = htmlspecialchars($_POST['user_firstname']);
    $user_lastname = htmlspecialchars($_POST['user_lastname']);
    $user_phone = htmlspecialchars($_POST['user_phone']);
    $user_address = htmlspecialchars($_POST['user_address']);
    $user_country = htmlspecialchars($_POST['user_country']);
    $user_pwd = htmlspecialchars($_POST['user_pwd']);
    $user_pwd_repeated = htmlspecialchars($_POST['user_pwd_repeated']);

    // Guardar los datos en una cookie por si hay un error, autorrellenar campos login
    setcookie('user_email', $user_email, time() + (86400), "/"); // 86400 = 1 dia
    setcookie('user_nif', $user_nif, time() + (86400), "/");
    setcookie('user_firstname', $user_firstname, time() + (86400), "/");
    setcookie('user_lastname', $user_lastname, time() + (86400), "/");
    setcookie('user_phone', $user_phone, time() + (86400), "/");
    setcookie('user_address', $user_address, time() + (86400), "/");
    setcookie('user_country', $user_country, time() + (86400), "/");

    // Validaciones de campos

    // Validar que ningún input esté vacío
    if (empty($user_email) || empty($user_nif) || empty($user_firstname) || empty($user_lastname) || empty($user_phone) || empty($user_address) || empty($user_country) || empty($user_pwd) || empty($user_pwd_repeated)) {
      ?>
        <p class='text-center text-red-500'> <?php echo "All the fields need to be filled"; ?></p>
        <a href="/car-rent-services/views/forms/users/form_user_register.php">
          <input type="button" value="Go Back" class="button_action">
        </a>
      <?php
      exit();
    }

    // Validar que el email sea correcto
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      ?>
        <p class='text-center text-red-500'> <?php echo "Invalid email"; ?></p>
        <a href="/car-rent-services/views/forms/users/form_user_register.php">
          <input type="button" value="Go Back" class="button_action">
        </a>
      <?php
      exit();
    }

    // Validar que las contraseñas sean iguales
    if ($user_pwd != $user_pwd_repeated) {
      ?>
        <p class='text-center text-red-500'> <?php echo "Passwords does not match"; ?></p>
        <a href="/car-rent-services/views/forms/users/form_user_register.php">
          <input type="button" value="Go Back" class="button_action">
        </a>
      <?php
      exit();
    }

    // Consulta SQL por si el email ya existe en la BBDD
    $sql_email = "SELECT user_email 
                  FROM `073_users` 
                  WHERE user_email = '$user_email'";
    
    // Ejecutar consulta SQL a la base de datos
    $execute_sql_email = mysqli_query($conn, $sql_email);

    // Comprobar si el email ya existe en la BBDD
    if (mysqli_num_rows( $execute_sql_email) > 0) {
      ?>
        <p class='text-center text-red-500'> <?php echo "Email already exists. Try another one"; ?></p>
        <a href="/car-rent-services/views/forms/users/form_user_register.php">
          <input type="button" value="Go Back" class="button_action">
        </a>
      <?php
      exit();
    }

    // Consulta SQL para insertar el usuario si todo es correcto
    $sql_insert_user = "INSERT INTO `073_users` (user_email, user_nif, user_firstname, user_lastname, user_phone, user_address, user_country, user_pwd) 
                      VALUES ('$user_email', '$user_nif', '$user_firstname', '$user_lastname', '$user_phone', '$user_address', '$user_country', '$user_pwd')";

    // Ejecutar consulta SQL a la base de datos
    $execute_sql_insert_user = mysqli_query($conn, $sql_insert_user);

    // Comprobar si se ha insertado el usuario
    if ($execute_sql_insert_user) {
      // Si el registro y el INSERT ha sido correcto
      ?>
        <p class='text-center'> <?php echo "User registered successfully"; ?></p>
        
        <form action="/car-rent-services/views/db/users/db_user_login.php" method="POST">
          <input type="text" name="user_email" value="<?php echo $user_email; ?>" class="hidden">
          <input type="text" name="user_pwd" value="<?php echo $user_pwd; ?>" class="hidden">
          <input type="submit" name="user_registered_autologin" value="Login now" class="button_action">
        </form>

      <?php
        // Expirar las cookies de register
        setcookie('user_email', "", time() - 3600, "/");
        setcookie('user_nif', "", time() - 3600, "/");
        setcookie('user_firstname', "", time() - 3600, "/");
        setcookie('user_lastname', "", time() - 3600, "/");
        setcookie('user_phone', "", time() - 3600, "/");
        setcookie('user_address', "", time() - 3600, "/");
        setcookie('user_country', "", time() - 3600, "/");
    } else {
      ?>
        <p class='text-center text-red-500'> <?php echo "Error registering user"; ?></p>
        <a href="/car-rent-services/views/forms/users/form_user_register.php">
          <input type="button" value="Go Back" class="button_action">
        </a>
      <?php
    }
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
?>
</main>