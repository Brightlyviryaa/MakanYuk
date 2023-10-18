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
    <?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
        header('Location: login.php');
        exit();
    }

    require('database.php');
    include('navbar.php');

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // Query untuk mengambil informasi pesanan dan pelanggan
        $sql = "SELECT O.order_id, U.first_name, U.last_name, M.menu_name, O.status
                FROM Orders O
                INNER JOIN Users U ON O.user_id = U.user_id
                INNER JOIN Menus M ON O.menu_id = M.menu_id
                WHERE O.order_id = :order_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $orderInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($orderInfo) {
            // Formulir untuk mengedit pesanan
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ambil data yang diubah dari formulir
                $newStatus = $_POST['status'];

                // Query untuk mengupdate status pesanan
                $updateSql = "UPDATE Orders SET status = :status WHERE order_id = :order_id";
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->bindParam(':status', $newStatus);
                $updateStmt->bindParam(':order_id', $order_id);

                if ($updateStmt->execute()) {
                    echo '<div class="alert alert-success">Status pesanan berhasil diperbarui.</div>';
                } else {
                    echo '<div class="alert alert-danger">Gagal memperbarui status pesanan.</div>';
                }
            }
            ?>

            <div class="container mt-5">
                <h1>Detail Pesanan</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Menu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $orderInfo['order_id']; ?>
                            </td>
                            <td>
                                <?php echo $orderInfo['first_name'] . ' ' . $orderInfo['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $orderInfo['menu_name']; ?>
                            </td>
                            <td>
                                <?php echo $orderInfo['status']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h2>Edit Pesanan</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="status">Status Pesanan:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Pending" <?php if ($orderInfo['status'] == 'Pending')
                                echo 'selected'; ?>>Pending
                            </option>
                            <option value="Cooking" <?php if ($orderInfo['status'] == 'Cooking')
                                echo 'selected'; ?>>Cooking
                            </option>
                            <option value="Delivery" <?php if ($orderInfo['status'] == 'Delivery')
                                echo 'selected'; ?>>Delivery
                            </option>
                            <option value="Success" <?php if ($orderInfo['status'] == 'Success')
                                echo 'selected'; ?>>Success
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>

            <?php
        } else {
            // Alihkan jika pesanan tidak ditemukan
            header('Location: admin_lihat_pesanan.php');
            exit();
        }
    } else {
        // Alihkan jika tidak ada pesanan yang ditemukan atau order_id tidak diset
        header('Location: admin_lihat_pesanan.php');
        exit();
    }

    include('footer.php');
    ?>
</body>

</html>