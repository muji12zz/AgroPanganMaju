<?php
session_start();
include '../db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $desc = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $imagePath = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $targetDir = "../uploads/";
        $imageName = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        if (!in_array($_FILES["image"]["type"], $allowedTypes)) {
            $message = "❌ File harus berupa JPG, JPEG, PNG, atau WEBP!";
        } else {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $imagePath = "uploads/" . $imageName;

                $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssiss", $name, $desc, $price, $category, $imagePath);

                if ($stmt->execute()) {
                    $message = "✅ Produk berhasil ditambahkan!";
                } else {
                    $message = "❌ Gagal menyimpan produk: " . $stmt->error;
                }
            } else {
                $message = "❌ Gagal mengupload gambar. Cek permission folder uploads/";
            }
        }
    } else {
        $message = "❌ Gambar tidak dipilih atau error saat upload.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Roboto', sans-serif; }
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
        <a href="kelola_ulasan.php" class="block py-3 px-4 rounded transition duration-200 hover:bg-[#B12930]">
            <i class="fas fa-comments mr-3"></i> Ulasan
        </a>
    </nav>
</div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-6">Tambah Produk</h2>

            <?php if ($message): ?>
                <div class="mb-4 px-4 py-3 rounded text-white font-medium 
                    <?= strpos($message, '✅') === 0 ? 'bg-green-500' : 'bg-red-500' ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Produk:</label>
                    <input name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Nama Produk">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Deskripsi:</label>
                    <textarea name="description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" placeholder="Deskripsi Produk"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Kategori:</label>
                    <select name="category" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category">
                        <?php
                        $categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                        while ($cat = $categories->fetch_assoc()):
                        ?>
                            <option value="<?= htmlspecialchars($cat['name']) ?>"><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Harga:</label>
                    <input name="price" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" type="number" placeholder="Harga Produk">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Gambar Produk:</label>
                    <input name="image" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" type="file" accept="image/*">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-[#B12930] hover:bg-[#e2542e] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
