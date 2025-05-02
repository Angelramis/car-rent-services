<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>
<div class="flex flex-col justify-center w-auto min-w-[400px] h-auto min-h-[200px] bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

  // Verificar si los datos del formulario se han enviado
  if (isset($_POST['form-user-update'])) {
    $user_id = htmlspecialchars($_POST['user-id']);
    $user_email = htmlspecialchars($_POST['user-email']);
    $user_nif = htmlspecialchars($_POST['user-nif']);
    $user_firstname = htmlspecialchars($_POST['user-firstname']);
    $user_lastname = htmlspecialchars($_POST['user-lastname']);
    $user_phone = htmlspecialchars($_POST['user-phone']);
    $user_address = htmlspecialchars($_POST['user-address']);
    $user_country = htmlspecialchars($_POST['user-country']);
    $user_birthdate = htmlspecialchars($_POST['user-birthdate']);
    $user_license_number = htmlspecialchars($_POST['user-license-number']);
    $user_license_expedition = htmlspecialchars($_POST['user-license-expedition']);
    $user_license_expiration = htmlspecialchars($_POST['user-license-expiration']);

    // Preparar la consulta de actualización
    $sql_update = "UPDATE users SET
                    user_email = '$user_email',
                    user_nif = '$user_nif',
                    user_firstname = '$user_firstname',
                    user_lastname = '$user_lastname',
                    user_phone = '$user_phone',
                    user_address = '$user_address',
                    user_country = '$user_country',
                    user_birthdate = '$user_birthdate',
                    user_license_number = '$user_license_number',
                    user_license_expedition = '$user_license_expedition',
                    user_license_expiration = '$user_license_expiration'
                    WHERE user_id = '$user_id'";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql_update)) {
  ?>
      <div class="flex flex-col items-center">
        <p>Successfully updated</p>
        <form action="/car-rent-services/views/forms/users/form-user-admin.php" method="POST">
          <input type="submit" value="Back" name="form-user-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
        </form>
      </div>
  <?php
    } else {
      echo "<p>Error updating the user: " . mysqli_error($conn) . "</p>";
    }
  }


  mysqli_close($conn);
  ?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>