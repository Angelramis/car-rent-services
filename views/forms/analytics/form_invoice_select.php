<?php //Header
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/header.php';
?>

<head>
  <link rel="stylesheet" href="/student073/dwes/css/analytics.css">
</head>


<main>
  <h1 class="text-center text-2xl p-3">Daily invoice</h1>
  <div class="grafico-div">
    <canvas id="grafico"></canvas>

  </div>

</main>

<script type="module" src="/student073/dwes/js/chart.js"></script>

<script>
    async function cargarDatos() {
            const response = await fetch('/student073/dwes/views/db/analytics/db_invoice_select.php');
            const data = await response.json();

            console.log(data);
            const labels = data.map(item => item.day);
            const valores = data.map(item => item.total_invoice);

            // Crear gráfico con Chart.js
            let canvas = document.getElementById('grafico').getContext('2d');
            new Chart(canvas, {
                type: 'line', // Tipo de gráfico
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Euros',
                        data: valores,
                        backgroundColor: 'rgba(255, 248, 121, 0.79)',
                        borderColor: 'rgb(0, 81, 255)',
                        borderWidth: 1
                    }]
                }
            });
    }

    cargarDatos();
</script>

<?php //Footer
  include $_SERVER['DOCUMENT_ROOT'].'/student073/dwes/views/includes/footer.php';
?>