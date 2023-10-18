<?php
$host = "localhost"; // Ganti dengan nama host database Anda
$dbname = "burgerba_makanyuk"; // Ganti dengan nama database Anda
$username = "burgerba_makanyuk"; // Ganti dengan username database Anda
$password = "TBu1Z*fdeJFN"; // Ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>