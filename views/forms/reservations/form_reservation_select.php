<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
  
   // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /student073/dwes/index.php");
    exit();
  }
?>
<!-- Uso de AJAX -->

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl p-2">Reservations</h1>
      <form action="" method="GET">
        <label for="user_nif">User NIF</label>
        <input type="text" name="user_nif" class="standard_input" onkeyup="inputManagement(this.value)">
      </form>
  </div>

  <div class="div_content_available mt-5" id ="div-content">
    
  </div>

</main>

<script>

  function inputManagement(textInput) {
    // Si no se ha escrito nada en el buscador, no mostrar nada
    if (textInput == "") {
      document.getElementById("div-content").innerHTML = "";
    return;
    
    // Si hay texto en el buscador, llamar archivo DB
  } else {
    let httpQuery = new XMLHttpRequest();

    httpQuery.onreadystatechange = function() {
      // Si la consulta es válida
      if (this.readyState == 4 && this.status == 200) { 
        document.getElementById("div-content").innerHTML = this.responseText;
      }
    };

    // Conexión con base de datos
    httpQuery.open("GET","/student073/dwes/views/db/reservations/db_reservation_select_ajax.php?query=" + textInput ,true);
    httpQuery.send();
  }
  }

</script>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>