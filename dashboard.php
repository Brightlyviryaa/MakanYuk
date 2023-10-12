<?php
// Hapus perintah session_start() di sini jika sudah ada di navbar.php
require('database.php');

// Cek apakah pengguna sudah login dan perannya adalah admin

// Query untuk menghitung total order, total user, dan total menu
$totalOrders = 0;
$totalUsers = 0;
$totalMenus = 0;

try {
    // Menghitung total order
    $stmt = $pdo->query("SELECT COUNT(*) FROM Orders");
    $totalOrders = $stmt->fetchColumn();

    // Menghitung total user
    $stmt = $pdo->query("SELECT COUNT(*) FROM Users");
    $totalUsers = $stmt->fetchColumn();

    // Menghitung total menu
    $stmt = $pdo->query("SELECT COUNT(*) FROM Menus");
    $totalMenus = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MakanYuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Order</h5>
                        <p class="card-text">
                            <?php echo $totalOrders; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total User</h5>
                        <p class="card-text">
                            <?php echo $totalUsers; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Menu</h5>
                        <p class="card-text">
                            <?php echo $totalMenus; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>