<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = 'buchaches';
$db_user = 'buchaches';
$db_pass = 'Dom486573';
$charset = 'utf8mb4';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options);
} catch (PDOException $e) { 
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}