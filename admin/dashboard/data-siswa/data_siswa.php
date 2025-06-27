<?php
include '../../../connect/connect.php';



$query = "SELECT * FROM siswa WHERE status_pending = 'diterima' ORDER BY id_siswa DESC";
$result = $conn->query($query);

?>


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
            <i data-feather="book-open"></i>
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
    <div class="p-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-4">📚 Data Siswa Diterima</h1>

      <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="py-3 px-4 text-left">No</th>
            <th class="py-3 px-4 text-left">Nama</th>
            <th class="py-3 px-4 text-left">Status</th>
            <th class="py-3 px-4 text-left">Jenis Kelamin</th>
            <th class="py-3 px-4 text-left">Tanggal Lahir</th>
            <th class="py-3 px-4 text-left">No. HP</th>
            <th class="py-3 px-4 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <?php
          $no = 1;
          while ($row = $result->fetch_assoc()):
          ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 px-4"><?= $no++ ?></td>
              <td class="py-2 px-4"><?= htmlspecialchars($row['nama_lengkap'] ?? '-') ?></td>
              <td class="py-2 px-4"><?= htmlspecialchars($row['status_siswa'] ?? '-') ?></td>
              <td class="py-2 px-4"><?= htmlspecialchars($row['jenis_kelamin'] ?? '-') ?></td>
              <td class="py-2 px-4"><?= htmlspecialchars($row['tempat_tgl_lahir'] ?? '-') ?></td>
              <td class="py-2 px-4"><?= htmlspecialchars($row['nope'] ?? '-') ?></td>
              <td class="py-2 px-4">
                <a href="../data-pendaftar-formulir/detail_data_siswa.php $row['id_siswa'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">Lihat</a>
                <a href="edit_siswa.php?id=<?= $row['id_siswa'] ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</a>
                <a href="hapus_siswa.php?id=<?= $row['id_siswa'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div>
  <script src="./js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script>
    feather.replace();
  </script>
</body>

</html>