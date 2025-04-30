<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<div class="w-full max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-2xl">
  <h1 class="text-center text-2xl">Register</h1>
  <form action="/car-rent-services/views/db/users/db-user-register.php" method="POST">
    <?php //Register form
    include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/register-form.php';
    ?>
    <input type="submit" value="Submit" name="form-user-register" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
                                   rounded-lg shadow-md transition duration-300">
  </form>
</div>

<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>