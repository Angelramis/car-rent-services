<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';
  
  // Verificar si el usuario no tiene un rol permitido
  if (!strstr($session_user_roles, 'admin',)) { // Si no es admin
    header("Location: /car-rent-services/index.php");
    exit();
  }
?>

<!-- Uso de AJAX con método POST -->

<main>
  <div class="div_border">
    <h1 class="text-center text-2xl p-2">Users</h1>
    <form name="formData" action="" method="POST"> 
    <label>User NIF</label>
    <input type="text" name="user_nif" class="standard_input" onkeyup="inputManagement()">
    </form>
  </div>

  <div class="div_content_available mt-5" id ="div-content">
    
  </div>

</main>

<script>

  function inputManagement() {
    /* Capturar datos del formulario */
    let textInput = document.formData.user_nif.value;

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
      httpQuery.open("POST","/car-rent-services/views/db/users/db_user_select_ajax.php",true);
      httpQuery.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      httpQuery.send("query=" + textInput); // Mandamos datos ocultados de la url
    }
  }

</script>



<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>