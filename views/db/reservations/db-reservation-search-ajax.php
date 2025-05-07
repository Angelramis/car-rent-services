<?php
// mi-db.php

include $_SERVER['DOCUMENT_ROOT'] . '/car-rent-services/views/db/db_includes/db_connection.php';

// Sanitizar y recoger la búsqueda
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$sql = "SELECT * 
        FROM reservations_view";

if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($conn, $search);
    $sql .= " WHERE rs_number LIKE '%$safe_search%' 
           OR user_nif LIKE '%$safe_search%'
           OR user_fullname LIKE '%$safe_search%'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($rs = mysqli_fetch_assoc($result)) {
        echo '<form action="/car-rent-services/views/forms/reservations/form-reservation-edit.php" method="POST" onclick="this.submit()" class="w-full grid grid-cols-9 items-center gap-2 rounded-md shadow px-2 py-4 transition hover:cursor-pointer hover:bg-blue-300">';
        
        echo '<input type="hidden" name="rs_number" value="' . htmlspecialchars($rs['rs_number']) . '">';
    
        echo '<p>' . htmlspecialchars($rs['rs_number']) . '</p>';
        echo '<p>' . htmlspecialchars($rs['user_nif']) . '</p>';
        echo '<p>' . htmlspecialchars($rs['user_fullname']) . '</p>';
        echo '<p>' . htmlspecialchars($rs['car_plate']) . '</p>';
        echo '<p>' . htmlspecialchars($rs['rs_pickup_date']) . ' - ' . htmlspecialchars($rs['rs_pickup_time']) . 'h</p>';
        echo '<p>' . htmlspecialchars($rs['rs_dropoff_date']) . ' - ' . htmlspecialchars($rs['rs_dropoff_time']) . 'h</p>';
        echo '<p>' . htmlspecialchars($rs['rs_status']) . '</p>';
        echo '<p>' . htmlspecialchars($rs['rs_created_at']) . '</p>';
        echo '<p>' . htmlspecialchars($rs['rs_total_price']) . '</p>';
    
        echo '<img src="/car-rent-services/assets/icons/edit.png" alt="Edit" class="w-7">';
        echo '</form>';
    }    
} else {
    echo '<p class="col-span-12 text-center py-4 text-gray-500">No results found.</p>';
}

mysqli_close($conn);
