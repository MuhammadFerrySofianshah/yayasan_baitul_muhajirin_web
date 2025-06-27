<?php
session_start();
// untuk nampilin array db
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

include '../../../../connect/connect.php';
$jadwal = $conn->query("SELECT * FROM jadwal_ppdb ORDER BY id DESC LIMIT 1")->fetch_assoc();

// Cek apakah admin sudah login
if (!isset($_SESSION['user_id'])) {
  // Kalau belum login, redirect ke halaman login admin
  header("Location: ../../../../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulir Pendaftaran</title>
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
          <img src="../../../../img/PPDB-logo-muhajirin.jpg" alt="User"
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
        <img src="../../../../img/logo-yayasan.png" alt="logo" class="w-1/3 h-auto" />
      </div>
      <div class="p-4 text-2xl font-bold">YAYASAN BAITUL MUHAJIRIN</div>
      <nav class="flex-1 p-4 space-y-2">
        <div class="py-4">
          <a href="#" class="ml-2 py-2">Pendaftaran</a>
          <div class="flex py-2 px-4 items-center text-teal-100 hover:text-white">
            <i data-feather="home"></i>
            <a href="../../beranda/beranda_user.php" class="block ml-2 py-2">Beranda</a>
          </div>
          <div class="flex py-2 px-4 items-center text-teal-100 hover:text-white">
            <i data-feather="book-open"></i>
            <a href="daftar_siswa.php" class="block ml-2 py-2">Formulir Pendaftaran</a>
          </div>
        </div>
        <div class="py-4">
          <a href="#" class="ml-2 py-2">Akun</a>
          <div class="flex py-2 px-4 items-center text-teal-100 hover:text-white">
            <i data-feather="power"></i>
            <a href="../../logout/logout_user.php" class="block ml-2 py-2">Logout</a>
          </div>
        </div>

      </nav>
    </aside>
    <!-- Formulir Pendaftaran Siswa -->
    <main id="mainContent" class="relative z-10 p-6 pt-[70px] md:ml-64 flex-1">
      <h2 class="py-6 font-bold text-xl">Formulir Pendaftaran Siswa Baru</h2>
      <p class="mb-4 font-semibold text-md text-red-600">*Gunakan tanda " - " pada kolom yang tidak ingin diisi.</p>
      <form action="submit_daftar.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <!-- STEP 1: Data Siswa -->
        <div id="step1">
          <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-lg font-semibold mb-2">🧒 Data Siswa</h3>
            <div>
              <label for="full-name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
              <input type="text" id="full-name" name="full_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
            </div>

            <div>
              <label for="nickname" class="block text-sm font-medium text-gray-700">Nama Panggilan</label>
              <input type="text" id="nickname" name="nickname" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
            </div>

            <div>
              <label for="birth" class="block text-sm font-medium text-gray-700">Tempat, Tanggal Lahir</label>
              <input type="text" id="birth" name="birth" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
            </div>

            <div>
              <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
              <select id="gender" name="gender" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                <option value="" selected disabled>Pilih</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div>
              <label for="student_religion" class="block text-sm font-medium text-gray-700">Agama</label>
              <select id="student_religion" name="student_religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                <option value="" selected disabled>Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
              </select>
            </div>

            <div>
              <label for="child_order" class="block text-sm font-medium text-gray-700">Anak Ke-</label>
              <input type="number" id="child_order" name="child_order" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
            </div>

            <div>
              <label for="siblings" class="block text-sm font-medium text-gray-700">Jumlah Saudara</label>
              <input type="number" id="siblings" name="siblings" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
            </div>

            <div>
              <label for="family_status" class="block text-sm font-medium text-gray-700">Status dalam Keluarga</label>
              <select name="family_status" id="family_status" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>

                <option value="" selected disabled>Pilih</option>
                <option value="anak kandung">Anak Kandung</option>
                <option value="anak tiri">Anak Tiri</option>
                <option value="anak angkat">Anak Angkat</option>
              </select>

            </div>

            <div>
              <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
              <textarea id="address" name="address" rows="3" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
            </div>
           
          </div>

        </div>
        <!-- STEP 2: Data Orang Tua/Wali -->
        <div id="step2">
          <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">👨‍👩‍👧‍👦 Data Orang Tua/Wali</h3>

            <!-- Ayah -->
            <div class="mb-8 bg-gray-50 border border-gray-200 p-4 rounded-lg shadow-sm">
              <!-- Ayah -->
              <h3 class="text-lg font-semibold mt-4">Ayah</h3>
              <div>
                <label for="father_status" class="block text-sm font-medium text-gray-700">Status Ayah</label>
                <select id="father_status" name="father_status" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                  <option value="" selected disabled>Pilih</option>
                  <option value="kandung">Kandung</option>
                  <option value="tiri">Tiri</option>
                  <option value="angkat">Angkat</option>
                  <option value="wali">Wali</option>
                </select>
              </div>

              <div>
                <label for="father_name" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                <input type="text" id="father_name" name="father_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
              </div>

              <div>
                <label for="father_birthplace" class="block text-sm font-medium text-gray-700">Tempat Tanggal Lahir Ayah</label>
                <input type="text" id="father_birthplace" name="father_birthplace" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
              </div>

              <div>
                <label for="father_religion" class="block text-sm font-medium text-gray-700">Agama Ayah</label>
                <select id="father_religion" name="father_religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                  <option value="" selected disabled>Pilih</option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen Protestan">Kristen Protestan</option>
                  <option value="Kristen Katolik">Kristen Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Konghucu">Konghucu</option>
                </select>
              </div>

              <div>
                <label for="father_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <select id="father_job" name="father_job" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                  <option value="" disabled selected>Pilih</option>
                  <option value="PNS">PNS</option>
                  <option value="TNI/POLRI">TNI/POLRI</option>
                  <option value="Guru/Dosen">Guru/Dosen</option>
                  <option value="Dokter/Perawat">Dokter/Perawat</option>
                  <option value="Pedagang">Pedagang</option>
                  <option value="Petani">Petani</option>
                  <option value="Nelayan">Nelayan</option>
                  <option value="Karyawan Swasta">Karyawan Swasta</option>
                  <option value="Wiraswasta">Wiraswasta</option>
                  <option value="Buruh">Buruh</option>
                  <option value="Sopir/Ojek">Sopir/Ojek</option>
                  <option value="Tidak Bekerja">Tidak Bekerja</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>

              <div>
                <label for="father_education" class="block text-sm font-medium text-gray-700">Pendidikan Ayah</label>
                <select id="father_education" name="father_education" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                  <option value="" disabled selected>Pilih</option>
                  <option value="Tidak Sekolah">Tidak Sekolah</option>
                  <option value="SD/Sederajat">SD/Sederajat</option>
                  <option value="SMP/Sederajat">SMP/Sederajat</option>
                  <option value="SMA/SMK">SMA/SMK</option>
                  <option value="Diploma (D1-D3)">Diploma (D1-D3)</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                  <option value="S3">S3</option>
                </select>
              </div>

              <div>
                <label for="father_address" class="block text-sm font-medium text-gray-700">Alamat Ayah</label>
                <textarea id="father_address" name="father_address" rows="3" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
              </div>

              <div>
                <label for="father_phone" class="block text-sm font-medium text-gray-700">No. Telp Ayah</label>
                <input type="tel" id="father_phone" name="father_phone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
              </div>

              <!-- Ibu -->
              <h3 class="text-lg font-semibold mt-4">Ibu</h3>
              <div>
                <label for="mother_status" class="block text-sm font-medium text-gray-700">Status Ibu</label>
                <select id="mother_status" name="mother_status" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                  <option value="" selected disabled>Pilih</option>
                  <option value="kandung">Kandung</option>
                  <option value="tiri">Tiri</option>
                  <option value="angkat">Angkat</option>
                  <option value="wali">Wali</option>
                </select>

              </div>
              <div>
                <label for="mother_name" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                <input type="text" id="mother_name" name="mother_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
              </div>

              <div>
                <label for="mother_birthplace" class="block text-sm font-medium text-gray-700">Tempat Tanggal Lahir Ibu</label>
                <input type="text" id="mother_birthplace" name="mother_birthplace" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
              </div>

              <div>
                <label for="mother_religion" class="block text-sm font-medium text-gray-700">Agama Ibu</label>
                <select id="mother_religion" name="mother_religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                  <option value="" selected disabled>Pilih</option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen Protestan">Kristen Protestan</option>
                  <option value="Kristen Katolik">Kristen Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Konghucu">Konghucu</option>
                </select>
              </div>

              <div>
                <label for="mother_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <select id="mother_job" name="mother_job" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                  <option value="" disabled selected>Pilih</option>
                  <option value="PNS">PNS</option>
                  <option value="TNI/POLRI">TNI/POLRI</option>
                  <option value="Guru/Dosen">Guru/Dosen</option>
                  <option value="Dokter/Perawat">Dokter/Perawat</option>
                  <option value="Pedagang">Pedagang</option>
                  <option value="Petani">Petani</option>
                  <option value="Nelayan">Nelayan</option>
                  <option value="Karyawan Swasta">Karyawan Swasta</option>
                  <option value="Wiraswasta">Wiraswasta</option>
                  <option value="Buruh">Buruh</option>
                  <option value="Sopir/Ojek">Sopir/Ojek</option>
                  <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>

              <div>
                <label for="mother_education" class="block text-sm font-medium text-gray-700">Pendidikan Ibu</label>
                <select id="mother_education" name="mother_education" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                  <option value="" disabled selected>Pilih</option>
                  <option value="Tidak Sekolah">Tidak Sekolah</option>
                  <option value="SD/Sederajat">SD/Sederajat</option>
                  <option value="SMP/Sederajat">SMP/Sederajat</option>
                  <option value="SMA/SMK">SMA/SMK</option>
                  <option value="Diploma (D1-D3)">Diploma (D1-D3)</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                  <option value="S3">S3</option>
                </select>

              </div>

              <div>
                <label for="mother_address" class="block text-sm font-medium text-gray-700">Alamat Ibu</label>
                <textarea id="mother_address" name="mother_address" rows="3" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
              </div>

              <div>
                <label for="mother_phone" class="block text-sm font-medium text-gray-700">No. Telp Ibu</label>
                <input type="tel" id="mother_phone" name="mother_phone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
              </div>
            </div>
          
          </div>
        </div>
        <!-- STEP 3: Upload Berkas -->
        <div id="step3">
          <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">📁 Upload Berkas</h3>

            <!-- Card Upload -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Kartu Keluarga -->
              <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 shadow-sm">
                <label for="kk" class="block text-sm font-semibold text-gray-700 mb-1">📄 Kartu Keluarga</label>
                <input type="file" id="kk" name="kk"
                  class="w-full p-2 border border-gray-300 rounded text-sm text-gray-700 focus:ring-2 focus:ring-blue-300"
                  required onchange="previewFile(event, 'kk')" />
                <div id="kk-info" class="mt-2 text-sm text-gray-700 hidden">
                  <span class="font-medium">File:</span> <a id="kk-link" href="#" target="_blank" class="text-blue-600 hover:underline break-words"></a>
                </div>
                <div id="kk-preview" class="mt-2"></div>
              </div>

              <!-- Akte Kelahiran -->
              <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 shadow-sm">
                <label for="akte" class="block text-sm font-semibold text-gray-700 mb-1">📑 Akte Kelahiran</label>
                <input type="file" id="akte" name="akte"
                  class="w-full p-2 border border-gray-300 rounded text-sm text-gray-700 focus:ring-2 focus:ring-blue-300"
                  required onchange="previewFile(event, 'akte')" />
                <div id="akte-info" class="mt-2 text-sm text-gray-700 hidden">
                  <span class="font-medium">File:</span> <a id="akte-link" href="#" target="_blank" class="text-blue-600 hover:underline break-words"></a>
                </div>
                <div id="akte-preview" class="mt-2"></div>
              </div>

              <!-- KTP Orang Tua -->
              <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 shadow-sm">
                <label for="ktp" class="block text-sm font-semibold text-gray-700 mb-1">🆔 KTP Orang Tua</label>
                <input type="file" id="ktp" name="ktp"
                  class="w-full p-2 border border-gray-300 rounded text-sm text-gray-700 focus:ring-2 focus:ring-blue-300"
                  required onchange="previewFile(event, 'ktp')" />
                <div id="ktp-info" class="mt-2 text-sm text-gray-700 hidden">
                  <span class="font-medium">File:</span> <a id="ktp-link" href="#" target="_blank" class="text-blue-600 hover:underline break-words"></a>
                </div>
                <div id="ktp-preview" class="mt-2"></div>
              </div>

              <!-- Pas Foto -->
              <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 shadow-sm">
                <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">📸 Pas Foto (Merah/Biru)</label>
                <input type="file" id="foto" name="foto"
                  class="w-full p-2 border border-gray-300 rounded text-sm text-gray-700 focus:ring-2 focus:ring-blue-300"
                  required onchange="previewFile(event, 'foto')" />
                <div id="foto-info" class="mt-2 text-sm text-gray-700 hidden">
                  <span class="font-medium">File:</span> <a id="foto-link" href="#" target="_blank" class="text-blue-600 hover:underline break-words"></a>
                </div>
                <div id="foto-preview" class="mt-2"></div>
              </div>
            </div>
           
          </div>
        </div>

        <!-- STEP 4: Pembayaran -->
        <div id="step4">
          <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">💳 Pembayaran</h3>

            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md mb-4">
              <h4 class="font-semibold text-gray-800 mb-1">Rincian Biaya:</h4>
              <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                <li>Seragam Batik: <strong>Rp 190.000</strong></li>
                <li>SPP 1 Bulan: <strong>Rp 80.000</strong></li>
                <li>Perawatan Gedung: <strong>Rp 100.000</strong></li>
                <li class="text-green-800 mt-1">Total: <strong class="text-lg text-green-800">Rp 370.000</strong></li>
              </ul>
            </div>

            <div class="bg-white border border-gray-300 p-3 rounded-md mb-4 flex justify-between items-center">
              <div>
                <p class="text-sm text-gray-700">Transfer ke:</p>
                <p class="font-semibold text-gray-900">
                  <span id="rekeningText">BNI - 3657788876</span><br />
                  a.n. Yayasan Baitul Muhajirin
                </p>
              </div>
              <button onclick="salinRekening()" class="ml-4 px-3 py-2 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition">
                📋 Salin
              </button>
            </div>


            <div class="mb-4">
              <label for="bukti_bayar" class="block text-sm font-semibold text-gray-700 mb-1">📤 Upload Bukti Pembayaran</label>
              <input type="file" name="bukti_bayar" id="bukti_bayar"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-300"
                required onchange="previewFile(event, 'bukti_bayar')">

              <!-- File Info + Link -->
              <div id="bukti_bayar-info" class="text-sm text-gray-700 mt-2 hidden">
                <span class="font-medium">File:</span>
                <a id="bukti_bayar-link" href="#" target="_blank" class="text-green-600 hover:underline break-words"></a>
              </div>

              <!-- Preview -->
              <div id="bukti_bayar-preview" class="mt-2 rounded-lg overflow-hidden border border-dashed border-gray-300 p-2 bg-gray-50"></div>
            </div>

            <div class="mt-6 flex justify-end">
              <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-sm transition-all duration-200 flex items-center gap-2">
                <span>Kirim Formulir</span>
                <i data-feather="send"></i>
              </button>
            </div>
          </div>
        </div>

      </form>
    </main>

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
      // !Fungsi preview File Upload Berkasi
      function previewFile(event, id) {
        const file = event.target.files[0];
        const fileInfo = document.getElementById(`${id}-info`);
        const fileLink = document.getElementById(`${id}-link`);
        const filePreview = document.getElementById(`${id}-preview`);

        if (!file) {
          fileInfo.classList.add('hidden');
          filePreview.innerHTML = '';
          return;
        }

        const url = URL.createObjectURL(file);
        fileLink.href = url;
        fileLink.textContent = file.name;
        fileInfo.classList.remove('hidden');

        if (file.type.startsWith('image/')) {
          filePreview.innerHTML = `<img src="${url}" class="max-h-64 border rounded" />`;
        } else if (file.type === 'application/pdf') {
          filePreview.innerHTML = `<embed src="${url}" type="application/pdf" width="100%" height="300px" class="border rounded" />`;
        } else {
          filePreview.innerHTML = `<p class="text-red-600 text-sm">Preview tidak tersedia untuk file ini.</p>`;
        }
      }

      // ! Salin Rek.
      function salinRekening() {
        const rekening = document.getElementById("rekeningText").textContent;
        navigator.clipboard.writeText(rekening).then(function() {
          alert("✅ Nomor rekening berhasil disalin!");
        }, function() {
          alert("❌ Gagal menyalin. Silakan coba lagi.");
        });
      }

      // ! Simpan Input formulir
      const form = document.querySelector("form");

      // Simpan semua input saat user mengetik
      form.addEventListener("input", () => {
        const data = new FormData(form);
        const obj = {};
        data.forEach((val, key) => obj[key] = val);
        localStorage.setItem("formulir_pendaftaran", JSON.stringify(obj));
      });

      // Restore data dari localStorage
      window.addEventListener("DOMContentLoaded", () => {
        const saved = JSON.parse(localStorage.getItem("formulir_pendaftaran"));
        if (saved) {
          for (const [key, val] of Object.entries(saved)) {
            const input = form.elements[key];
            if (input) {
              if (input.type === "radio" || input.type === "checkbox") {
                input.checked = input.value === val;
              } else {
                input.value = val;
              }
            }
          }
        }
      });
      // Optional: clear data saat submit berhasil
      form.addEventListener("submit", (e) => {
        localStorage.removeItem("formulir_pendaftaran");
        console.log("📝 Form akan dikirim!");
      });
    </script>
</body>

</html>