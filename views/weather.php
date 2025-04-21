<?php
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/header.php';

  // Clave de la API
  $apiKey = 'VXQP3Z1VDUnnnHtuDrOa6oAcZe9NqGTO';

  // Clave del lugar donde obtener el tiempo
  $locationKey = '235049';

  // URL de la API
  $apiUrl = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/{$locationKey}?apikey={$apiKey}&language=en-us&metric=true";

  // Hacer la solicitud a la API
  $response = file_get_contents($apiUrl);

  // Decodificar el JSON recibido
  $weatherData = json_decode($response, true);
?>
<main>
  <h1 class="title">Weather</h1>
  <h2>Cancún, México</h2>

  <?php if (!empty($weatherData['DailyForecasts'])) { 
    ?>
    <div class="div_content_available">
      <?php foreach ($weatherData['DailyForecasts'] as $day) { 
          $iconNumber = str_pad($day['Day']['Icon'], 2, '0', STR_PAD_LEFT);
          $iconUrl = "https://developer.accuweather.com/sites/default/files/{$iconNumber}-s.png";
      ?>
        <div class="product_div">
          <img src="<?php echo $iconUrl; ?>">
          <h3><?php echo date('l, F j', strtotime($day['Date'])); ?></h3>
          <p>Max temperature: <?php echo $day['Temperature']['Maximum']['Value']; ?>°C</p>
          <p>Min temperature: <?php echo $day['Temperature']['Minimum']['Value']; ?>°C</p>
          <p>Weather: <?php echo $day['Day']['IconPhrase']; ?></p>
        </div>
      <?php } 
      ?>
      </div>
  <?php } else { ?>
      <p>There was an error getting the weather information.</p>
  <?php } ?>
</main>

<?php
  include $_SERVER['DOCUMENT_ROOT'].'/car-rent-services/views/includes/footer.php';
?>