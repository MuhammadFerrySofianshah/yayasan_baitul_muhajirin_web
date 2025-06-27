<?php
include '../../../connect/connect.php';

$result = $conn->query("SELECT * FROM pendaftar ORDER BY waktu_pendaftaran_akun DESC");



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
    <div class="flex-1 px-6">
      <h1 class="text-xl font-bold py-6 text-gray-800">Verifikasi Pendaftar Akun</h1>
      <table class="w-full table-auto bg-white shadow-lg rounded-md overflow-hidden">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">No. HP</th>
            <th class="p-2">Tanggal Lahir</th>
            <th class="p-2">Waktu Daftar</th>
            <th class="p-2">Status</th>
            <th class="p-2">Bukti</th>
            <th class="p-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b">
              <td class="p-2"><?= htmlspecialchars($row['nama']) ?></td>
              <td class="p-2"><?= htmlspecialchars($row['nope']) ?></td>
              <td class="p-2"><?= htmlspecialchars($row['tglLahir']) ?></td>
              <td class="p-2"><?= htmlspecialchars($row['waktu_pendaftaran_akun']) ?></td> <!-- Data waktu daftar -->
              <td class="p-2 font-semibold 
            <?= $row['status'] === 'diterima' ? 'text-teal-600' : ($row['status'] === 'ditolak' ? 'text-red-600' : 'text-yellow-600') ?>">
                <?= htmlspecialchars($row['status']) ?>
              </td>
              <!-- Bukti Pendaft -->
              <td class="px-4 py-2">
                <a href="../../<?php echo $row['bukti_byPendaftar']; ?>" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
              </td>
              <!-- Terima/Tolak -->
              <td class="p-2">
                <form action="./../../update/update_status.php" method="POST" class="flex gap-1">
                  <input type="hidden" name="id_pendaftar" value="<?= $row['id_pendaftar'] ?>">
                  <button name="status" value="diterima" class="bg-teal-500 text-white px-2 py-1 rounded text-sm">Terima</button>
                  <button name="status" value="ditolak" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Tolak</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
<script>
  feather.replace();
</script>

</html>