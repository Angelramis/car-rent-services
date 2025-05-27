<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>
<h1 class='text-center text-2xl p-3'>Editing user</h1>

<?php //Admin models
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/admin-models.php';
?>

<div class="flex flex-col w-full min-h-screen bg-white rounded-xl shadow-lg p-6">

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

  if (isset($_POST['user_id'])) {
    $user_id = htmlspecialchars($_POST['user_id']);

    $sql_car = "SELECT *
              FROM users
              WHERE user_id = '$user_id';";

    $execute_query = pg_query($conn, $sql_car);

    $user = pg_fetch_assoc($execute_query);

    if ($execute_query) {
  ?>
      <nav class="flex flex-row-reverse gap-2 items-center">
        <form action="/views/db/users/db-user-delete.php" method="POST" name="user-delete">
          <input type="hidden" name="user-id" value="<?php echo $user['user_id']; ?>">
          <input type="submit" value="Delete" name="form-user-delete" class="mt-2 bg-red-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-red-300 hover:cursor-pointer transition text-center block">
        </form>
        <form action="/views/forms/users/form-user-admin.php" method="POST">
          <input type="submit" value="Cancel" name="form-user-admin" class="mt-2 bg-gray-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-gray-300 hover:cursor-pointer transition text-center block">
        </form>
      </nav>

      <form action="/views/db/users/db-user-update.php" name="form-user-update" method="POST" class="w-full">
        <input type="hidden" name="user-id" value="<?php echo $user['user_id']; ?>">
        <div class="w-full grid grid-cols-2 gap-2">

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-email">Email</label>
            <input type="text" id="user-email" class="bg-gray-200 rounded-md border-[1px] p-1" name="user-email" value="<?php echo $user['user_email']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-nif">NIF</label>
            <input type="text" id="user-nif" name="user-nif" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_nif']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-firstname">Firstname</label>
            <input type="text" id="user-firstname" name="user-firstname" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_firstname']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-lastname">Lastname</label>
            <input type="text" id="user-lastname" name="user-lastname" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_lastname']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-phone">Phone</label>
            <input type="text" id="user-phone" name="user-phone" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_phone']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-address">Address</label>
            <input type="text" id="user-address" name="user-address" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_address']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-country">Country</label>
            <input type="text" id="user-country" name="user-country" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_country']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-birthdate">Birthdate</label>
            <input type="date" id="user-birthdate" name="user-birthdate" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_birthdate']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-license-number">License number</label>
            <input type="text" id="user-license-number" name="user-license-number" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_license_number']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-license-expedition">License expedition</label>
            <input type="date" id="user-license-expedition" name="user-license-expedition" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_license_expedition']; ?>" required>
          </nav>

          <nav class="flex flex-col gap-1 p-2">
            <label for="user-license-expiration">License expiration</label>
            <input type="date" id="user-license-expiration" name="user-license-expiration" class="bg-gray-200 rounded-md border-[1px] p-1" value="<?php echo $user['user_license_expiration']; ?>" required>
          </nav>

        </div>
        <nav class="flex flex-row justify-between">
          <nav class="flex flex-row gap-2">
            <input type="submit" value="Save" name="form-user-update" class="mt-4 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-600 hover:cursor-pointer transition text-center block">
          </nav>
        </nav>
      </form>

  <?php
    }
  }

  pg_close($conn);
  ?>

</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>