<?php
$koneksi = mysqli_connect("localhost","root","","restoranDB");

$first_name = "";
$last_name = "";
$email = "";
$password = "";
$birthdate = "";
$gender = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO users(first_name, last_name, email, password, birthdate, gender) VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$birthdate', '$gender')";
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
    <div class="container">
        <div class="container" style="max-width: 800px;">
            <h2 class="text-center">Daftar Sekarang!</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">First and last name</span>
                    <input type="text" aria-label="First name" class="form-control" value="<?php echo $first_name; ?>" required>
                    <input type="text" aria-label="Last name" class="form-control" value="<?php echo $last_name; ?>" required>
                </div>
                <br/>
                <div class="form-floating"> 
                    <input type="password" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $email; ?>" required><br>
                    <label for="password">Email</label>
                </div>
                <div class="form-floating"> 
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo $password; ?>" required><br>
                    <label for="password">Password</label>
                </div>
                <input type="submit" class="btn btn-outline-primary" value="Login">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>
</html>