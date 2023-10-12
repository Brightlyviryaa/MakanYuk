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
        <h1>Daftar Pengguna</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil daftar pengguna
                $sql = "SELECT * FROM Users";
                $stmt = $pdo->query($sql);

                // Tampilkan daftar pengguna
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>
                            <td>' . $row['user_id'] . '</td>
                            <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['birthdate'] . '</td>
                            <td>' . $row['gender'] . '</td>
                            <td>' . $row['role'] . '</td>
                            <td>
                                <a href="edit_user.php?id=' . $row['user_id'] . '" class="btn btn-primary">Edit</a>
                                <a href="delete_user.php?id=' . $row['user_id'] . '" class="btn btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus pengguna ini?\')">Delete</a>
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