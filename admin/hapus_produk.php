<?php
include '../db_connect.php';
session_start();

// Cek login dan role admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Cek apakah ada ID dikirim
if (!isset($_GET['id'])) {
    echo "ID produk tidak ditemukan.";
    exit();
}

$id = $_GET['id'];

// Proses hapus
$hapus = mysqli_query($conn, "DELETE FROM products WHERE id = '$id'");

if ($hapus) {
    echo "<script>alert('Produk berhasil dihapus.'); window.location='kelola_produk.php';</script>";
} else {
    echo "Gagal hapus: " . mysqli_error($conn);
}
?>
