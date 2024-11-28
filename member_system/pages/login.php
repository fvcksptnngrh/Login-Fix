<?php
session_start();
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_grade'] = $user['grade'];
            header('Location: profile.php');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<!-- Tombol Register yang mengarah ke halaman register.php -->
<p>Don't have an account? <a href="register.php">Register here</a></p>
