<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agro Pangan Maju</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .cursor::after { content: "|"; animation: blink 1s infinite; color: red; }
    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
  </style>
</head>
<body class="bg-white text-gray-800">
  <!-- Header -->
  <header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      <div class="flex items-center">
        <img src="image/logo.png" alt="Agro Pangan Maju logo" class="h-10 w-10">
        <span class="ml-2 text-red-600 font-bold text-lg">Agro Pangan Maju</span>
      </div>
      <nav class="flex items-center space-x-6">
        <a href="index.php" class="text-red-600 font-semibold hover:text-red-800 transition">Beranda</a>
        <a href="produk.php" class="text-gray-700 hover:text-red-600 transition">Produk</a>

        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- Kalau user login -->
          <a href="my_orders.php" class="text-gray-700 hover:text-red-600 transition">My Order</a>
          <a href="cart.php" class="text-gray-700 hover:text-red-600 transition">Keranjang</a>
          <span class="text-gray-800 font-semibold">Hi, <?= htmlspecialchars($_SESSION['role']) ?></span>
          <a href="logout.php" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Logout</a>
        <?php else: ?>
          <!-- Kalau belum login -->
          <a href="login.php" class="text-gray-700 hover:text-red-600 transition">Login</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
</body>
</html>
