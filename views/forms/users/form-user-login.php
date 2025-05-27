<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/header.php';
?>

  <div class="w-full max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-2xl">
    <h1 class="text-center text-2xl">Log in</h1>
    <form class="flex flex-col text-center p-5" action="/views/db/users/db-user-login.php" method="POST">
      
      <label>Email<span class="text-red-500">*</span></label>
      <input type="text" name="user_email" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500">

      <label>Password<span class="text-red-500">*</span></label>
      <input type="password" name="user_pwd" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500">

      <input type="submit" value="Submit" name="form-user-login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 py-3 px-6
                                   rounded-lg shadow-md transition duration-300">
    </form>
    <div class="text-gray-600 text-left">
      <a href="/views/forms/users/form-user-register.php" class="text-blue-600">Don't have an account? Register here</a>
    </div>
  </div>
  

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/views/includes/footer.php';
?>