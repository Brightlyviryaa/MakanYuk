<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');

if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];

    // Query untuk menghapus menu berdasarkan ID
    $sql = "DELETE FROM Menus WHERE menu_id = :menu_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':menu_id', $menu_id);

    if ($stmt->execute()) {
        header('Location: lihat_menu.php');
        exit();
    }
}