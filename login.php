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
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="process_login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <!-- Tampilkan widget reCaptcha di sini -->
                                <div class="g-recaptcha" data-sitekey="6LeniJcoAAAAANeFdrcKgU6h3zM4PshKZRQMmQtw"></div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="loginButton" disabled> Login </button>

                            <!-- Sertakan script JavaScript reCaptcha di bawah ini -->
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>