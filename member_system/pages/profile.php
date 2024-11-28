<?php
session_start();
include('../includes/db.php');

// Cek apakah user sudah login, jika tidak maka redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit(); // Pastikan tidak ada kode lain yang dijalankan setelah redirect
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<h1>Profile</h1>
<p>Name: <?= $user['name'] ?></p>
<p>Address: <?= $user['address'] ?></p>
<p>Date of Birth: <?= $user['dob'] ?></p>
<p>Phone: <?= $user['phone'] ?></p>
<p>Email: <?= $user['email'] ?></p>
<p>Grade: <?= $user['grade'] ?></p>

<a href="edit_account.php">Edit Account</a> | <a href="change_grade.php">Change Grade</a>

<a href="delete_account.php" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</a>

<!-- Form Logout -->
<form method="POST" action="">
    <button type="submit" name="logout">Logout</button>
</form>

<?php
// Proses logout ketika tombol logout ditekan
if (isset($_POST['logout'])) {
    // Menghapus session dan data session pengguna
    session_unset(); // Menghapus semua session variables
    session_destroy(); // Menghancurkan session
    
    // Redirect ke halaman login setelah logout
    header('Location: login.php');
    exit();
}
?>
