<nav class="w-full flex flex-row gap-3 justify-center bg-white rounded-xl shadow-lg p-3">
      <form action="/car-rent-services/views/forms/cars/form-car-admin.php" method="POST" class="flex p-1 gap-1 rounded-lg transition hover:bg-blue-300 hover:cursor-pointer">
          <img src="/car-rent-services/assets/icons/car.png" alt="display-icon" class="h-6 w-6">
            <input type="submit" class="text-black" value="Cars" name="form-car-admin">
      </form>

      <form action="/car-rent-services/views/forms/users/form-user-admin.php" name="form-user-admin" method="POST" class="flex p-1 gap-1 rounded-lg transition hover:bg-blue-300 hover:cursor-pointer">
          <img src="/car-rent-services/assets/icons/user.png" alt="display-icon" class="h-6 w-6">
            <input type="submit" class="text-black" value="Users" name="form-user-admin">
      </form>

      <form action="/car-rent-services/views/forms/reservations/form-reservation-admin.php" method="POST" class="flex p-1 gap-1 rounded-lg transition hover:bg-blue-300 hover:cursor-pointer">
          <img src="/car-rent-services/assets/icons/reservation.png" alt="display-icon" class="h-6 w-6">
            <input type="submit" class="text-black" value="Reservations" name="form-reservation-admin">
      </form>
  </nav>