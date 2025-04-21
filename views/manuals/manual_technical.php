<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>

<head> <!-- Head extra -->
  <link rel="stylesheet" href="/student073/dwes/css/manuals.css">
</head>

<main>
  <div class="div_manual">
  <h1 class="text-2xl mb-2 mt-2">TO DO</h1>





  <h1 class="text-2xl mb-2 mt-2">DONE</h1>
    <p>- Instalado Tailwindcss. Fichero css instalado.</p>
    <p>- 12 formularios + ficheros de acción. + autorellenado en update.</p>
    <p>- Añadido include conexion a BBDD a todas las páginas pertinentes.</p>
    <p>- Contenido BBDD renombrado con prefijo 073_ 
      + nombre BBDD cambiado a 073_hms_db + actualizado código acorde PHP</p>
    <p>- Aplicado htmlspecialchars() a todos los $_POST que introduce el usuario para 
      evitar inyección de código malicioso en formularios.
    </p>
    <p>Menús desplegables. Funcionando link a style.css y script js.</p>
    <p>Funcionalidad logout del usuario.</p>
    <p>Funcionalidad para el usuario de cancelar sus reservas activas.</p>

    <h2>26-11-24</h2>
    <p>El usuario puede ver sus reservas y si están en estado booked poder darle a cancelar desde página my reservations.</p>
    <p>Funcionalidad de log out.</p>

    <h2>27-11-24</h2>
    <p>Roles del usuario en session session_user_roles en el db de log in y en header session. Dependiento de los roles, elementos del header no se ven.</p>
    <p>Poder buscar reservas (desde select de admin premises).</p>

    <h2>29-11-24</h2>
    <p>Funcionalidad para ocultar log in y log out en header en base si el usuario ha iniciado o no sesión.</p>
    <p>Mejorado presentación de los manuales.</p>

    <h2>4-12-24</h2>
    <p>Puesto el input file en el form de insert de premise.</p>
    <p>Hecho los primeros pasos de la página de extras services</p>

    <h2>10-12-24</h2>
    <p> Funcionando punto de utilización de Cookies en formulario buscar premises. Si no hay datos, se ponen los inputs en blanco.</p>
    <p>Seguridad: evitar que las páginas según el rol, no pueda ver el contenido. Se redirige automáticamente al inicio. Lógica en header. No se hace include porque se requieren roles diferentes por cada página.</p>
    <p>Photo preview -> ponerle un tamaño fijo a imagen -> usado aspect ratio css.</p>
    
    <h2>12-12-24</h2>
    <p>Primera versión daily invoice como funcionalidad extra.</p>
    <p>Funcionalidad de modificación de reservation_state en reservation update.</p>

    <h2>18-12-24</h2>
    <p>Hecho responsive para movil/tablet el header. </p>
    <p>Eliminado carpetas de proyecto que no servían, como customers, 
      y movido carpetas que no son el proyecto, como exercices.</p>
    <p>Poder encontrar reservas con ajax método get poniendo el nif del cliente.</p>

    <h2>15-1-25</h2>
    <p> funcionando archivos css individuales concretos para páginas como index.html. Quitado clases específicas en style.css general.
      Reservation_select: que en los resultados de las reservas, haya un botón editar y que lleve a la página de editarla, para cambiarle estado checkin/checkout. Y al cambiarle el estado. 
    </p>

    <h2>23-1-25</h2>
    <p>Hacer que en el update de reservation solo puedas cambiar el estado. Lo demás solo visible. 
    Hecho que en resultados reservations select si esta cancelada, no puedas cambiar editarla.
    Hecha la creación de reservas automáticas con procedimiento SQL.
    </p>

    <h2>12-2-25</h2>
    <p>Poder contratar y reservar un servicio:
    Que salgan los reservation number activos del cliente en form service book.
    Que con AJAX se asigne al input de date, el atributo min y max según el date_in  y date_out de la reserva en base al número de reserva escogido.
    Que se asignen las horas disponibles según el día escogido.
    Hecha gestión submit que se añada a tabla reservation_services y en json a tabla reservations.
    </p>

    <h2>18-2-25</h2>
    <p>Procedimiento con evento para actualizar estados reservas diario.</p>
    <p>Hecho en php la solicitud y muestra como primera versión del tiempo con accuWeather 5 day forecast. Aún faltando más funciones como icono, maquetación mejor y guardado en BBDD.
    Hecha tabla reviews
    </p>

    <h2>20-2-25</h2>
    <p>Acabado registro log in log en fichero con estructura JSON.</p>

    <h2>26-2-25</h2>
    <p>Comentarios clientes. Solo para clientes reales (al menos una reserva en estado check out.) y solo un comentario por reserva. 
    </p>
    <p>Y página admin para aceptarlos o rechazarlos. Al rechazar una review directamente la estás eliminando de la base de datos para que no aparezca en reviews pendientes. No es la mejor gestión pero bueno.
    Hecho funcionalidad de registrarse. Con verificaciones de campos con PHP. Si se registra correctamente y le da a login, se inicia sesión automáticamente.
    Hecho que se vea por pantalla los registros del archivo login log json de forma maquetada sencilla.
    Mejorada estética general.
    </p>

    <h2>4-3-25</h2>
    <p>Añadido NIF en registrarse, quitado el guardado de contraseñas en cookies.
    Implementadas validaciones en user login con PHP.
    </p>

  <h1 class="text-2xl mb-2 mt-2">FUTURE IDEAS</h1>
  <p>Idea funciones showError(), para maquetación errores.</p>
  <p>Encriptación de contraseñas</p>


  </div>
  </main>
<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>