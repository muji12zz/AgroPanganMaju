<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Cek order milik user
$order = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$order_id' AND user_id = '$user_id'");
if (mysqli_num_rows($order) == 0) {
    echo "<div class='text-red-600 text-center'>Pesanan tidak ditemukan.</div>";
    exit();
}
$order_data = mysqli_fetch_assoc($order);

// Ambil item pesanan
$items = mysqli_query($conn, "
    SELECT oi.quantity, oi.price, p.name, oi.product_id
    FROM order_items oi 
    JOIN products p ON oi.product_id = p.id 
    WHERE oi.order_id = '$order_id'
");

// Hitung total
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Detail Pesanan #<?php echo htmlspecialchars($order_id); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-yellow-100 min-h-screen p-6 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg max-w-4xl w-full p-8">
        <h1 class="text-orange-600 font-extrabold text-3xl mb-6 text-center">Detail Pesanan #<?php echo htmlspecialchars($order_id); ?></h1>
        <div class="mb-6 space-y-2 text-gray-900 text-sm sm:text-base">
            <p><span class="font-semibold">Tanggal:</span> <?php echo htmlspecialchars($order_data['order_date']); ?></p>
            <p><span class="font-semibold">Alamat:</span> 
            <?php if ($order_data['status'] == 'Menunggu Pembayaran' && !$order_data['address_updated']): ?>
                <form method="POST" action="update_address.php" class="inline">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order_id) ?>">
<input type="text" name="address" value="<?= htmlspecialchars($order_data['address']) ?>" required class="rounded px-2 py-1 focus:outline-none focus:ring-0">
                    <button type="submit" class="bg-orange-600 text-white px-3 py-1 rounded ml-2 hover:bg-orange-700 transition">Update</button>
                </form>
            <?php else: ?>
                <?= htmlspecialchars($order_data['address']) ?>
            <?php endif; ?>
            </p>
            <p><span class="font-semibold">Metode Pembayaran:</span> <?php echo htmlspecialchars($order_data['payment_method'] == 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank'); ?></p>
            <p><span class="font-semibold">Status:</span> 
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                    <?php 
                    echo $order_data['status'] == 'Menunggu Pembayaran' ? 'bg-gray-200 text-gray-800' : 
                         ($order_data['status'] == 'Diproses' ? 'bg-yellow-200 text-yellow-800' : 
                         ($order_data['status'] == 'Dikirim' ? 'bg-green-200 text-green-800' : 
                         ($order_data['status'] == 'Selesai' ? 'bg-blue-200 text-blue-800' : 
                         ($order_data['status'] == 'Dibatalkan' ? 'bg-red-200 text-red-800' : 'bg-gray-200 text-gray-800')))); 
                    ?>">
                    <?php echo htmlspecialchars($order_data['status']); ?>
                </span>
            </p>
            <p><span class="font-semibold">Tracking Info:</span> <?php echo htmlspecialchars($order_data['tracking_info'] ?: 'Belum ada info pengiriman'); ?></p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300 border border-gray-300 rounded-lg">
                <thead class="bg-orange-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider rounded-tl-lg">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider rounded-tr-lg">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $product_id = 0; // Inisialisasi untuk digunakan di form ulasan
                    while ($row = mysqli_fetch_assoc($items)): 
                        $subtotal = $row['price'] * $row['quantity'];
                        $total += $subtotal;
                        $product_id = $row['product_id']; // Ambil product_id untuk ulasan
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $row['quantity']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot class="bg-gray-100 font-semibold text-gray-900">
                    <tr>
                        <td class="px-6 py-3 text-right" colspan="3">Total</td>
                        <td class="px-6 py-3 whitespace-nowrap">Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?php
        // Cek apakah status pesanan "Selesai" dan belum pernah review
        $cek_review = mysqli_query($conn, "
            SELECT * FROM reviews WHERE order_id = '$order_id' AND user_id = '$user_id'
        ");

        if ($order_data['status'] == 'Selesai' && mysqli_num_rows($cek_review) == 0): 
        ?>
        <div class="mt-8">
            <h3 class="text-orange-600 font-semibold text-xl mb-4">Berikan Ulasan</h3>
            <form method="POST" action="submit_review.php" class="space-y-4">
                <div>
                    <label class="block text-gray-900 font-semibold mb-2" for="rating">Rating:</label>
                    <select name="rating" id="rating" required class="w-full border border-gray-300 rounded-md p-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">-- Pilih --</option>
                        <option value="5">5 - Sangat Bagus</option>
                        <option value="4">4 - Bagus</option>
                        <option value="3">3 - Cukup</option>
                        <option value="2">2 - Kurang</option>
                        <option value="1">1 - Buruk</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-900 font-semibold mb-2" for="review">Ulasan:</label>
                    <textarea name="review" id="review" rows="4" required class="w-full border border-gray-300 rounded-md p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 resize-none"></textarea>
                </div>
                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                <button type="submit" class="bg-orange-600 text-white font-semibold rounded-full py-3 px-8 text-lg hover:bg-orange-700 transition">Kirim Ulasan</button>
            </form>
        </div>
        <?php elseif ($order_data['status'] == 'Selesai'): ?>
        <div class="mt-8 text-center">
            <p class="text-gray-700 italic">Terima kasih! Kamu sudah memberikan ulasan.</p>
        </div>
        <?php endif; ?>

        <div class="mt-8 text-center">
            <a href="my_orders.php" class="inline-block text-orange-600 font-semibold hover:underline">← Kembali ke My Order</a>
        </div>
    </div>
</body>
</html>