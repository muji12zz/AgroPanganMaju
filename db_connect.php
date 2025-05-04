<?php
$host = "localhost";
$user = "root"; // default user XAMPP
$pass = "";     // biasanya kosong di XAMPP
$db   = "agro_pangan_maju";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
