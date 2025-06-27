<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Yayasan Baitul Muhajirin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="./img/logo-yayasan.ico" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <div class="flex min-h-screen">
        <!-- ! Sidebar -->
        <aside class="w-64 bg-blue-600 text-white flex flex-col">
            <div class="ml-4 mt-6 flex items-center">
                <div class="text-5xl font-bold">ADMIN</div>
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
                        <a href="../data-pendaftar-akun/data_pendaftar_akun.php" class="block ml-2 py-2">Verifikasi Pendaftar Akun</a>
                    </div>
                    <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
                        <i data-feather="book-open"></i>
                        <a href="../data-siswa/data_siswa.php" class="block ml-2 py-2">Data Siswa</a>
                    </div>
                </div>
                <div class="py-4">
                    <a href="#" class="ml-2 py-2">Akun</a>
                    <div class="flex py-2 px-4 items-center text-blue-100 hover:text-white">
                        <i data-feather="power"></i>
                        <a href="#" class="block ml-2 py-2">Logout</a>
                    </div>
                </div>

            </nav>
        </aside>
        <form method="POST" action="simpan_jadwal.php" class="space-y-2 bg-white p-4 rounded shadow">
            <input type="hidden" name="id" value="<?= $jadwal['id'] ?? '' ?>">

            <label>Gelombang:</label>
            <input type="text" name="gelombang" value="<?= $jadwal['gelombang'] ?? '' ?>" required>

            <label>Pendaftaran Mulai:</label>
            <input type="date" name="pendaftaran_mulai" value="<?= $jadwal['pendaftaran_mulai'] ?? '' ?>" required>

            <label>Pendaftaran Selesai:</label>
            <input type="date" name="pendaftaran_selesai" value="<?= $jadwal['pendaftaran_selesai'] ?? '' ?>" required>

            <label>Pengumuman Mulai:</label>
            <input type="date" name="pengumuman_mulai" value="<?= $jadwal['pengumuman_mulai'] ?? '' ?>" required>

            <label>Pengumuman Selesai:</label>
            <input type="date" name="pengumuman_selesai" value="<?= $jadwal['pengumuman_selesai'] ?? '' ?>" required>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>

    </div>
    <script src="./js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>