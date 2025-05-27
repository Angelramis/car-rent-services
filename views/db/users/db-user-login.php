<?php //Includes
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>

<?php
// include conexion a bbdd
include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

// Verificar si se ha enviado el formulario login o usuario se ha registrado
if (isset($_POST['form-user-login']) || isset($_POST['user_registered_autologin'])) {

  // Guardar los datos del formulario y del resto del usuario
  $user_email = htmlspecialchars($_POST['user_email']);
  $user_pwd = htmlspecialchars($_POST['user_pwd']);
  $user_firstname = "";

  // Validar que ningún input esté vacío
  if (empty($user_email) || empty($user_pwd)) {
?>
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
      <p class='text-center text-red-500'>All the fields need to be filled.</p>
      <a href="/views/forms/users/form-user-login.php">
        <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
                  rounded-lg shadow-md transition duration-300">
      </a>
    </div>
    <?php
    exit();
  }

  // Consulta SQL para encontrar el usuario
  $sql_query = "SELECT * 
                FROM `users` 
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


      // Redirigir a la página principal
      header("Location: /index.php");
      exit();
    } else {
      // Contraseña incorrecta
    ?>
      <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
        <p class='text-center text-red-500'>Incorrect password. Try again.</p>
        <a href="/views/forms/users/form-user-login.php">
          <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
                  rounded-lg shadow-md transition duration-300">
        </a>
      </div>
    <?php
      exit();
    }
  } else {
    // Usuario no encontrado
    ?>
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
      <p class='text-center text-red-500'>User not found. Try again.</p>
      <a href="/views/forms/users/form-user-login.php">
        <input type="button" value="Go Back" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
                  rounded-lg shadow-md transition duration-300">
      </a>
    </div>
<?php
    exit();
  }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/footer.php';
?>