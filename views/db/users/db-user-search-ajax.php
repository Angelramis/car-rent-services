<?php
// mi-db.php

include $_SERVER['DOCUMENT_ROOT'] . '/views/db/db_includes/db_connection.php';

// Sanitizar y recoger la búsqueda
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$sql = "SELECT * 
        FROM users";

if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($conn, $search);
    $sql .= " WHERE user_nif LIKE '%$safe_search%' 
           OR user_firstname LIKE '%$safe_search%'";
}

$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    while ($user = pg_fetch_assoc($result)) {
        echo '<form action="/views/forms/users/form-user-edit.php" method="POST" onclick="this.submit()" class="w-full grid grid-cols-8 items-center gap-2 rounded-md shadow px-2 py-4 transition hover:cursor-pointer hover:bg-blue-300">';
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user['user_id']) . '">';
        
        echo '<p>' . htmlspecialchars($user['user_roles']) . '</p>';
        echo '<p>' . htmlspecialchars($user['user_nif']) . '</p>';
        echo '<p>' . htmlspecialchars($user['user_firstname']) . '</p>';
        echo '<p>' . htmlspecialchars($user['user_lastname']) . '</p>';
        echo '<p>' . htmlspecialchars($user['user_phone']) . '</p>';
        echo '<p>' . htmlspecialchars($user['user_birthdate']) . '</p>';
        echo '<p>' . htmlspecialchars($user['user_license_number']) . '</p>';
        
        echo '<img src="/assets/icons/edit.png" alt="Edit" class="w-7">';
        echo '</form>';
    }
    
} else {
    echo '<p class="col-span-12 text-center py-4 text-gray-500">No results found.</p>';
}

pg_close($conn);
