<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');
include('navbar.php');

// Query untuk mengambil daftar pesanan
$sql = "SELECT O.order_id, U.first_name, U.last_name, M.menu_name, O.status
        FROM Orders O
        INNER JOIN Users U ON O.user_id = U.user_id
        INNER JOIN Menus M ON O.menu_id = M.menu_id
        ORDER BY O.order_id DESC";
$stmt = $pdo->query($sql);
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
    <div class="container mt-5">
        <h1>Admin Pesanan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No. Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Menu</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Kolom untuk tombol Edit dan Hapus -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>
                            <td>' . $row['order_id'] . '</td>
                            <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                            <td>' . $row['menu_name'] . '</td>
                            <td>' . $row['status'] . '</td>
                            <td>
                                <a href="admin_lihat_pesanan.php?order_id=' . $row['order_id'] . '" class="btn btn-primary">Lihat Pesanan</a>
                            </td>
                        </tr>';

                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>