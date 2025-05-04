<?php
session_start();
include '../db_connect.php';

// Cek apakah admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Ambil total data
$produk = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc();
$pesanan = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
            <nav class="mt-6">
                <a href="dashboard.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="kelola_produk.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-box mr-3"></i> Kelola Produk
                </a>
                <a href="kelola_pesanan.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-shopping-cart mr-3"></i> Kelola Pesanan
                </a>
                <a href="kelola_ulasan.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
                    <i class="fas fa-comments mr-3"></i> Ulasan
                </a>
                <a href="../logout.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-red-700 text-red-200">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h2 class="text-3xl font-bold mb-8">Ringkasan Data</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Total Produk -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center transform transition duration-500 hover:scale-105">
                    <div class="p-4 bg-[#B12930] rounded-full">
                        <i class="fas fa-box text-white text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold">Total Produk</h2>
                        <p class="text-gray-600 text-4xl"><?= $produk['total'] ?></p>
                    </div>
                </div>

                <!-- Total Pesanan -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center transform transition duration-500 hover:scale-105">
                    <div class="p-4 bg-[#e2542e] rounded-full">
                        <i class="fas fa-shopping-cart text-white text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold">Total Pesanan</h2>
                        <p class="text-gray-600 text-4xl"><?= $pesanan['total'] ?></p>
                    </div>
                </div>
            </div>

            <!-- Recent Customer Reviews -->
            <div class="mt-10 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Recent Customer Reviews</h2>
                <?php
                $reviews = $conn->query("
                    SELECT r.rating, r.review, r.created_at, u.name, p.name AS product_name
                    FROM reviews r
                    JOIN users u ON r.user_id = u.id
                    JOIN products p ON r.product_id = p.id
                    ORDER BY r.created_at DESC
                    LIMIT 5
                ");
                if ($reviews->num_rows > 0):
                ?>
                <table class="min-w-full divide-y divide-gray-300 border border-gray-300 rounded-lg">
                    <thead class="bg-orange-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider rounded-tl-lg">Customer</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Review</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider rounded-tr-lg">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($row = $reviews->fetch_assoc()): ?>
                        <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-500">
                                <?php echo str_repeat('⭐', (int)$row['rating']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['review']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p class="text-gray-700">No reviews found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
