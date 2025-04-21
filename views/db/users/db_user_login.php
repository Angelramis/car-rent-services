<?php //Includes
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/functions.php';
?>
<main>

<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

// Verificar si se ha enviado el formulario login o usuario se ha registrado
if (isset($_POST['form_user_login']) || isset($_POST['user_registered_autologin'])) {

  // Guardar los datos del formulario y del resto del usuario
  $user_email = htmlspecialchars($_POST['user_email']);
  $user_pwd = htmlspecialchars($_POST['user_pwd']);
  $user_firstname = "";

  // Validar que ningún input esté vacío
  if (empty($user_email) || empty($user_pwd)) {
    ?>
      <p class='text-center text-red-500'> <?php echo "All the fields need to be filled"; ?></p>
      <a href="/student073/dwes/views/forms/users/form_user_login.php">
        <input type="button" value="Go Back" class="button_action">
      </a>
    <?php
    exit();
  }

  // Consulta SQL para encontrar el usuario
  $sql_query = "SELECT * 
                FROM `073_users` 
                WHERE user_email = '$user_email'";
  
  // Ejecutar consulta SQL a la base de datos
  $execute_query = mysqli_query($conn, $sql_query);

  // Verificar si el usuario existe
  if ($execute_query && mysqli_num_rows($execute_query) > 0) {
      // Obtener el usuario
      $user = mysqli_fetch_assoc($execute_query);

      // Si el usuario es correcto
      if ($user_pwd == $user['user_pwd']) {
          // Obtener el resto de datos
          $user_firstname = $user['user_firstname'];
          $user_lastname = $user['user_lastname'];

          // Iniciar sesión y redirigir usuario
          $_SESSION['user_id'] = $user['user_id'];
          $_SESSION['user_firstname'] = $user['user_firstname'];
          $_SESSION['user_roles'] = $user['user_roles'];

          // Insertar el inicio de sesión en fichero JSON de login_log
          actualizarLoginLog($user_email);

          // Redirigir a la página principal
          header("Location: /student073/dwes/index.php");
          exit();
      } else {
          // Contraseña incorrecta
          ?>
            <p class='text-center text-red-500'> <?php echo "Incorrect password. Please try again."; ?></p>
            <a href="/student073/dwes/views/forms/users/form_user_login.php">
              <input type="button" value="Go Back" class="button_action">
            </a>
          <?php
          exit();
        }
  } else {
      // Usuario no encontrado
      ?>
      <p class='text-center text-red-500'> <?php echo "User not found. Please try again"; ?></p>
      <a href="/student073/dwes/views/forms/users/form_user_login.php">
        <input type="button" value="Go Back" class="button_action">
      </a>
      <?php
      exit();
  }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
</main>