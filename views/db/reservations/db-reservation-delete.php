<?php // Header
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
?>
<div class="flex flex-col justify-center w-auto min-w-[400px] h-auto min-h-[200px] bg-white rounded-xl shadow-lg p-6">

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['db-reservation-delete'])) {
    $rs_number = htmlspecialchars($_POST['rs-number']);

    try {
        // Ejecutar la consulta
        $sql = "DELETE 
                FROM reservations 
                WHERE rs_number = '$rs_number';";
        pg_query($conn, $sql);
        ?>
        <div class="flex flex-col items-center">
          <p>Successfully deleted</p>
          <form action="/views/forms/reservations/form-reservation-admin.php" method="POST">
            <input type="submit" value="Back" name="form-reservation-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
          </form>
        </div>
        <?php
    } catch (mysqli_sql_exception $e) {
      ?>
        <div class="flex flex-col items-center">
          <p>Error: You can't delete a registered reservation.</p>
          <form action="/views/forms/reservations/form-reservation-admin.php" method="POST">
            <input type="submit" value="Back" name="form-reservation-admin" class="mt-2 bg-blue-500 text-white font-semibold min-h-12 py-2 !px-8 rounded-md w-auto hover:bg-blue-700 hover:cursor-pointer transition text-center block">
          </form>
        </div>
        <?php
    }
}

pg_close($conn);
?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/footer.php';
?>
