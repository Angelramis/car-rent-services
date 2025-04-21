<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
?>

<head> <!-- Head extra -->
  <link rel="stylesheet" href="/student073/dwes/css/manuals.css">
</head>

<main>
  <div class="div_manual">
    <h1 class="text-center text-2xl">User Manual</h1>
    <h2 class="text-xl">Utilización de la web:</h2>
    
    <h2>Usuario</h2>
    <p>Para iniciar sesión, se debe hacer click en el botón de 
      Account > Log in. Introducir el correo y contraseña.
    </p>

    <p>Si no tiene usuario, el usuario puede registrarse accediento a Account > Register,
      donde insertará todos los datos requeridos, y si cumple con las verificaciones, se registrará
      en la web.
    </p>
    
    <p>Para reservar una premisa, se debe hacer click en el botón book, rellenar los datos pertinentes,
      y seleccionar la premisa deseada.
    </p>

    <p>Si se quiere cancelar una reserva activa, debe ir a la página "My Reservations", y clicar en el botón "Cancel".</p>

    <p>Para reservar un servicio, acceder a la página Services, asignar los campos correspondientes.
      Saldrán las horas disponibles dentro de las fechas elegidas dentro de la reserva.
    </p>

    <p>Puede consultar las condiciones meteorológicas en la página "Weather". Actualmente de los 5 próximos días incluido el día de hoy.
      Obtenida la información de una API externa de AccuWeather.
    </p>

    <p>Las reservas activas como usuario, aparecen en la página "My Reservations", saliendo la información importante de esta, así como los servicios 
      contratados con sus datos, si se han hecho.
    </p>

    <p>Para reservar una premisa, se debe hacer click en el botón book, rellenar los datos pertinentes,
      y seleccionar la premisa deseada.
    </p>

    <p>Si ya ha completado por lo menos una reserva, puede crear una reseña que, con una aprobación previa por administradores,
      se publicará en la página principal de la web. Introduciendo la valoración visual y un comentario. 
    </p>

    <h2>Empleado</h2>
    <p>Como recepcionista, para cambiar el estado de las reservas, debe acceder al panel "Admin",
    </p>> "Reservations" > "Update". Introducir el campo correspondiente para acceder a la reserva,
      y podrá actualizar los campos deseados, como el estado de Check-in a Check-Out.

    <h2>Administrador</h2>
    <p>En el encabezado de la web, tiene acceso al botón Admin, usado para gestionar datos con la base de datos.
      Insertar/modificar/ver y eliminar premisas, usuarios y reservas.
    </p>
    <p>Formularios como la búsqueda de usuarios y reservas, ofrecen un sistema llamado AJAX que permite, a medida que escribe,
      mostrar los resultados que conciden con la búsqueda, para ofrecer un ahorro de tiempo en encontrar la información deseada.
    </p>
    <p>Además, puede ver datos estadísticos del hotel, accedediendo al apartado "Analytics",
      donde encontrará los gráficos disponibles para comprobar varios datos, 
      como la facturación, información de los clientes, o, en formato de texto, qué usuarios
      han iniciado sesión con sus respectivas fechas.
    </p>

    <p>Tanto administradores, empleados como usuarios pueden realizar acciones como usuarios normales, como reservar premisas y
      contratar servicios.
    </p>
  </div>
</main>


  
<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>