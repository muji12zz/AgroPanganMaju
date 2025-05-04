<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center relative" style="background-image: url('image/background.png');">

  <!-- Overlay gelap -->
  <div class="absolute inset-0 bg-black bg-opacity-70 z-0"></div>

  <!-- Card register -->
  <div class="relative z-10 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
      <!-- Logo -->
      <div class="flex justify-center mb-4">
        <img src="image/logo.png" alt="Logo" class="h-20">
      </div>

      <h2 class="text-2xl font-bold mb-6 text-center text-red-600">Daftar Akun</h2>

      <?php if (!empty($error)): ?>
        <div class="text-red-600 text-sm mb-4 text-center"><?= $error ?></div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="text-green-600 text-sm mb-4 text-center"><?= $success ?></div>
      <?php endif; ?>

      <form method="POST" action="register.php">
        <div class="mb-4">
          <input name="name" type="text" placeholder="Nama Lengkap" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" required />
        </div>
        <div class="mb-4">
          <input name="username" type="text" placeholder="Username" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" required />
        </div>
        <div class="mb-4">
          <input name="email" type="email" placeholder="Email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" required />
        </div>
        <div class="mb-4">
          <input name="phone" type="text" placeholder="No HP" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" required />
        </div>
        <div class="mb-6">
          <input name="password" type="password" placeholder="Password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" required />
        </div>
        <button type="submit" class="w-full bg-red-600 text-white p-3 rounded-lg font-bold hover:bg-red-700">Daftar</button>
      </form>

      <p class="mt-4 text-center text-sm">Sudah punya akun? 
        <a href="login.php" class="text-red-600 hover:underline">Login di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
