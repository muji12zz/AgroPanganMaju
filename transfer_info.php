<?php
session_start();
if (!isset($_SESSION['va_number']) || !isset($_SESSION['transfer_total']) || !isset($_SESSION['order_id'])) {
    header("Location: index.php");
    exit();
}

$va = $_SESSION['va_number'];
$total = $_SESSION['transfer_total'];
$order_id = $_SESSION['order_id'];

// Optional: unset session agar tidak disimpan terus
unset($_SESSION['va_number']);
unset($_SESSION['transfer_total']);
unset($_SESSION['order_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Transfer Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-yellow-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-8 text-center">
        <h1 class="text-orange-600 font-extrabold text-2xl mb-6">Transfer Pembayaran</h1>
        <p class="text-gray-900 text-lg mb-4">Silakan transfer ke nomor VA berikut:</p>
        <p class="text-gray-900 font-extrabold text-xl mb-6 select-all"><?php echo htmlspecialchars($va); ?></p>
        <p class="text-gray-900 text-lg mb-4">Total pembayaran:</p>
        <p class="text-orange-600 font-extrabold text-xl mb-6">Rp <?php echo number_format($total, 0, ',', '.'); ?></p>
        <p class="text-gray-900 text-lg mb-8">ID Pesanan Anda: <span class="font-semibold">#<?php echo htmlspecialchars($order_id); ?></span></p>
        <p class="text-gray-700 mb-10">Setelah transfer, pesanan Anda akan kami proses secepatnya.</p>
        <a href="index.php" class="inline-block bg-orange-600 text-white font-semibold rounded-full py-3 px-8 text-lg hover:bg-orange-700 transition">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>