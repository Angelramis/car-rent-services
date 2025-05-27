<?php
// mi-db.php

include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

// Sanitizar y recoger la búsqueda
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$sql = "SELECT * FROM cars";

if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($conn, $search);
    $sql .= " WHERE car_brand LIKE '%$safe_search%' 
           OR car_model LIKE '%$safe_search%'";
}

$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    while ($car = pg_fetch_assoc($result)) {
        echo '<form action="/views/forms/cars/form-car-edit.php" method="POST" onclick="this.submit()" class="w-full grid grid-cols-12 items-center gap-2 rounded-md shadow px-2 py-4 transition hover:cursor-pointer hover:bg-blue-300">';
        echo '<input type="hidden" name="car_id" value="' . htmlspecialchars($car['car_id']) . '">';

        echo '<p>' . htmlspecialchars($car['car_brand']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_model']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_price_per_day']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_doors']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_seats']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_space_bags']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_fuel']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_unlimited_mileage']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_free_cancellation']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_min_age']) . '</p>';
        echo '<p>' . htmlspecialchars($car['car_active']) . '</p>';
        echo '<img src="/assets/icons/edit.png" alt="Edit" class="w-7">';
        echo '</form>';
    }
} else {
    echo '<p class="col-span-12 text-center py-4 text-gray-500">No results found.</p>';
}

pg_close($conn);
