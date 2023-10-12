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
                    <a class="nav-link" href="index.php"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #FF6928;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daftar_menu.php"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #FF6928;">Menu</a>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    // Cek peran pengguna
                    if ($_SESSION['role'] == 'Admin') {
                        // Jika pengguna adalah admin, tampilkan menu admin
                        echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminMenuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin Menu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminMenuDropdown">
                                    <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="tambah_menu.php">Tambah Menu</a></li>
                                    <li><a class="dropdown-item" href="lihat_menu.php">Lihat Menu</a></li>
                                    <li><a class="dropdown-item" href="lihat_user.php">Lihat User</a></li>
                                    <li><a class="dropdown-item" href="admin_pesanan.php">Lihat Orderan</a></li>
                                </ul>
                              </li>';
                    } elseif ($_SESSION['role'] == 'Customer') {
                        // Jika pengguna adalah customer, tampilkan menu customer
                        echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="customerMenuDropdown" role= "button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Customer Menu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="customerMenuDropdown">
                                    <li><a class="dropdown-item" href="pesan.php">Pesan</a></li>
                                    <li><a class="dropdown-item" href="pesanan_saya.php">Pesanan Saya</a></li>
                                </ul>
                              </li>';
                    }

                    // Tampilkan tombol Log Out
                    echo '<li class="nav-item">
                            <a class="nav-link btn btn-pill" href="/Makanyuk/logout.php" style="background-color: #FF6928; color: white;">Log Out</a>
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