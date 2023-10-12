<?php
require('database.php');
require('session_starter.php');
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
    <style>
        .card {
            width: 100%;
        }

        .card img {
            max-height: 200px;
            /* Ubah sesuai dengan ukuran yang Anda inginkan */
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Menu</h1>
        <div class="row">
            <?php
            // Query untuk mengambil daftar menu
            $sql = "SELECT * FROM Menus";
            $stmt = $pdo->query($sql);

            // Tampilkan menu
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="' . $row['image_url'] . '" class="card-img-top" alt="' . $row['menu_name'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['menu_name'] . '</h5>
                                <p class="card-text">' . $row['description'] . '</p>
                                <p class="card-text">Harga: ' . number_format($row['price'], 2) . '</p>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>