<?php
require('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing password
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    try {
        $stmt = $pdo->prepare("INSERT INTO Users (first_name, last_name, email, password, birthdate, gender, role) VALUES (?, ?, ?, ?, ?, ?, 'Customer')");
        $stmt->execute([$first_name, $last_name, $email, $password, $birthdate, $gender]);

        // Redirect to login page or homepage
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>