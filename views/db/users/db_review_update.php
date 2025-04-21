<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
  
  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>
<main>
<?php
  // Conexion a BBDD
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/db/db_includes/db_connection.php';

  // Si se ha pulsado el botón form submit, iniciar gestión
  if (isset($_POST['form_review_update'])) {
    // Variables
    $review_id = htmlspecialchars($_POST['review_id']);
    $button_state = htmlspecialchars($_POST['form_review_update']);

    $sql_query = null;

    // Si se ha clicado aceptar
    if ($button_state == '1') {
      // Consulta SQL update
      $sql_query = 
      "UPDATE `073_reviews`
      SET review_accepted = 1, review_reviewed = 1
      WHERE review_id = '$review_id';";

    // Si se ha clicado rechazar
    } elseif ($button_state == '0') {
      // Consulta SQL 
      $sql_query = 
      "UPDATE `073_reviews`
      SET review_accepted = 0, review_reviewed = 1
      WHERE review_id = '$review_id';";
    } else {
      echo "Error updating the review";
      exit();
    }

    // Ejecutar consulta SQL a la BBDD
    $execute_query = mysqli_query($conn, $sql_query);

    if ($execute_query) {
      ?>
      <div class="border_div">
        <?php if ($button_state == '1') { ?>
          <p>Review accepted succesfully</p>
        <?php } elseif ($button_state == '0') { ?>
          <p>Review refused succesfully</p>
        <?php } ?>
        <a href="/student073/dwes/views/forms/users/form_reviews_management.php">
          <button class="button_action">Go back</button>
        </a>
      </div>
    <?php
    } else {
      echo "Error updating the review" . mysqli_error($con);
    }
     
}

  // Cerrar conexión con BBDD
  mysqli_close($conn);
?>  

</main>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>