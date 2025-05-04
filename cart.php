<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = $conn->query("SELECT cart.*, products.name, products.price 
                      FROM cart 
                      JOIN products ON cart.product_id = products.id 
                      WHERE cart.user_id = $user_id");

include 'header.php'; // ✅ Tambahkan header.php
?>

<div class="container mx-auto py-12">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-orange-600">Keranjang Belanja</h2>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <?php if ($cart->num_rows > 0): ?>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600">Produk</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600">Harga</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600">Jumlah</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600">Subtotal</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($item = $cart->fetch_assoc()):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td class="py-2 px-4 border-b border-gray-300"><?= $item['name'] ?></td>
                    <td class="py-2 px-4 border-b border-gray-300">Rp<?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td class="py-2 px-4 border-b border-gray-300">
                        <form method="POST" action="update_cart.php" class="flex items-center">
                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="w-12 text-center border border-gray-300 rounded-md">
                            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600 transition">Update</button>

                        </form>
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300">Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                    <td class="py-2 px-4 border-b border-gray-300">
                        <form method="POST" action="hapus_cart.php">
                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                            <button type="submit" onclick="return confirm('Hapus produk ini dari keranjang?')" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-full hover:bg-red-600 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <h3 class="text-xl font-bold text-gray-700">Total: Rp<?= number_format($total, 0, ',', '.') ?></h3>
            <a href="checkout.php" class="inline-block mt-4 px-6 py-3 bg-orange-500 text-white font-semibold rounded-full hover:bg-orange-600 transition">Lanjut ke Checkout</a>
        </div>
        <?php else: ?>
            <p class="text-gray-700">Keranjang kosong. <a href="produk.php" class="text-blue-500 hover:underline">Belanja sekarang</a></p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; // ✅ Tambahkan footer.php ?>
