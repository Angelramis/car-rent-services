

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/vendor/autoload.php';

// Clave secreta
\Stripe\Stripe::setApiKey();

header('Content-Type: application/json');

// Información del pago
$intent = \Stripe\PaymentIntent::create([
  'amount' => 1000,
  'currency' => 'eur',
]);

echo json_encode(['clientSecret' => $intent->client_secret]);
