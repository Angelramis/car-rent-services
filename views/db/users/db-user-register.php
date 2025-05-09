<?php //Includes
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<?php
  // include conexion a bbdd
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/db/db_includes/db_connection.php';

  // Verificar si se ha enviado el formulario register
  if (isset($_POST['form-user-register'])) {
    // Guardar los datos del formulario y del resto del usuario
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_nif = htmlspecialchars($_POST['user_nif']);
    $user_firstname = htmlspecialchars($_POST['user_firstname']);
    $user_lastname = htmlspecialchars($_POST['user_lastname']);
    $user_phone = htmlspecialchars($_POST['user_phone']);
    $user_address = htmlspecialchars($_POST['user_address']);
    $user_country = htmlspecialchars($_POST['user_country']);
    $user_birthdate = htmlspecialchars($_POST['user_birthdate']);
    $user_pwd = htmlspecialchars($_POST['user_pwd']);
    $user_pwd_repeated = htmlspecialchars($_POST['user_pwd_repeated']);
    $user_license_number = htmlspecialchars($_POST['user_license_number']);
    $user_license_expedition = htmlspecialchars($_POST['user_license_expedition']);
    $user_license_expiration = htmlspecialchars($_POST['user_license_expiration']);

    // Guardar los datos en una cookie por si hay un error, autorrellenar campos login
    setcookie('user_email', $user_email, time() + (86400), "/"); // 86400 = 1 dia
    setcookie('user_nif', $user_nif, time() + (86400), "/");
    setcookie('user_firstname', $user_firstname, time() + (86400), "/");
    setcookie('user_lastname', $user_lastname, time() + (86400), "/");
    setcookie('user_phone', $user_phone, time() + (86400), "/");
    setcookie('user_address', $user_address, time() + (86400), "/");
    setcookie('user_country', $user_country, time() + (86400), "/");
    setcookie('user_birthdate', $user_birthdate, time() + (86400), "/");
    setcookie('user_license_number', $user_license_number, time() + (86400), "/");
    setcookie('user_license_expedition', $user_license_expedition, time() + (86400), "/");
    setcookie('user_license_expiration', $user_license_expiration, time() + (86400), "/");

    // Validaciones de campos

    // Validar que ningún input esté vacío
    if (empty($user_email) || empty($user_nif) || empty($user_firstname) || empty($user_lastname) 
    || empty($user_phone) || empty($user_address) || empty($user_country) || empty($user_pwd)
    || empty($user_pwd_repeated) || empty($user_birthdate) || empty($user_license_number) 
    || empty($user_license_expedition) || empty($user_license_expiration)) {
      ?>
      <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
          <p class='text-center text-red-500'>All the fields need to be filled</p>
          <a href="/car-rent-services/views/forms/users/form-user-register.php">
            <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
            rounded-lg shadow-md transition duration-300">
          </a>
        </div>
      <?php
      exit();
    }

    // Validar que el email sea correcto
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      ?>
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
          <p class='text-center text-red-500'>Invalid email</p>
          <a href="/car-rent-services/views/forms/users/form-user-register.php">
            <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
            rounded-lg shadow-md transition duration-300">
          </a>
        </div>
      <?php
      exit();
    }

    // Validar que las contraseñas sean iguales
    if ($user_pwd != $user_pwd_repeated) {
      ?>
        <p class='text-center text-red-500'>Passwords does not match</p>
        <a href="/car-rent-services/views/forms/users/form_user_register.php">
          <input type="button" value="Go Back" class="button_action">
        </a>
      <?php
      exit();
    }

    // Consulta SQL por si el email ya existe en la BBDD
    $sql_email = "SELECT user_email 
                  FROM `users` 
                  WHERE user_email = '$user_email'";
    
    // Ejecutar consulta SQL a la base de datos
    $execute_sql_email = mysqli_query($conn, $sql_email);

    // Comprobar si el email ya existe en la BBDD
    if (mysqli_num_rows( $execute_sql_email) > 0) {
      ?>
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
          <p class='text-center text-red-500'>Email already exists. Try another one.</p>
          <a href="/car-rent-services/views/forms/users/form-user-register.php">
            <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
            rounded-lg shadow-md transition duration-300">
          </a>
        </div>
      <?php
      exit();
    }

    // Consulta SQL para insertar el usuario si todo es correcto
    $sql_insert_user = "INSERT INTO `users` (user_email, user_roles, user_nif, user_firstname, user_lastname, user_phone, user_address, user_country, user_birthdate, user_pwd, user_license_number, user_license_expedition, user_license_expiration) 
                      VALUES ('$user_email', 'user', '$user_nif', '$user_firstname', '$user_lastname', '$user_phone', '$user_address', '$user_country', '$user_birthdate', '$user_pwd', '$user_license_number', '$user_license_expedition', '$user_license_expiration')";

    // Ejecutar consulta SQL a la base de datos
    $execute_sql_insert_user = mysqli_query($conn, $sql_insert_user);

    // Comprobar si se ha insertado el usuario
    if ($execute_sql_insert_user) {
      // Si el registro y el INSERT ha sido correcto
      ?>
      <form action="/car-rent-services/views/db/users/db-user-login.php" method="POST" class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
          <p class='text-center text-green-600'>User registered successfully</p>
          <a href="/car-rent-services/views/forms/users/form-user-register.php">
          <input type="text" name="user_email" value="<?php echo $user_email; ?>" class="hidden">
          <input type="text" name="user_pwd" value="<?php echo $user_pwd; ?>" class="hidden">
            <input type="submit" name="user_registered_autologin" value="Login now" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
            rounded-lg shadow-md transition duration-300">
          </a>
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
        setcookie('user_birthdate', "", time() - 3600, "/");
        setcookie('user_license_number', "", time() - 3600, "/");
        setcookie('user_license_expedition', "", time() - 3600, "/");
        setcookie('user_license_expiration', "", time() - 3600, "/");
        
    } else {
      ?>
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
          <p class='text-center text-red-500'>An error ocurred registering the user.</p>
          <a href="/car-rent-services/views/forms/users/form-user-register.php">
            <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
            rounded-lg shadow-md transition duration-300">
          </a>
        </div>
      <?php
    }
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
?>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>