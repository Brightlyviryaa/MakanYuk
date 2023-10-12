<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Customer') {
    header('Location: login.php');
    exit();
}

require('database.php');
include('navbar.php');

$notification = ""; // Inisialisasi notifikasi kosong

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['menu_id']) && is_array($_POST['menu_id'])) {
        $user_id = $_SESSION['user_id'];
        $menu_ids = $_POST['menu_id'];

        // Query untuk membuat pesanan baru dengan status "New"
        $sql = "INSERT INTO Orders (user_id, menu_id, status) VALUES (:user_id, :menu_id, 'New')";
        $stmt = $pdo->prepare($sql);

        $success = true;

        foreach ($menu_ids as $menu_id) {
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':menu_id', $menu_id);

            if (!$stmt->execute()) {
                $success = false;
                break; // Terminate the loop if one order fails
            }
        }

        if ($success) {
            $notification = '<div class="alert alert-success">Pesanan berhasil dibuat.</div>';
        } else {
            $notification = '<div class="alert alert-danger">Gagal membuat pesanan. Mohon coba lagi.</div>';
        }
    }
}

// Query untuk mengambil daftar menu
$sql = "SELECT * FROM Menus";
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
        <h1>Pesan Menu</h1>
        <?php echo $notification; // Menampilkan notifikasi ?>
        <form method="post">
            <div class="mb-3">
                <label for="menu_id" class="form-label">Pilih Menu</label>
                <select class="form-select" id="menu_id" name="menu_id[]" required multiple>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['menu_id'] . '">' . $row['menu_name'] . ' - Harga: ' . $row['price'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>