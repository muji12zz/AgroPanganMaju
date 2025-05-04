<?php
include 'db_connect.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $username, $email, $phone, $password);

    if ($stmt->execute()) {
        $success = "✅ Berhasil daftar! <a href='login.php' class='text-red-600 underline'>Login di sini</a>";
    } else {
        $error = "❌ Gagal daftar: " . $stmt->error;
    }
}

// Tampilkan view
include 'register_view.php';
