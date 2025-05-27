<?php

// Cargar variables del .env
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '')->load();

\Stripe\Stripe::setApiKey($_ENV['STRIPE_API_KEY']);


header('Content-Type: application/json');

try {
    $amount = floatval($_POST['total-amount']); // en euros
    $amount_cents = intval($amount * 100); // convertir a centavos

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount_cents,
        'currency' => 'eur',
        'metadata' => [
            'car_id' => $_POST['car-id'],
            'pickup' => $_POST['pickup-date'] . ' ' . $_POST['pickup-time'],
            'dropoff' => $_POST['dropoff-date'] . ' ' . $_POST['dropoff-time'],
            'extras' => $_POST['extras-data'],
        ],
    ]);

    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);

} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
