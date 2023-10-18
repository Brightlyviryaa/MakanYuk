<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');

// Inisialisasi variabel
$menuName = $description = $price = $category = $image = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuName = $_POST['menu_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Penanganan gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $imagePath = './Images/' . $image;

        // Nama gambar produk yang baru (tanpa spasi)
        $imageNameWithoutSpaces = str_replace(' ', '_', $menuName);

        // Gabungkan nama gambar baru dengan ekstensi gambar
        $imagePath = './Images/' . $imageNameWithoutSpaces . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);

        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $errorMessage = 'Pilih gambar valid.';
    }

    // Simpan data menu ke database
    if (empty($errorMessage)) {
        $sql = "INSERT INTO Menus (menu_name, description, price, category, image_url) VALUES (:menu_name, :description, :price, :category, :image_url)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':menu_name', $menuName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image_url', $imagePath);

        if ($stmt->execute()) {
            header('Location: dashboard.php');
            exit();
        } else {
            $errorMessage = 'Gagal menambahkan menu. Silakan coba lagi.';
        }
    }
}

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
        <h1>Tambah Menu</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="menu_name" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="menu_name" name="menu_name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="text-danger">
                <?php echo $errorMessage; ?>
            </div>
            <button type="submit" class="btn btn-custom">Tambahkan Menu</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>