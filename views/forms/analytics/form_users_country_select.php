<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<head>
  <link rel="stylesheet" href="/student073/dwes/css/analytics.css">
</head>


<main>
  <h1 class="text-center text-2xl p-3">Users country</h1>
  <div class="grafico-div-circulo">
    <canvas id="grafico"></canvas>

  </div>
  



</main>

<script type="module" src="/student073/dwes/js/chart.js"></script>

<script>
    async function cargarDatos() {
            const response = await fetch('/student073/dwes/views/db/analytics/db_users_country_select.php');
            const data = await response.json();

            console.log(data);
            let countryNames = data.map(item => item.country);
            let cantidadPaises = data.map(item => item.quantity);
            let colors = ["red", "green","blue","orange","brown", "purple", "grey", "pink", "yellow", "lightblue", "magenta", "lightred"];

            console.log(countryNames);
            // Crear gráfico con Chart.js
            let canvas = document.getElementById('grafico').getContext('2d');
            new Chart(canvas, {
                type: 'pie', // Tipo de gráfico
                data: {
                    labels: countryNames,
                    datasets: [{
                        backgroundColor: colors,
                        data: cantidadPaises
                    }]
                }
            });
    }
    cargarDatos();
</script>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>