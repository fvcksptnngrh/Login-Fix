<?php
session_start();
include('../includes/db.php');

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit(); // Pastikan tidak ada kode yang dijalankan setelah redirect
}

$user_id = $_SESSION['user_id'];

// Proses jika ada pengubahan grade
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grade = $_POST['grade'];

    // Update grade di database
    $sql = "UPDATE users SET grade='$grade' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Grade updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data user untuk menampilkan grade saat ini
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!-- Form untuk mengganti grade -->
<form method="POST" action="">
    <label for="grade">Grade:</label>
    <select name="grade">
        <option value="A" <?= ($user['grade'] == 'A') ? 'selected' : '' ?>>Grade A</option>
        <option value="B" <?= ($user['grade'] == 'B') ? 'selected' : '' ?>>Grade B</option>
        <option value="C" <?= ($user['grade'] == 'C') ? 'selected' : '' ?>>Grade C</option>
    </select>
    <button type="submit">Change Grade</button>
</form>

<!-- Tombol untuk kembali ke halaman profile -->
<br>
<a href="profile.php"><button type="button">Back to Profile</button></a>
