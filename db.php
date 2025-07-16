<?php
$host = 'localhost';
$dbname = 'dbvenpj7mxpyrz';
$username = 'ulnrcogla9a1t';
$password = 'yolpwow1mwr2';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In production, log this error instead of displaying it
    die("Database connection failed: " . $e->getMessage());
}
?>
