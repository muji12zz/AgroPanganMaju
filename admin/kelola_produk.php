<?php
session_start();
include '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$produk = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Produk</title>
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
                <a class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]" href="dashboard.php">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a class="block py-3 px-4 rounded transition duration-200 bg-[#B12930]" href="kelola_produk.php">
                    <i class="fas fa-box mr-3"></i> Kelola Produk
                </a>
                <a class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]" href="kelola_pesanan.php">
                    <i class="fas fa-shopping-cart mr-3"></i> Kelola Pesanan
                </a>
                <a class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]" href="ulasan.php">
                    <i class="fas fa-comments mr-3"></i> Ulasan
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold">Kelola Produk</h2>
                    <div>
                        <a href="tambah_produk.php" class="bg-[#B12930] text-white px-4 py-2 rounded-lg shadow hover:bg-[#e2542e] transition duration-200 mr-4">
                            <i class="fas fa-plus mr-2"></i> Tambah Produk
                        </a>
                        <a href="tambah_kategori.php" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i> Tambah Kategori
                        </a>
                    </div>
                </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200">Gambar</th>
                    <th class="py-2 px-4 border-b border-gray-200">Nama</th>
                    <th class="py-2 px-4 border-b border-gray-200">Deskripsi</th>
                    <th class="py-2 px-4 border-b border-gray-200">Kategori</th>
                    <th class="py-2 px-4 border-b border-gray-200">Harga</th>
                    <th class="py-2 px-4 border-b border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $produk->fetch_assoc()) : ?>
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <?php if (!empty($row['image'])): ?>
                            <img src="../<?= htmlspecialchars($row['image']); ?>" class="w-16 h-16 object-cover rounded" alt="<?= htmlspecialchars($row['name']); ?>">
                        <?php else: ?>
                            <em class="text-gray-400">Tidak ada gambar</em>
                        <?php endif; ?>
                    </td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['name']); ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['description']); ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['category']) ?></td>
                    <td class="py-2 px-4 border-b border-gray-200">Rp<?= number_format($row['price'], 0, ',', '.'); ?></td>
                    <td class="py-2 px-4 border-b border-gray-200">
                            <div class="flex space-x-2 justify-center">
                                <a href="edit_produk.php?id=<?= $row['id']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded shadow hover:bg-blue-700 transition duration-200">
                                    Edit
                                </a>
                                <a href="hapus_produk.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin hapus?')" class="bg-red-500 text-white px-3 py-1 rounded shadow hover:bg-red-700 transition duration-200">
                                    Hapus
                                </a>
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
