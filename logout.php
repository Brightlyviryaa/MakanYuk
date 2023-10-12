<?php
require("session_starter.php");

// Hapus semua data sesi
session_unset();
session_destroy();

// Redirect ke halaman login atau halaman lain sesuai kebutuhan
header("Location: login.php"); // Ganti dengan halaman yang sesuai
exit();
?>