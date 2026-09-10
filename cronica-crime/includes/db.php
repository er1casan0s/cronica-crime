<?php
// includes/db.php
// Conexão PDO - use se quiser salvar recordes no banco
$host = 'localhost';
$db   = 'cronicas_crime';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // Se não quiser usar banco, comente a linha abaixo
    // die("Erro: " . $e->getMessage());
    $pdo = null;
}
?>