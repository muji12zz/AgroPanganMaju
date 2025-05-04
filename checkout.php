<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil isi keranjang user
$cart = $conn->query("SELECT cart.*, products.name, products.price 
                      FROM cart 
                      JOIN products ON cart.product_id = products.id 
                      WHERE cart.user_id = $user_id");

$total = 0;
$items = [];
while ($item = $cart->fetch_assoc()) {
    $items[] = $item;
    $total += $item['price'] * $item['quantity'];
}

// Cek keranjang kosong
if (count($items) === 0) {
    echo "<script>alert('Keranjang kosong. Silakan tambahkan produk terlebih dahulu.'); 
          window.location.href='cart.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-yellow-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-8">
        <h1 class="text-orange-600 font-extrabold text-2xl mb-8 text-center">Checkout</h1>
        <form method="POST">
            <div class="mb-6">
                <label class="block text-gray-900 font-semibold mb-2" for="address">Alamat Pengiriman:</label>
                <textarea class="w-full border border-gray-300 rounded-md p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 resize-none" 
                          id="address" 
                          name="address" 
                          rows="4" 
                          placeholder="Masukkan alamat pengiriman Anda" 
                          required></textarea>
            </div>
            <div class="mb-6">
                <span class="block text-gray-900 font-semibold mb-2">Metode Pembayaran:</span>
                <div class="flex flex-col gap-3">
                    <label class="inline-flex items-center gap-2 text-gray-900 font-medium">
                        <input class="form-radio text-orange-600 focus:ring-orange-500" 
                               name="payment_method" 
                               type="radio" 
                               value="cod" 
                               required> COD (Bayar di Tempat)
                    </label>
                    <label class="inline-flex items-center gap-2 text-gray-900 font-medium">
                        <input class="form-radio text-orange-600 focus:ring-orange-500" 
                               name="payment_method" 
                               type="radio" 
                               value="transfer"> Transfer Bank
                    </label>
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <button type="button" 
                        onclick="history.back()" 
                        class="flex-1 bg-gray-300 text-gray-800 font-semibold rounded-full py-3 text-lg hover:bg-gray-400 transition">
                    Kembali
                </button>
                <button type="submit" 
                        name="checkout" 
                        class="flex-1 bg-orange-600 text-white font-semibold rounded-full py-3 text-lg hover:bg-orange-700 transition">
                    Proses Checkout
                </button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['checkout'])) {
        $address = $_POST['address'];
        $payment = $_POST['payment_method'];
        $status = ($payment == 'cod') ? 'Diproses' : 'Menunggu Pembayaran';
        $order_date = date('Y-m-d H:i:s');

        // Simulasi nomor VA
        $va = '1234567890123456';

        // Simpan order ke database
        $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, address, payment_method, status) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $order_date, $address, $payment, $status);

        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;

            // Simpan semua item dari keranjang ke order_items
            foreach ($items as $item) {
                $pid = $item['product_id'];
                $qty = $item['quantity'];
                $price = $item['price'];
                $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) 
                              VALUES ($order_id, $pid, $qty, $price)");
            }

            // Kosongkan keranjang
            $conn->query("DELETE FROM cart WHERE user_id = $user_id");

            // Kalau transfer, arahkan ke transfer_info
            if ($payment == 'transfer') {
                $_SESSION['va_number'] = $va;
                $_SESSION['transfer_total'] = $total;
                $_SESSION['order_id'] = $order_id;

                header("Location: transfer_info.php");
                exit();
            } else {
                // Kalau COD
                echo "<script>alert('Pesanan berhasil dibuat!'); window.location.href='index.php';</script>";
                exit();
            }
        } else {
            echo "<div class='text-red-600 text-center mt-4'>Checkout gagal: " . $stmt->error . "</div>";
        }
    }
    ?>
</body>
</html>