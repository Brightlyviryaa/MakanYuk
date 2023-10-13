<?php
require("session_starter.php");
require('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT user_id, email, password, role FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'Admin') {
                // Jika pengguna adalah admin, arahkan ke dashboard.php yang ada di direktori utama
                header("Location: dashboard.php");
                exit();
            } else {
                // Jika pengguna adalah customer, arahkan ke halaman beranda
                header("Location: index.php");
                exit();
            }
        } else {
            $error_message = "Email atau kata sandi salah.";
            header("Location: login.php?error=$error_message");
            exit();
        }


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>