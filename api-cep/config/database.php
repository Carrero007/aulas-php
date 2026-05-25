<?php
$host = 'localhost';
$db   = 'db_cep';
$user = 'root';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db",
        $user
    );
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (PDOException $e) {
    echo json_encode(['erro' =>
        $e->getMessage()]);
}
