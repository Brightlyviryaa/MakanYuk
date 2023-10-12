<?php
require("session_starter.php");
require('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifikasi reCaptcha
    $recaptchaSecretKey = '6LeniJcoAAAAADfHewreV_K9dvTRSaFj8w1Gv3D2'; // Secret key reCaptcha
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaData = [
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse,
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($recaptchaData),
        ],
    ];

    $context = stream_context_create($options);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $context);
    $recaptchaResult = json_decode($recaptchaResult, true);

    if (!$recaptchaResult['success']) {
        $error_message = "Verifikasi Captcha gagal. Silakan coba lagi.";
        header("Location: login.php?error=$error_message");
        exit();
    }

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