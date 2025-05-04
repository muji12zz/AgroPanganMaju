<?php
include '../db_connect.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$query = "SELECT orders.*, users.name AS nama_user 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          ORDER BY order_date DESC";
$pesanan = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Pesanan</title>
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
            <a href="dashboard.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="kelola_produk.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                <i class="fas fa-box mr-3"></i> Kelola Produk
            </a>
            <a href="kelola_pesanan.php" class="block py-3 px-4 bg-[#B12930] rounded transition duration-200">
                <i class="fas fa-shopping-cart mr-3"></i> Kelola Pesanan
            </a>
            <a href="ulasan.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                <i class="fas fa-comments mr-3"></i> Ulasan
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-6">Kelola Pesanan</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">No</th>
                        <th class="py-2 px-4 border-b border-gray-200">Nama Pemesan</th>
                        <th class="py-2 px-4 border-b border-gray-200">Tanggal Order</th>
                        <th class="py-2 px-4 border-b border-gray-200">Alamat</th>
                        <th class="py-2 px-4 border-b border-gray-200">Metode Pembayaran</th>
                        <th class="py-2 px-4 border-b border-gray-200">Status</th>
                        <th class="py-2 px-4 border-b border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($pesanan)) : ?>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200"><?= $no++; ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['nama_user']); ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['order_date']); ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['address']); ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['payment_method']); ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['status']); ?></td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="detail_pesanan.php?id=<?= $row['id']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded shadow hover:bg-blue-700 transition duration-200">Detail</a>
                                <a href="update_status.php?id=<?= $row['id']; ?>" class="bg-green-500 text-white px-3 py-1 rounded shadow hover:bg-green-700 transition duration-200">Update Status</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
