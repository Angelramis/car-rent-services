<?php //Header
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/header.php';
?>

<h1 class="text-center text-2xl p-3">User Manual</h1>

<div class="flex flex-col h-auto gap-3 bg-white shadow-md rounded-md max-w-4xl mx-auto w-full p-4">

  <h2 class="font-bold text-xl">Usuario</h2>
  <p>Para iniciar sesión, se debe hacer click en el botón de
    Account > Log in. Introducir el correo y contraseña.
  </p>

  <p>Si no tiene usuario, el usuario puede registrarse accediento a Account > Register,
    donde insertará todos los datos requeridos, y si cumple con las verificaciones, se registrará
    en la web.
  </p>

  <p>Para alquilar un coche, primero se debe tener una cuenta con la sesión iniciada. Después, se deben rellenar los campos pertinentes en el formulario de la página principal,
     hacer click en el botón Search, y podrá seleccionar cualquier coche de los que aparezcan como resultados.
     Al seleccionar uno, verá las características en detalle del coche, y podrá seleccionar extras para la reserva.
     Finalmente, procederá con el pago online y se le informará al pagar en la propia web del estado de la operación.
  </p>

  <img src="/car-rent-services/assets/images/general/car-search.png" alt="Admin panel">

  <p>Las reservas hechas aparecen en la página "My Reservations", saliendo la información importante de estas.</p>

  <p>Si se quiere cancelar una reserva activa, debe ir a la página "My Reservations", y clicar en el botón "Cancel".</p>
  

  <h2 class="font-bold text-xl">Administrador</h2>

  <p>En el encabezado de la web, tiene acceso al botón Admin, usado para gestionar datos con la base de datos.
    Puede ver las reservas, gestionar la flota de coches y ver los usuarios creados.
  </p>

  <img src="/car-rent-services/assets/images/general/admin-panel.png" alt="Admin panel">

  <p>Como administrador, para cambiar el estado de las reservas, debe acceder al panel "Admin",
  > "Reservations" . Introducir el campo correspondiente para acceder a la reserva. 
  Solo podrá modificar el estado de una reserva de Confirmada a cancelada.</p>

  <p>Los administradores pueden alquilar coches como un usuario normal.</p>

  <p>En la página oficial de Stripe puede ver toda la información relacionada con los pagos.
    Teniendo una cuenta con acceso.</p>

</div>

<?php //Footer
include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/includes/footer.php';
?>