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
</head>
<body>
    <h2>Silakan Masuk</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>