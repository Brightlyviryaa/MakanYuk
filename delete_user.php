<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Query untuk menghapus pengguna berdasarkan ID
    $sql = "DELETE FROM Users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header('Location: lihat_user.php');
        exit();
    }
}