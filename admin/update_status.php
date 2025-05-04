<?php
include '../db_connect.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID pesanan tidak ditemukan.";
    exit();
}

$id = intval($_GET['id']); // biar lebih aman

// Ambil data pesanan
$pesanan = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$id'");
$data = mysqli_fetch_assoc($pesanan);

// Proses update
if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $tracking_info = $_POST['tracking_info'];

    $update = mysqli_query($conn, "UPDATE orders SET status='$status', tracking_info='$tracking_info' WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Status dan tracking berhasil diupdate!'); window.location='kelola_pesanan.php';</script>";
        exit();
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Status Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-r from-[#B12930] to-[#e2542e] text-white shadow-lg">
            <div class="p-6">
                <h1 class="text-3xl font-bold">Admin Dashboard</h1>
            </div>
            <nav class="mt-10">
                <a href="#" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="#" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-box mr-3"></i> Kelola Produk
                </a>
                <a href="kelola_pesanan.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-shopping-cart mr-3"></i> Kelola Pesanan
                </a>
                <a href="#" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-comments mr-3"></i> Ulasan
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-6">Update Status Pesanan</h2>
                <form method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                            Status:
                        </label>
                        <select name="status" id="status" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Diproses" <?= $data['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="Dikirim" <?= $data['status'] == 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                            <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            <option value="Dibatalkan" <?= $data['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="deskripsi-tracking">
                            Deskripsi Tracking / Info Pengiriman:
                        </label>
                        <textarea name="tracking_info" id="deskripsi-tracking" rows="4"
                                  placeholder="Contoh: Sudah sampai di DC Cakung"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= htmlspecialchars($data['tracking_info']); ?></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="update"
                                class="bg-[#B12930] hover:bg-[#e2542e] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="kelola_pesanan.php"
                           class="text-sm text-[#B12930] hover:underline font-medium">← Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
