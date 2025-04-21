<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<?php

  // Leer el contenido de un archivo JSON y mostrarlo en pantalla
  $file = $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/logs/login-log.json';

  // Comprobación previa de si existe el archivo
  if (file_exists($file)) {
    // Leer el contenido del archivo
    $content = file_get_contents($file);
    // Decodificar el JSON
    $logs = json_decode($content, true);

    // Si el archivo está vacío o no contiene JSON válido, inicializar un array vacío
    if (!is_array($logs)) {
      $logs = [];
    }
  } else {
    echo "File doesn't exist";
    $logs = [];
  }


?>

<main>
  <div class="div_border">
  <h1 class="text-center text-2xl p-3">Users login</h1>
  <p>All logins registered in a local file</p>
  
  <?php if (!empty($logs)) { ?>
      <ul>
        <?php foreach ($logs as $user_email => $log){ ?>
          <li>
            <strong><?php echo htmlspecialchars($user_email); ?>:</strong>
            <ul>
              <?php foreach ($log['log-in'] as $date){ ?>
                <li><?php echo htmlspecialchars($date); ?></li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
      </ul>
    <?php } else { ?>
      <p>No logins found.</p>
    <?php } ?>

  </div>

</main>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>