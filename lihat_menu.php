<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');
include('navbar.php');
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
        <h1>Daftar Menu</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Menu</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil daftar menu
                $sql = "SELECT * FROM Menus";
                $stmt = $pdo->query($sql);

                // Tampilkan daftar menu
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>
                            <td>' . $row['menu_id'] . '</td>
                            <td>' . $row['menu_name'] . '</td>
                            <td>' . $row['description'] . '</td>
                            <td>' . number_format($row['price'], 2) . '</td>
                            <td>' . $row['category'] . '</td>
                            <td><img src="' . $row['image_url'] . '" alt="' . $row['menu_name'] . '" style="max-width: 100px;"></td>
                            <td>
                                <a href="edit_menu.php?id=' . $row['menu_id'] . '" class="btn btn-primary">Edit</a>
                                <a href="delete_menu.php?id=' . $row['menu_id'] . '" class="btn btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus menu ini?\')">Delete</a>
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