<?php
session_start();
include('../includes/db.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Periksa jika tombol konfirmasi penghapusan ditekan
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Hapus akun dari database
    $sql = "DELETE FROM users WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        // Hapus sesi pengguna dan arahkan kembali ke halaman login setelah penghapusan
        session_destroy();
        header('Location: login.php');
        exit();
    } else {
        echo "Error deleting account: " . $conn->error;
    }
}
?>
