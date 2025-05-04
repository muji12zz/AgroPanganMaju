<?php
session_start();
include '../db_connect.php';

// Check if admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Handle approval toggle
if (isset($_GET['action'], $_GET['id'])) {
    $action = $_GET['action'];
    $review_id = intval($_GET['id']);
    if ($action === 'approve') {
        $conn->query("UPDATE reviews SET is_approved = 1 WHERE id = $review_id");
    } elseif ($action === 'disapprove') {
        $conn->query("UPDATE reviews SET is_approved = 0 WHERE id = $review_id");
    }
    header("Location: kelola_ulasan.php");
    exit();
}

// Fetch all reviews with user and product info
$reviews = $conn->query("
    SELECT r.id, r.rating, r.review, r.is_approved, r.created_at, u.name AS user_name, p.name AS product_name
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    JOIN products p ON r.product_id = p.id
    ORDER BY r.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <a class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]" href="kelola_produk.php">
                    <i class="fas fa-box mr-3"></i> Kelola Produk
                </a>
                <a class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]" href="kelola_pesanan.php">
                    <i class="fas fa-shopping-cart mr-3"></i> Kelola Pesanan
                </a>
                <a class="block py-3 px-4 rounded transition duration-200 bg-[#B12930]" href="kelola_ulasan.php">
                    <i class="fas fa-comments mr-3"></i> Ulasan
                </a>
            </nav>
        </div>
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6">Manage Customer Reviews</h1>
            <table class="min-w-full bg-white rounded shadow overflow-hidden">
                <thead class="bg-orange-600 text-white">
                    <tr>
                        <th class="px-4 py-2">User</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Rating</th>
                        <th class="px-4 py-2">Review</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $reviews->fetch_assoc()): ?>
                    <tr class="border-b">
                        <td class="px-4 py-2"><?= htmlspecialchars($row['user_name']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['product_name']) ?></td>
                        <td class="px-4 py-2 text-yellow-500"><?= str_repeat('★', (int)$row['rating']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['review']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['created_at']) ?></td>
                        <td class="px-4 py-2">
                            <?php if ($row['is_approved']): ?>
                                <span class="text-green-600 font-semibold">Approved</span>
                            <?php else: ?>
                                <span class="text-red-600 font-semibold">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2">
                            <?php if (!$row['is_approved']): ?>
                                <a href="?action=approve&id=<?= $row['id'] ?>" class="text-green-600 hover:underline">Approve</a>
                            <?php else: ?>
                                <a href="?action=disapprove&id=<?= $row['id'] ?>" class="text-red-600 hover:underline">Disapprove</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
