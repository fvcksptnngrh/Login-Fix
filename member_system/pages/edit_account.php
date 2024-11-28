<?php
session_start();
include('../includes/db.php');

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit(); // Pastikan tidak ada kode yang dijalankan setelah redirect
}

$user_id = $_SESSION['user_id'];

// Proses jika ada pengeditan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Query untuk update data
    $sql = "UPDATE users SET name='$name', address='$address', dob='$dob', phone='$phone', email='$email', password='$password' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Account updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data user untuk menampilkan informasi yang ada
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!-- Form untuk mengedit profil -->
<form method="POST" action="">
    <input type="text" name="name" value="<?= $user['name'] ?>" required>
    <input type="text" name="address" value="<?= $user['address'] ?>" required>
    <input type="date" name="dob" value="<?= $user['dob'] ?>" required>
    <input type="text" name="phone" value="<?= $user['phone'] ?>" required>
    <input type="email" name="email" value="<?= $user['email'] ?>" required>
    <input type="password" name="password" placeholder="New Password">
    <button type="submit">Save Changes</button>
</form>

<!-- Tombol untuk kembali ke halaman profil -->
<br>
<a href="profile.php"><button type="button">Back to Profile</button></a>
