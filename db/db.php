<?php

try {
    $dsn = 'mysql:host=localhost;dbname=dev_movies_ticket_';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
