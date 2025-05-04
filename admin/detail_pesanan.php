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

$order_id = $_GET['id'];

$order = mysqli_query($conn, "SELECT orders.*, users.name AS nama_user FROM orders JOIN users ON orders.user_id = users.id WHERE orders.id = '$order_id'");
$order_data = mysqli_fetch_assoc($order);

$items = mysqli_query($conn, "
    SELECT order_items.*, products.name 
    FROM order_items 
    JOIN products ON order_items.product_id = products.id 
    WHERE order_items.order_id = '$order_id'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
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
                <a href="kelola_pesanan.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
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
                <h2 class="text-3xl font-bold mb-6">Detail Pesanan</h2>

                <div class="mb-4"><p><strong>Nama:</strong> <?= htmlspecialchars($order_data['nama_user']); ?></p></div>
                <div class="mb-4"><p><strong>Tanggal:</strong> <?= htmlspecialchars($order_data['order_date']); ?></p></div>
                <div class="mb-4"><p><strong>Alamat:</strong> <?= htmlspecialchars($order_data['address']); ?></p></div>
                <div class="mb-4"><p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($order_data['payment_method']); ?></p></div>
                <div class="mb-4"><p><strong>Status:</strong> <?= htmlspecialchars($order_data['status']); ?></p></div>
                <div class="mb-4"><p><strong>Deskripsi Tracking:</strong> <?= $order_data['tracking_info'] ? htmlspecialchars($order_data['tracking_info']) : 'Belum ada informasi.'; ?></p></div>

                <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
                    <h3 class="text-2xl font-bold mb-4">Produk Dipesan:</h3>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 text-left">No</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-left">Nama Produk</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-left">Jumlah</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-left">Harga per item</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1; 
                            while ($row = mysqli_fetch_assoc($items)) { 
                            ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200"><?= $no++; ?></td>
                                <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['name']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-200"><?= $row['quantity']; ?></td>
                                <td class="py-2 px-4 border-b border-gray-200">Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="kelola_pesanan.php" class="text-blue-600 hover:underline"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
