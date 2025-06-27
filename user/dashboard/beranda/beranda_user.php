<?php
session_start();
// untuk nampilin array db
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

include '../../../connect/connect.php';
$jadwal = $conn->query("SELECT * FROM jadwal_ppdb ORDER BY id DESC LIMIT 1")->fetch_assoc();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Kalau belum login, redirect ke halaman login user
    header("Location: ../../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda User</title>
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
                        <?= isset($_SESSION['nama_lengkap']) ? strtoupper($_SESSION['nama_lengkap']) : '-' ?>
                    </h2>
                    <img src="../../../img/PPDB-logo-muhajirin.jpg" alt="User"
                        class="w-10 h-10 rounded-full object-cover">
                </div>
            </nav>
        </header>
        <!-- Backdrop untuk klik di luar sidebar -->
        <div id="overlay"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden">
        </div>
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-0 left-0 h-screen z-40 w-64 bg-teal-500 text-white flex flex-col transition-transform duration-300 -translate-x-full md:translate-x-0">
            <div class="ml-4 mt-6 flex items-center">
                <div class="text-5xl font-bold">SPMB</div>
                <img src="../../../img/logo-yayasan.png" alt="logo" class="w-1/3 h-auto" />
            </div>
            <div class="p-4 text-2xl font-bold">YAYASAN BAITUL MUHAJIRIN</div>
            <nav class="flex-1 p-4 space-y-2">
                <div class="py-4">
                    <a href="#" class="ml-2 py-2">Pendaftaran</a>
                    <div class="flex py-2 px-4 items-center text-teal-100 hover:text-white">
                        <i data-feather="home"></i>
                        <a href="beranda_user.php" class="block ml-2 py-2">Beranda</a>
                    </div>
                    <div class="flex py-2 px-4 items-center text-teal-100 hover:text-white">
                        <i data-feather="book-open"></i>
                        <a href="../pendaftaran-siswa/formulir/daftar_siswa.php" class="block ml-2 py-2">Formulir Pendaftaran</a>
                    </div>
                </div>
                <div class="py-4">
                    <a href="#" class="ml-2 py-2">Akun</a>
                    <div class="flex py-2 px-4 items-center text-teal-100 hover:text-white">
                        <i data-feather="power"></i>
                        <a href="../logout/logout_user.php" class="block ml-2 py-2">Logout</a>
                    </div>
                </div>

            </nav>
        </aside>
        <!-- Main Content -->
        <main id="mainContent" class="relative z-10 p-6 pt-[100px] md:ml-64">
            <!-- Progress dan Jadwal sejajar -->
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <!-- Box Jadwal -->
                <div class="bg-white p-4 rounded shadow w-full md:w-1/2">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">📅 Jadwal Penerimaan Siswa Baru (SPMB)</h3>
                    <p class="text-sm text-gray-600 mb-2">
                        <span class="font-semibold">Gelombang:</span> <?= $jadwal['gelombang'] ?? '-' ?>
                    </p>
                    <p class="text-sm text-teal-700">
                        <span class="font-semibold">📝 Pendaftaran:</span><br>
                        <?= date('d F Y', strtotime($jadwal['pendaftaran_mulai'])) ?> s.d <?= date('d F Y', strtotime($jadwal['pendaftaran_selesai'])) ?>
                    </p>
                    <p class="text-sm text-teal-700 mt-2">
                        <span class="font-semibold">📢 Pengumuman Hasil:</span><br>
                        <?= date('d F Y', strtotime($jadwal['pengumuman_mulai'])) ?> s.d <?= date('d F Y', strtotime($jadwal['pengumuman_selesai'])) ?>
                    </p>
                </div>
                <!-- Status Verifikasi -->
                <div class="bg-white p-4 rounded shadow w-full md:w-1/2">
                    <label class="text-xl font-medium">Status Verifikasi Formulir Anda</label>
                    <?php
                    $id_pendaftar = $_SESSION['id_pendaftar'] ?? null;
                    $status = 'belum_isi';

                    if ($id_pendaftar) {
                        include '../../../connect/connect.php';
                        $query = mysqli_query($conn, "SELECT status_pending FROM siswa WHERE id_pendaftar = '$id_pendaftar' ORDER BY id_siswa DESC LIMIT 1");
                        // $data = mysqli_fetch_assoc($query);
                        // $status = $data['status_pending'] ?? 'pending';
                        if ($query && $data = mysqli_fetch_assoc($query)) {
                            $status = $data['status_pending'] ?? 'pending';
                        }
                    }
                    ?>
                    <!-- Tampilkan keterangan status -->
                    <p class="text-sm font-semibold my-2
        <?= $status === 'diterima' ? 'text-green-600' : ($status === 'ditolak' ? 'text-red-600' : ($status === 'pending' ? 'text-yellow-600' : 'text-gray-500')) ?>">

                        <?= $status === 'diterima' ? '✅ Diterima' : ($status === 'ditolak' ? '❌ Ditolak' : ($status === 'pending' ? '⏳ Menunggu Verifikasi' :
                            '❗ Anda belum mengisi formulir pendaftaran.')) ?>
                    </p>

                    <!-- Tombol Aksi: Isi atau Cetak -->
                    <?php if ($status === 'belum_isi'): ?>
                        <div class="flex flex-wrap gap-3 mt-3"><!-- Jika belum isi, tampilkan tombol Isi Sekarang -->
                            <a href="../pendaftaran-siswa/formulir/daftar_siswa.php"
                                class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-4 py-2 rounded-lg shadow-sm transition-all duration-200">
                                📝 Isi Sekarang
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-wrap gap-3 mt-3"><!-- Jika sudah isi, tampilkan tombol Cetak Bukti -->
                            <a href="../pendaftaran-siswa/formulir/cetak_formulir.php" target="_blank"
                                class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm px-4 py-2 rounded-lg shadow-sm transition-all duration-200">
                                🖨️ Cetak Bukti Pendaftaran
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- Container untuk Profile + Info + Stepper -->
            <div class="flex flex-col md:flex-row gap-4 mt-6">

                <!-- Bagian kiri: Profile Card + Info Box -->
                <div class="flex flex-col gap-4 w-full md:w-2/3">

                    <!-- Profile Card -->
                    <div class="bg-white p-4 rounded shadow text-center">
                        <img src="../../../img/PPDB-logo-muhajirin.jpg" alt="User" class="w-24 mx-auto mb-4">
                        <h2 class="text-base font-semibold">
                            <?= isset($_SESSION['nama_lengkap']) ? strtoupper($_SESSION['nama_lengkap']) : '-' ?>
                        </h2>
                        <p class="text-sm text-teal-700"><?= $_SESSION['nope'] ?? '-' ?></p>
                        <p class="text-sm text-teal-700">
                            <?= isset($_SESSION['tanggal_lahir']) ? date('d F Y', strtotime($_SESSION['tanggal_lahir'])) : '-' ?>
                        </p>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-white p-4 rounded shadow">
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
                    <!-- Kontak Admin -->
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md mb-6">
                        <p class="text-sm font-medium text-green-800 mb-2">❓ Butuh bantuan atau punya pertanyaan?</p>
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.52 3.48A11.75 11.75 0 0012 0a11.9 11.9 0 00-9.29 18.84L0 24l5.35-2.7A11.87 11.87 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.87 0-3.68-.5-5.26-1.44l-.38-.22-3.17 1.6.6-3.3-.22-.38A9.87 9.87 0 1122 12c0 5.5-4.5 10-10 10zm5.52-7.08l-1.91-.55a1.23 1.23 0 00-1.16.32l-.59.61a8.42 8.42 0 01-4.11-4.11l.61-.59a1.23 1.23 0 00.32-1.16l-.55-1.91a1.24 1.24 0 00-1.18-.91H8.1c-.6 0-1.1.5-1.1 1.1a10.9 10.9 0 0010.9 10.9c.6 0 1.1-.5 1.1-1.1v-1.15c0-.53-.36-.99-.88-1.18z" />
                            </svg>
                            Hubungi Admin via WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Bagian kanan: Stepper Image -->
                <div class="w-full">
                    <img src="../../../img/langkah-pendaftaran.jpg" alt="Langkah Pendaftaran" class="rounded shadow w-full">
                </div>

            </div>




        </main>
        <!-- Background Gambar Full -->
        <div class="absolute top-0 left-0 w-full h-[300px] md:h-[200px] bg-cover bg-center z-0"
            style="background-image: url('../../../img/bg-dashboard-user.jpg');">
        </div>
        <!-- js -->
        <script>
            feather.replace();
            const toggleSidebar = document.getElementById('toggleSidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });

            // Optional: Tutup otomatis jika resize ke desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    overlay.classList.add('hidden');
                    sidebar.classList.remove('-translate-x-full');
                }
            });
        </script>
</body>

</html>