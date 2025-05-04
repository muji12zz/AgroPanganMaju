<?php
session_start();
include '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = trim($_POST['category_name']);
    if (empty($category_name)) {
        $error = 'Category name cannot be empty.';
    } else {
        // Insert new category
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $category_name);
        if ($stmt->execute()) {
            $success = 'Category added successfully.';
        } else {
            $error = 'Failed to add category. It might already exist.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
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
        <div class="flex-1 p-6">
        <main class="flex-1 p-8">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-extrabold mb-6">
                    Tambah Kategori Baru
                </h2>
                <form class="space-y-6" method="POST" onsubmit="event.preventDefault(); alert('Kategori berhasil ditambahkan!'); this.submit();">
                    <div>
                        <label class="block text-sm font-semibold mb-2" for="category_name">
                            Nama Kategori:
                        </label>
                        <input class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600" id="category_name" name="category_name" placeholder="Masukkan nama kategori" required type="text" />
                    </div>
                    <div class="flex space-x-4">
                        <button class="bg-red-700 hover:bg-red-800 text-white font-semibold rounded-md px-6 py-2" type="submit">
                            Tambah Kategori
                        </button>
                        <a class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-md px-6 py-2" href="kelola_produk.php">
                            Kembali ke Kelola Produk
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
    </div>
</body>
</html>
