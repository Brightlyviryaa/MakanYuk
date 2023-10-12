<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'];
    $menu_name = $_POST['menu_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Periksa apakah gambar baru diunggah
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Hapus gambar lama
        $sql = "SELECT image_url FROM Menus WHERE menu_id = :menu_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':menu_id', $menu_id);
        $stmt->execute();
        $old_image_url = $stmt->fetchColumn();

        if ($old_image_url) {
            unlink($old_image_url);
        }

        // Simpan gambar baru dengan nama yang sesuai
        $image_name = str_replace(' ', '_', $menu_name); // Mengganti spasi dengan garis bawah
        $image_name = strtolower($image_name); // Konversi ke huruf kecil
        $image_name .= '.jpg'; // Menambahkan ekstensi gambar (misalnya, jpg)

        $image_path = 'images/' . $image_name; // Perhatikan penggunaan path
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

        $image_url = $image_path;
    } else {
        // Jika tidak ada gambar baru diunggah, pertahankan gambar lama
        $sql = "SELECT image_url FROM Menus WHERE menu_id = :menu_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':menu_id', $menu_id);
        $stmt->execute();
        $image_url = $stmt->fetchColumn();
    }

    // Perbarui data menu
    $sql = "UPDATE Menus SET menu_name = :menu_name, description = :description, price = :price, category = :category, image_url = :image_url WHERE menu_id = :menu_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':menu_id', $menu_id);
    $stmt->bindParam(':menu_name', $menu_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':image_url', $image_url);

    if ($stmt->execute()) {
        header('Location: lihat_menu.php');
        exit();
    }
}

if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];

    // Query untuk mengambil data menu berdasarkan ID
    $sql = "SELECT * FROM Menus WHERE menu_id = :menu_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':menu_id', $menu_id);
    $stmt->execute();
    $menu = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <h1>Edit Menu</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="menu_id" value="<?php echo $menu['menu_id']; ?>">
            <div class="mb-3">
                <label for="menu_name" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="menu_name" name="menu_name"
                    value="<?php echo $menu['menu_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description"
                    rows="3"><?php echo $menu['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $menu['price']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="category" name="category"
                    value="<?php echo $menu['category']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <img src="<?php echo $menu['image_url']; ?>" alt="Gambar Menu" style="max-width: 100px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>