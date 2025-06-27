<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Kalau belum login, redirect ke halaman login admin
    header("Location: ../../akun/login_admin.php");
    exit;
}
?>

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

<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Navbar -->
    <header class="fixed top-0 left-0 right-0 w-full bg-white shadow-md z-30">
      <nav class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4">
        <!-- Toggle Button -->
        <button id="toggleSidebar" class="text-teal-700 focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

        <!-- User Info -->
        <div class="flex items-center gap-3 ml-auto">
          <h2 class="text-sm font-semibold">
            <?= isset($_SESSION['admin_username']) ? strtoupper($_SESSION['admin_username']) : '-' ?>
          </h2>
          <img src="../../../img/PPDB-logo-muhajirin.jpg" alt="Admin"
            class="w-10 h-10 rounded-full object-cover">
        </div>
      </nav>
    </header>
    <!-- Backdrop untuk klik di luar sidebar -->
    <div id="overlay"
      class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden">
    </div>
    <!-- ! Sidebar -->
    <aside class="w-64 bg-blue-600 text-white flex flex-col">
      <div class="ml-4 mt-6 flex items-center">
        <div class="text-5xl font-bold">SPMB</div>
        <img src="../../../img/logo-yayasan.png" alt="logo" class="w-1/3 h-auto" />
      </div>
      <div class="p-4 text-2xl font-bold">YAYASAN BAITUL MUHAJIRIN</div>
      <nav class="flex-1 p-4 space-y-2">
        <div class="py-4">
          <a href="#" class="ml-2 py-2">Pendaftaran</a>
          <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
            <i data-feather="home"></i>
            <a href="../beranda/beranda_admin.php" class="block ml-2 py-2">Beranda</a>
          </div>
          <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
            <i data-feather="user-plus"></i>
            <a href="../data-pendaftar-akun/data_pendaftar_akun.php" class="block ml-2 py-2">Verifikasi Pendaftaran Akun</a>
          </div>
          <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
            <i data-feather="file-plus"></i>
            <a href="../data-pendaftar-formulir/data_pendaftar_formulir.php" class="block ml-2 py-2">Verifikasi Formulir Pendaftaran</a>
          </div>
          <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
            <i data-feather="book-open"></i>
            <a href="../data-siswa/data_siswa.php" class="block ml-2 py-2">Data Siswa</a>
          </div>
          <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
            <i data-feather="clipboard"></i>
            <a href="../pengumuman/admin_jadwal.php" class="block ml-2 py-2">Pengumuman</a>
          </div>
        </div>
        <div class="py-4">
          <a href="#" class="ml-2 py-2">Akun</a>
          <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
            <i data-feather="power"></i>
            <a href="../logout/logout_admin.php" class="block ml-2 py-2">Logout</a>
          </div>
        </div>

      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold">Saat ini Anda berada pada proses: <span class="text-blue-700">Kelengkapan Pendaftaran</span></h1>
        <div class="flex items-center gap-4">
          <span class="text-sm">Muhammad Ferry Sofianshah</span>
          <img src="https://upload.wikimedia.org/wikipedia/id/thumb/e/e4/Logo_UBSI.svg/1200px-Logo_UBSI.svg.png" alt="Logo UBSI" class="w-10 h-10">
        </div>
      </div>

      <!-- Progress bar -->
      <div class="bg-white p-4 rounded shadow mb-6">
        <label class="text-sm font-medium">Progress</label>
        <div class="w-full bg-gray-200 rounded-full h-4 mt-2">
          <div class="bg-red-500 h-4 rounded-full text-white text-xs text-center" style="width: 5%;">5%</div>
        </div>
      </div>

      <!-- Profile Card -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow text-center">
          <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User" class="w-24 mx-auto mb-4">
          <h2 class="text-lg font-semibold">Muhammad Ferry Sofianshah</h2>
          <p class="text-sm text-blue-700">089688120962</p>
          <p class="text-sm text-blue-700">27/02/2003</p>
        </div>

        <!-- Info Box -->
        <div class="md:col-span-2 bg-white p-4 rounded shadow">
          <h3 class="text-md font-semibold mb-2">Info</h3>
          <p class="text-sm text-gray-600">No Pendaftaran: -</p>
          <p class="text-sm text-gray-600">Nama Lengkap: -</p>
          <p class="text-sm text-gray-600">Nama Panggilan: -</p>
          <p class="text-sm text-gray-600">Tempat, tgl lahir: -</p>
          <p class="text-sm text-gray-600">Jenis Kelamin: -</p>
          <p class="text-sm text-gray-600">Agama: -</p>
          <p class="text-sm text-gray-600">Anak Ke-: -</p>
          <p class="text-sm text-gray-600">Jumlah Saudara: -</p>
          <p class="text-sm text-gray-600">Status dalam keluarga: -</p>
          <p class="text-sm text-gray-600">Alamat: -</p>
        </div>
      </div>

      <!-- Stepper Image -->
      <div class="mt-6">
        <img src="https://i.ibb.co/3NRpWHZ/pendaftaran-step.png" alt="Langkah Pendaftaran" class="rounded shadow">
      </div>
    </main>
  </div>
  <script>
    feather.replace();
  </script>
</body>

</html>