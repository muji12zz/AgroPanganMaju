<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('image/background.png');">
  <!-- Overlay gelap -->
  <div class="absolute inset-0 bg-black bg-opacity-60 z-0"></div>

  <div class="relative z-10 w-full max-w-6xl flex flex-col md:flex-row shadow-lg rounded-lg overflow-hidden">
    <!-- Gambar Kiri -->
    <div class="w-full md:w-1/2 bg-cover bg-center hidden md:flex items-center justify-center">
      <div class="text-center">
        <img alt="Company Logo" class="mx-auto mb-4" height="300" src="image/logo.png" width="300"/>
      </div>
    </div>

    <!-- Form Login -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-8">
      <div class="w-80">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>

        <?php if (!empty($error)): ?>
          <p class="text-red-600 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
          <div class="mb-4">
            <input name="username" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username / Email" type="text" required/>
          </div>
          <div class="mb-4">
            <input name="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password" type="password" required/>
          </div>
          <div class="mb-4 text-right">
            <a class="text-red-600 text-sm" href="register.php">Belum memiliki akun?</a>
          </div>
          <button class="w-full bg-red-600 text-white p-3 rounded-lg font-bold hover:bg-red-700" type="submit" >Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
