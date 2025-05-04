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
        <div class="flex-1 p-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-6">Edit Produk</h2>
                <?php
                include '../db_connect.php';
                session_start();

                if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                    header("Location: ../login.php");
                    exit();
                }

                if (!isset($_GET['id'])) {
                    echo '<div class="text-red-600">ID produk tidak ditemukan.</div>';
                    exit();
                }

                $id = $_GET['id'];
                $query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
                $data = mysqli_fetch_assoc($query);

                if (!$data) {
                    echo '<div class="text-red-600">Produk tidak ditemukan.</div>';
                    exit();
                }

                if (isset($_POST['update'])) {
                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $image_path = $data['image'];

                    if ($_FILES['image']['name']) {
                        $image = $_FILES['image'];
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                        if (in_array($image['type'], $allowedTypes)) {
                            $new_filename = uniqid() . "_" . basename($image['name']);
                            $target_path = '../uploads/' . $new_filename;

                            if (move_uploaded_file($image['tmp_name'], $target_path)) {
                                $image_path = 'uploads/' . $new_filename;
                            } else {
                                echo '<div class="text-red-600">Gagal upload gambar baru.</div>';
                            }
                        } else {
                            echo '<div class="text-red-600">Tipe file tidak diizinkan.</div>';
                        }
                    }

                    $category = $_POST['category'];
                    $update = mysqli_query($conn, "UPDATE products SET name='$name', description='$description', price='$price', image='$image_path', category='$category' WHERE id='$id'");

                    if ($update) {
                        echo '<div class="text-green-600 mb-4">Produk berhasil diupdate!</div>';
                    } else {
                        echo '<div class="text-red-600 mb-4">Gagal update: ' . mysqli_error($conn) . '</div>';
                    }
                }
                ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                        <textarea name="description" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required><?= htmlspecialchars($data['description']); ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                        <select name="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                            <?php
                            $categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                            while ($cat = $categories->fetch_assoc()):
                            ?>
                                <option value="<?= htmlspecialchars($cat['name']) ?>" <?= $cat['name'] === $data['category'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
                        <input type="number" name="price" value="<?= $data['price']; ?>" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk:</label>
                        <?php if ($data['image']) : ?>
                            <img src="../<?= $data['image']; ?>" alt="Gambar produk" class="mb-2 w-40">
                            <small>Gambar saat ini</small>
                        <?php endif; ?>
                        <input type="file" name="image" class="mt-2">
                        <p class="text-sm text-gray-500">Kosongkan jika tidak ingin ganti gambar</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="update" class="bg-[#B12930] hover:bg-[#e2542e] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Produk
                        </button>
                        <a href="kelola_produk.php" class="text-[#B12930] font-semibold hover:underline">← Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>