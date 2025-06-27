<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link rel="shortcut icon" href="../../../img/logo-yayasan.ico" />
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="flex items-center justify-center h-screen bg-gray-100">
  <form action="proses_login_admin.php" method="POST" class="bg-white p-8 rounded shadow w-80">
    <h2 class="text-xl font-bold mb-6 text-center text-teal-700">Login Admin</h2>

    <?php if (isset($_SESSION['login_error'])): ?>
      <p class="text-red-600 text-sm mb-4"><?= $_SESSION['login_error'];
                                            unset($_SESSION['login_error']); ?></p>
    <?php endif; ?>

    <label class="block mb-2 text-sm font-medium">Username</label>
    <input type="text" name="username" required class="w-full border p-2 mb-4 rounded">

    <label class="block mb-2 text-sm font-medium">Password</label>
    <div class="relative">
      <input type="password" name="password" id="passwordInput" required class="w-full border p-2 pr-10 rounded">
      <span id="togglePassword" class="absolute right-3 top-2.5 cursor-pointer text-gray-500"><i data-feather="eye"></i></span>
    </div>

    <button type="submit" class="w-full bg-teal-600 text-white p-2 rounded mt-6 hover:bg-teal-700">Login</button>
  </form>


  <script>
    const toggle = document.getElementById('togglePassword');
    const input = document.getElementById('passwordInput');

    toggle.addEventListener('click', () => {
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';

      // Ganti isi icon-nya
      toggle.innerHTML = isPassword ?
        '<i data-feather="eye-off"></i>' :
        '<i data-feather="eye"></i>';

      // Render ulang feather icons
      feather.replace();
    });

    // Inisialisasi feather icon pertama kali
    feather.replace();
  </script>


</body>

</html>