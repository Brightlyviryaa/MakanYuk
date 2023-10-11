<?php
$koneksi = mysqli_connect("localhost","root","","makanyuk");

$username = "";
$password = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO login(username,password) VALUES ('$username','$hashed_password')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Gagal menyimpan data ke database";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body>
    <div class="container" style="max-width: 800px;">
        <h2>Daftar Sekarang!</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-floating mb-1">
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo $username; ?>" required><br>
                <label for="username">Username</label>
            </div>
            <div class="form-floating"> 
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo $password; ?>" required><br>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn btn-outline-primary" value="Login">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>
</html>