<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"
            style="font-family: 'Poppins', sans-serif; font-weight: 900; font-size: 24px; color: #FF6928;">
            MakanYuk
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #FF6928;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #FF6928;">Menu</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    // Jika pengguna sudah login, tampilkan tombol Log Out
                    echo '<li class="nav-item">
                            <a class="nav-link btn btn-pill" href="logout.php" style="background-color: #FF6928; color: white;">Log Out</a>
                          </li>';
                } else {
                    // Jika pengguna belum login, tampilkan tombol Login
                    echo '<li class="nav-item">
                            <a class="nav-link btn btn-pill" href="login.php" style="background-color: #FF6928; color: white;">Login</a>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>