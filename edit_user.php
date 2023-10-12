<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Periksa jika ada perubahan password
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE Users SET first_name = :first_name, last_name = :last_name, email = :email, birthdate = :birthdate, gender = :gender, role = :role, password = :password WHERE user_id = :user_id";
    } else {
        $sql = "UPDATE Users SET first_name = :first_name, last_name = :last_name, email = :email, birthdate = :birthdate, gender = :gender, role = :role WHERE user_id = :user_id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':birthdate', $birthdate);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':role', $role);

    if (!empty($password)) {
        $stmt->bindParam(':password', $password);
    }

    if ($stmt->execute()) {
        header('Location: lihat_user.php');
        exit();
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $sql = "SELECT * FROM Users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <h1>Edit Pengguna</h1>
        <form method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">Nama Depan</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="<?php echo $user['first_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Nama Belakang</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="<?php echo $user['last_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"
                    value="<?php echo $user['birthdate']; ?>">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="gender" name="gender">
                    <option value="Male" <?php echo ($user['gender'] === 'Male') ? 'selected' : ''; ?>>Laki-Laki</option>
                    <option value="Female" <?php echo ($user['gender'] === 'Female') ? 'selected' : ''; ?>>Perempuan
                    </option>
                    <option value="Other" <?php echo ($user['gender'] === 'Other') ? 'selected' : ''; ?>>Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Peran</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="Admin" <?php echo ($user['role'] === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="Customer" <?php echo ($user['role'] === 'Customer') ? 'selected' : ''; ?>>Customer
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (Biarkan kosong jika tidak ingin mengubah
                    password)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>