<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Email</label>
  <input type="text" name="user_email" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_email']) ? htmlspecialchars($_COOKIE['user_email']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">NIF</label>
  <input type="text" name="user_nif" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_nif']) ? htmlspecialchars($_COOKIE['user_nif']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">First Name</label>
  <input type="text" name="user_firstname" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_firstname']) ? htmlspecialchars($_COOKIE['user_firstname']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Last name</label>
  <input type="text" name="user_lastname" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_lastname']) ? htmlspecialchars($_COOKIE['user_lastname']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Phone</label>
  <input type="text" name="user_phone" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_phone']) ? htmlspecialchars($_COOKIE['user_phone']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Birthdate</label>
  <input type="date" name="user_birthdate" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_birthdate']) ? htmlspecialchars($_COOKIE['user_birthdate']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Address</label>
  <input type="text" name="user_address" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_address']) ? htmlspecialchars($_COOKIE['user_address']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Country</label>
  <input type="text" name="user_country" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_country']) ? htmlspecialchars($_COOKIE['user_country']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Password</label>
  <input type="password" name="user_pwd" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_pwd']) ? htmlspecialchars($_COOKIE['user_pwd']) : ''; ?>">
</div>
<div>
  <label class="block text-sm font-medium text-gray-700 text-left">Repeat password</label>
  <input type="password" name="user_pwd_repeated" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_pwd_repeated']) ? htmlspecialchars($_COOKIE['user_pwd_repeated']) : ''; ?>">
</div>

<div class="mt-4 p-4 border border-gray-300 rounded-md">
  <h3 class="text-lg font-medium text-gray-700 mb-2">Driving license information</h3>
  <div>
    <label class="block text-sm font-medium text-gray-700 text-left">Driving license number</label>
    <input type="text" name="user_license_number" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_license_number']) ? htmlspecialchars($_COOKIE['user_license_number']) : ''; ?>">
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700 text-left">Expedition date</label>
    <input type="date" name="user_license_expedition" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_license_expedition']) ? htmlspecialchars($_COOKIE['user_license_expedition']) : ''; ?>">
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700 text-left">Expiration date</label>
    <input type="date" name="user_license_expiration" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm
        focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($_COOKIE['user_license_expiration']) ? htmlspecialchars($_COOKIE['user_license_expiration']) : ''; ?>">
  </div>
</div>