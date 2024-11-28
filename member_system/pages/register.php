<?php
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Ambil password dari input form

    // Enkripsi password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, address, dob, phone, email, password) VALUES ('$name', '$address', '$dob', '$phone', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="date" name="dob" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>

<!-- Tombol Login yang mengarah ke halaman login.php -->
<p>Already have an account? <a href="login.php">Login here</a></p>
