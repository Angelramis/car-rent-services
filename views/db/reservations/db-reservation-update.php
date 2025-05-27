<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>
<div class="flex flex-col justify-center w-auto min-w-[400px] h-auto min-h-[200px] bg-white rounded-xl shadow-lg p-6">

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

// Verificar si los datos del formulario se han enviado
if (isset($_POST['db-reservation-update'])) {

    $rs_number = htmlspecialchars($_POST['rs-number']);
    $rs_status = htmlspecialchars($_POST['rs-status']);

   // Solo poder actualizar si el nuevo estado es Cancelled
   if ($rs_status !== 'Cancelled') {
      header("Location: /");
      exit;
    }

    // Preparar la consulta de actualización
    $sql_update = "UPDATE reservations SET
                    rs_status = '$rs_status'
                    WHERE rs_number = '$rs_number'";

    // Ejecutar la consulta
    if (pg_query($conn, $sql_update)) {
        ?>
        <div class="flex flex-col items-center">
          <p>Successfully updated</p>
          <form action="/views/forms/reservations/form-reservation-admin.php" method="POST">
          <input type="submit" value="Back" name="form-reservation-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
        </form>
        </div>
      <?php
    } else {
        // Si la actualización falla, mostrar mensaje error
        echo "<p>Error updating the reservation. " . pg_last_error($conn) . "</p>";
    }
}

// Cerrar la conexión a la base de datos
pg_close($conn);
?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>