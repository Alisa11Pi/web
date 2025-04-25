<?php
$config = require __DIR__ . '/project/config/connection.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
        $config['user'],
        $config['password']
    );
    echo "Успешное подключение к базе данных!";
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}