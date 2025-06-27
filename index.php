<?php
include './connect/connect.php'; // pastikan path ini benar
$jadwal = $conn->query("SELECT * FROM jadwal_ppdb ORDER BY id DESC LIMIT 1")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Yayasan Baitul Muhajirin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link rel="shortcut icon" href="./img/logo-yayasan.ico" />
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
  <!-- Modal Pendaftaran Akun -->
  <div id="pendaftaran-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative w-full max-w-4xl mx-auto p-4">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-teal-600 px-6 py-4 flex justify-between items-center">
          <h3 class="text-xl font-bold text-white">Form Pendaftaran Akun</h3>
          <button data-modal-hide="pendaftaran-modal" class="text-white text-2xl leading-none">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
          <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-md text-sm text-gray-700">
            <p class="font-semibold text-base mb-2">📌 Tata Cara Daftar Akun:</p>
            <ul class="list-disc list-inside space-y-2 text-sm">
              <li>Isi nama lengkap dengan awalan huruf <strong class="text-black-600">Kapital/Besar</strong>.</li>
              <li>Gunakan nomor HP <strong class="text-black-600">Aktif</strong> untuk login dan verifikasi.</li>
              <li>Transfer biaya pendaftaran sebesar <strong class="text-red-600">Rp 70.000</strong>.</li>
              <li>Upload bukti transfer dengan <strong class="text-black-600">jelas</strong> dan <strong class="text-black-600">valid</strong>.</li>
              <li>Tunggu proses <strong class="text-black-600">verifikasi</strong> dari admin yayasan.</li>
              <li>Jika akun disetujui, Anda bisa langsung login.</li>
            </ul>
            <div class="mt-4 text-sm bg-yellow-100 border border-yellow-400 text-yellow-800 p-3 rounded">
              ⏰ Pendaftaran dibuka s/d <strong>11 Agustus 2025</strong>
            </div>
          </div>
          <form id="pendaftaranForm" method="post" enctype="multipart/form-data"
            action="./user/akun/daftar/submit_daftar_akun.php" class="space-y-4">
            <div>
              <label class="block font-medium">Nama Lengkap</label>
              <input type="text" name="nama" required class="w-full p-2 border rounded" />
            </div>
            <div>
              <label class="block font-medium">No HP</label>
              <input type="number" name="nope" required class="w-full p-2 border rounded" pattern="^[0-9]{10,13}$"
                minlength="10" title="Nomor HP minimal 10 angka dan hanya boleh angka saja" />
            </div>
            <div>
              <label class="block font-medium">Tanggal Lahir</label>
              <input type="date" name="tglLahir" required class="w-full p-2 border rounded" />
            </div>
            <div>
              <label class="block font-medium">Password</label>
              <div class="relative">
                <input id="passwordInputDaftar" type="password" name="password" required
                  class="w-full p-2 border rounded pr-10"
                  minlength="8"
                  pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                  title="Minimal 8 karakter, kombinasi huruf dan angka" />
                <button type="button" id="togglePasswordDaftar"
                  class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                  <i data-feather="eye"></i>
                </button>
              </div>
            </div>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded-md text-sm">
              <p class="mb-1">💸 Transfer ke:</p>
              <div class="flex items-center justify-between bg-white border px-3 py-2 rounded">
                <span><strong>BNI</strong> - <span id="noRek">3657788876</span><br />a.n. Yayasan Baitul Muhajirin</span>
                <button type="button" onclick="copyRekening()" class="text-blue-600 hover:underline text-sm">📋 Salin</button>
              </div>
            </div>
            <div>
              <label class="block font-medium">Upload Bukti Transfer</label>
              <input type="file" name="bukti_transfer" accept="image/*,.pdf" required
                class="w-full p-2 border rounded" onchange="previewBuktiTransfer(event)" />
              <div id="fileInfo" class="mt-2 text-sm text-gray-700 hidden">
                <span class="font-medium">File:</span>
                <a id="fileLink" href="#" target="_blank" class="text-blue-600 hover:underline"></a>
              </div>
              <div id="filePreview" class="mt-2"></div>
            </div>
            <div class="flex justify-end gap-3 pt-2">
              <button type="button" data-modal-hide="pendaftaran-modal"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                Batal
              </button>
              <button type="submit" onclick="tampilkanBuktiPendaftaran();"
                class="px-4 py-2 text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg">
                Daftar Sekarang
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Login User -->
  <div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative w-full max-w-3xl mx-auto p-4">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-teal-600 px-6 py-4 flex justify-between items-center">
          <h3 class="text-xl font-bold text-white">Login Pengguna</h3>
          <button data-modal-hide="authentication-modal" class="text-white text-2xl leading-none">&times;</button>
        </div>

        <!-- Body: 2 Kolom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
          <!-- Kolom Kiri: Info Login -->
          <div class="bg-gray-50 border-l-4 border-teal-500 p-4 rounded-md text-sm text-gray-700">
            <p class="font-semibold text-base mb-2">📝 Panduan Login:</p>
            <ul class="list-disc list-inside space-y-2 text-sm">
              <li>Login menggunakan nomor HP yang digunakan saat mendaftar akun.</li>
              <li>Password minimal 8 karakter, wajib kombinasi huruf dan angka.</li>
              <li>Jika akun belum diverifikasi admin, kamu belum bisa login.</li>
              <li>Jika lupa password, hubungi admin atau panitia pendaftaran.</li>
            </ul>
            <div class="mt-4 bg-yellow-100 text-yellow-800 border border-yellow-400 p-3 rounded text-sm">
              ⚠️ Belum punya akun? <strong>Silakan daftar terlebih dahulu.</strong>
            </div>
          </div>

          <!-- Kolom Kanan: Form Login -->
          <form class="space-y-4" action="./user/akun/login/submit_login.php" method="post">
            <div>
              <label class="block font-medium">No HP</label>
              <input type="number" name="nope" required class="w-full p-2 border rounded" pattern="^[0-9]+$"
                title="Nomor HP hanya boleh angka" />
            </div>

            <div>
              <label class="block font-medium">Password</label>
              <div class="relative">
                <input id="passwordInputLogin" type="password" name="password" required
                  class="w-full p-2 border rounded pr-10"
                  minlength="8"
                  pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                  title="Minimal 8 karakter, kombinasi huruf dan angka" />
                <button type="button" id="togglePasswordLogin"
                  class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                  <i data-feather="eye"></i>
                </button>
              </div>
            </div>


            <div class="flex justify-between text-sm">
              <a href="#" class="text-teal-900 hover:underline">Lupa Password?</a>
              <span class="text-red-500 font-semibold">*Wajib daftar akun dulu!</span>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 pt-2">
              <button type="button" data-modal-hide="authentication-modal"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                Batal
              </button>
              <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-teal-600 hover:bg-teal-900 rounded-lg">
                Login Sekarang
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Navbar -->
  <header class="fixed top-0 left-0 w-full bg-white shadow-md z-10">
    <nav class="max-w-7xl mx-auto flex justify-between items-center py-3">
      <!-- Logo dan Nama -->
      <div class="flex items-center">
        <img src="./img/logo-navbar.jpg" alt="logo" class="w-[200px] h-auto">
        <!-- <span class="font-bold text-teal-900 text-lg tracking-wide">YAYASAN BAITUL MUHAJIRIN</span> -->
      </div>

      <!-- Menu Navigasi -->
      <ul class="hidden md:flex items-center space-x-10 font-medium text-lg text-teal-900">
        <li><a href="#beranda" class="hover:text-teal-800 transition">Beranda</a></li>
        <li><a href="#profil" class="hover:text-teal-800 transition">Profil</a></li>
        <li><a href="#unit" class="hover:text-teal-800 transition">Unit</a></li>
        <li><a href="#kontak" class="hover:text-teal-800 transition">Kontak</a></li>
      </ul>

      <!-- Bahasa + Tombol -->
      <div class="flex items-center space-x-4">
        <a
          href="#"
          data-modal-target="pendaftaran-modal"
          data-modal-toggle="pendaftaran-modal"
          class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-medium px-4 py-2 rounded-lg shadow transition">
          <i data-feather="edit-3" class="w-4 h-4"></i> Daftar
        </a>
        <a
          href="#"
          data-modal-target="authentication-modal"
          data-modal-toggle="authentication-modal"
          class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-4 py-2 rounded-lg shadow transition"
          type="button"> <i data-feather="log-in" class="w-4 h-4"></i>Masuk</a>
      </div>
    </nav>
  </header>
  <!-- beranda -->
  <section id="beranda" class="pt-28 pb-20 bg-white">
    <!-- Dekoratif Background (kiri) -->
    <div class="absolute left-0 top-0 h-full w-full bg-no-repeat bg-left bg-contain opacity-10 z-0 pointer-events-none"
      style="background-image: url('./img/bg-3.png');">
    </div>
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h1 class="text-4xl md:text-5xl font-extrabold text-teal-900 mb-4">Yayasan Baitul Muhajirin</h1>
      <p class="text-gray-700 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
        Yayasan Baitul Muhajirin (YBM) adalah lembaga dakwah yang berfokus pada bidang pendidikan agama, pembinaan akhlak, dan tahfidz Al-Qur’an dengan kurikulum salafiyah yang dikemas secara modern.

      </p>
      <a href="./user/ui/cara_pendaftaran.php" class="inline-block mt-3 px-6 py-3 bg-yellow-400 text-teal-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition">
        Tata Cara Daftar
      </a>
    </div>

    <div class="mt-5 relative max-w-7xl mx-auto px-4">
      <!-- Carousel Container -->
      <div class="mt-6 relative overflow-hidden h-[600px] md:h-[450px] rounded-lg shadow-md">
        <div id="carouselImages" class="flex transition-transform duration-700 ease-in-out w-full h-full">
          <img src="./img/bg-beranda.jpeg" alt="Gambar 1" class="w-full h-full flex-shrink-0 object-cover object-center" />
          <img src="./img/bg-beranda2.jpeg" alt="Gambar 2" class="w-full h-full flex-shrink-0 object-cover object-center" />
        </div>
      </div>


    </div>
  </section>
  <!-- Profil -->
  <section
    id="profil"
    class="py-16 bg-gray-100 text-center"
    style="
          background-image: url('img/bg-profil.jpg');
          background-size: cover;
        ">
    <div class="container mx-auto px-6">
      <h3 class="text-3xl font-semibold text-teal-900 mb-4">
        Profil Yayasan
      </h3>
      <p class="text-gray-700 max-w-3xl mx-auto">
        Yayasan Baitul Muhajirin bergerak di bidang pendidikan Islam untuk
        membentuk generasi yang Qur'ani, cerdas, dan berakhlak.
      </p>
      <p class="text-gray-700 max-w-3xl mx-auto">
        Masyarakat mt ka uang dana di masyarakat m Masyarakat mt ka uang
        dana di masyarakat m Masyarakat mt ka uang dana di masyarakat m
        Pmbelajaran awal di bangun oleh bp. Ust. Hasan Sejarah engkap nya
        lada di brosur madrasah , Tanah wakaf , pro kontra untuk membangun
        yayasan . alhamdulilah dari pihak wakaf minta izin buat pendidikan ,
        ahli waris itu mendukung untuk pendidikan di bentuk lah paniyia
        supaya banguna tersebut terwujud . alhamdulillah swasembada
        masyarakat . alahmdulillah sedikit demi seddikit terbangun , walau
        ada sisa tanah tanah yang dibangun terbatas. Kendala kebutuhana
        bermain, murid banyak belum bisa tambah lokasi Tanah wakaf , pro
        kontra untuk membangun yayasan . alhamdulilah dari pihak wakaf minta
        izin buat pendidikan , ahli waris itu mendukung untuk pendidikan di
        bentuk lah paniyia supaya banguna tersebut terwujud . alhamdulillah
        swasembada masyarakat . alahmdulillah sedikit demi seddikit
        terbangun , walau ada sisa tanah tanah yang dibangun terbatas.
        Kendala kebutuhana bermain, murid banyak belum bisa tambah lokasi
        Seandainya masjid dibangun nanti lantai 2 nya dapat digunakan, dari
        masjid tersebut di bangun jembatan ke lantai 2 . buat tambah lokasi
        , awal dibangun agar sampai anak anak kavling tidak acda madrasah
        supaya untuk memenuhi kebutuhan anak 0 anak kavling ini bisa belajar
        mengaji.
      </p>
    </div>
  </section>
  <!-- Unit Pendidikan -->
  <section id="unit" class="py-16 bg-white">
    <div class="container mx-auto px-6">
      <h3 class="text-3xl font-semibold text-center mb-10 text-teal-800">
        Unit Pendidikan
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          class="unit-card bg-teal-100 p-4 rounded shadow hover:bg-teal-200"
          onclick="toggleLessons(this)">
          <h4 class="text-xl font-bold text-teal-900 mb-2">PAUD</h4>
          <p class="text-sm">
            Pendidikan Anak Usia Dini berbasis cinta dan akhlak
          </p>
          <div class="lesson-list mt-3">
            <div class="lesson-card bg-white rounded p-3 shadow">
              <strong>Mata Pelajaran:</strong>
              <ul>
                <li>matematika</li>
                <li>bahasa indonesia</li>
                <li>agama</li>
                <li>praktek ibadah</li>
                <li>olah raga</li>
              </ul>
            </div>
          </div>
        </div>

        <div
          class="unit-card bg-teal-100 p-4 rounded shadow hover:bg-teal-200"
          onclick="toggleLessons(this)">
          <h4 class="text-xl font-bold text-teal-900 mb-2">TK</h4>
          <p class="text-sm">
            Taman Kanak-Kanak dengan kurikulum tematik integratif
          </p>
          <div class="lesson-list mt-3">
            <div class="lesson-card bg-white rounded p-3 shadow">
              <strong>Mata Pelajaran:</strong>
              <ul>
                <li>iqro'</li>
                <li>matematika</li>
                <li>bahasa indonesia</li>
                <li>agama</li>
                <li>bahasa inggris</li>
                <li>mewarnai gambar</li>
                <li>olahraga</li>
              </ul>
            </div>
          </div>
        </div>

        <div
          class="unit-card bg-teal-100 p-4 rounded shadow hover:bg-teal-200"
          onclick="toggleLessons(this)">
          <h4 class="text-xl font-bold text-teal-900 mb-2">TPQ</h4>
          <p class="text-sm">
            Belajar membaca dan menghafal Al-Qur'an dengan metode yang
            menyenangkan
          </p>
          <div class="lesson-list mt-3">
            <div class="lesson-card bg-white rounded p-3 shadow">
              <strong>Mata Pelajaran:</strong>
              <ul>
                <li>berhitung</li>
                <li>bahasa indonesia</li>
                <li>bahasa arab</li>
                <li>hafalan doa dan surat pendek</li>
                <li>kesenian</li>
                <li>praktek ibadah</li>
              </ul>
            </div>
          </div>
        </div>

        <div
          class="unit-card bg-teal-100 p-4 rounded shadow hover:bg-teal-200"
          onclick="toggleLessons(this)">
          <h4 class="text-xl font-bold text-teal-900 mb-2">
            Madrasah Diniyah
          </h4>
          <p class="text-sm">
            Pendidikan agama Islam secara mendalam untuk siswa SD-SMP
          </p>
          <div class="lesson-list mt-3">
            <div class="lesson-card bg-white rounded p-3 shadow">
              <strong>Mata Pelajaran:</strong>
              <ul>
                <li>hisab</li>
                <li>bahasa arab</li>
                <li>hafalan doa</li>
                <li>alqur'an</li>
                <li>imla</li>
                <li>tahaj</li>
                <li>tajwid</li>
                <li>akhlaq</li>
                <li>fiqih</li>
                <li>tareh</li>
                <li>nahwu</li>
                <li>sorof</li>
                <li>hadits</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-16 bg-gray-100 text-center">
    <div class="container mx-auto px-6">
      <h3 class="text-3xl font-semibold text-teal-900 mb-4">Kontak Kami</h3>
      <p class="text-gray-700">
        Alamat: Jl. Wijaya Kusuma Raya Rt.011 Rw.03 Ujung Menteng, Cakung,
        Jakarta Timur 13960
      </p>
      <p class="text-gray-700">HP: 08131841639</p>
      <p class="text-gray-700">WA: 089510224772</p>
      <p class="text-gray-700">No. Izin Operasional: 76/1.851.202.7</p>
    </div>
  </section>

  <!-- WhatsApp Icon -->
  <div class="whatsapp-float">
    <a href="https://wa.me/6289510224772" target="_blank">
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
        alt="WA" />
      Ada pertanyaan? Silakan hubungi kami
    </a>
  </div>

  <!-- Back to Top -->
  <div id="backToTop" class="back-to-top" onclick="scrollToTop()">
    Kembali ke atas
  </div>

  <!-- Footer -->
  <footer class="bg-teal-600 text-white text-center p-4">
    &copy; 2025 Yayasan Baitul Muhajirin. All rights reserved.
  </footer>

  <!-- Modal Info PPDB -->
  <div id="popup-info" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl text-gray-800">
      <!-- Tombol Close -->
      <button onclick="closePopup()" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl">&times;</button>

      <div class="flex flex-col md:flex-row items-center gap-5">
        <!-- Gambar -->
        <img src="./img/logo-yayasan.png" alt="PPDB" class="w-32 h-32 rounded-full object-cover shadow-md">

        <!-- Konten Jadwal -->
        <div class="flex-1">
          <h3 class="text-xl font-bold text-green-700 mb-2">📅 Jadwal Penerimaan Siswa Baru (SPMB)</h3>
          <p class="text-sm text-gray-700 mb-1">
            <strong>Gelombang:</strong> <?= $jadwal['gelombang'] ?? '-' ?>
          </p>
          <p class="text-sm text-teal-700 mb-1">
            📝 <strong>Pendaftaran:</strong><br>
            <?= date('d F Y', strtotime($jadwal['pendaftaran_mulai'])) ?> s.d <?= date('d F Y', strtotime($jadwal['pendaftaran_selesai'])) ?>
          </p>
          <p class="text-sm text-teal-700 mb-2">
            📢 <strong>Pengumuman Hasil:</strong><br>
            <?= date('d F Y', strtotime($jadwal['pengumuman_mulai'])) ?> s.d <?= date('d F Y', strtotime($jadwal['pengumuman_selesai'])) ?>
          </p>

          <!-- Tombol Aksi -->
          <a href="./user/ui/cara_pendaftaran.php" class="mt-2 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow transition">
            Lihat Cara Daftar
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- !JavaScript -->
  <!-- <script src="./js/main.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script>
    // ! Feather Icon
    feather.replace();
    // // ! Navbar Scroll Effect
    // window.addEventListener("scroll", function() {
    //   const navbar = document.getElementById("navbar");
    //   if (window.scrollY > 50) {
    //     navbar.classList.add("bg-teal-900", "bg-opacity-50","shadow-lg");
    //   } else {
    //     navbar.classList.add("bg-teal-900","shadow-lg");
    //   }
    // });

    // ! Form Preview dan Modal
    const modalForm = document.getElementById("pendaftaran-modal");
    const ringkasan = document.getElementById("ringkasanData");
    const form = document.getElementById("pendaftaranForm");
    const preview = document.getElementById("previewData");
    const finalForm = document.getElementById("submitFinal");

    // ! Tamppilan bukti pendaftaran
    function tampilkanBuktiPendaftaran() {
      const nama = document.querySelector('input[name="nama"]').value;
      const nope = document.querySelector('input[name="nope"]').value;
      const tglLahir = new Date(document.querySelector('input[name="tglLahir"]').value);
      const password = document.querySelector('input[name="password"]').value;
      const buktiFile = document.querySelector('input[name="bukti_transfer"]').files[0];

      const formatTanggal = tgl => {
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return `${tgl.getDate()} ${bulan[tgl.getMonth()]} ${tgl.getFullYear()}`;
      };

      const reader = new FileReader();
      reader.onload = function(e) {
        const htmlPreview = `
      <p><strong>Nama Lengkap:</strong> ${nama}</p>
      <p><strong>No. HP:</strong> ${nope}</p>
      <p><strong>Tanggal Lahir:</strong> ${formatTanggal(tglLahir)}</p>
      <p><strong>Password:</strong> ${'*'.repeat(password.length)}</p>
      <p><strong>Tanggal Pendaftaran:</strong> ${formatTanggal(new Date())}</p>
      <p><strong>Bukti Transfer:</strong></p>
      <img src="${e.target.result}" class="w-40 border rounded shadow mb-2">
      <p class="mt-2 text-xs italic text-gray-600">Bukti ini sah dikeluarkan oleh sistem pendaftaran Yayasan.</p>
    `;

        document.getElementById('previewOutput').innerHTML = htmlPreview;
        document.getElementById('buktiPendaftaran').classList.remove('hidden');
      };
      reader.readAsDataURL(buktiFile);
    }

    function closePreview() {
      document.getElementById('buktiPendaftaran').classList.add('hidden');
    }

    function downloadPDF() {
      const element = document.getElementById('buktiContent');
      html2pdf().from(element).save('Bukti-Pendaftaran.pdf');
    }
    // ! Validasi Password & No HP
    form.addEventListener("submit", function(e) {
      const passwordInput = document.querySelector('input[name="password"]');
      const nopeInput = document.querySelector('input[name="nope"]');
      const password = passwordInput.value;
      const nope = nopeInput.value;

      const passwordValid = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password);
      const nopeValid = /^\d+$/.test(nope);

      let errors = [];

      if (!passwordValid) {
        errors.push(
          "Password minimal 8 karakter dan harus mengandung huruf & angka."
        );
      }

      if (!nopeValid) {
        errors.push("Nomor HP hanya boleh mengandung angka.");
      }

      if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
      }
    });

    // ! Eye password : Fungsi untuk toggle password
    function setupToggle(inputId, toggleId) {
      const input = document.getElementById(inputId);
      const toggle = document.getElementById(toggleId);
      let visible = false;

      toggle.addEventListener('click', () => {
        visible = !visible;
        input.type = visible ? 'text' : 'password';
        toggle.innerHTML = `<i data-feather="${visible ? 'eye-off' : 'eye'}"></i>`;
        feather.replace();
      });
    }
    // Panggil untuk masing-masing input
    setupToggle('passwordInputLogin', 'togglePasswordLogin');
    setupToggle('passwordInputDaftar', 'togglePasswordDaftar');

    // ! Salin nomor rekening
    function copyRekening() {
      const nomor = document.getElementById("noRek").textContent;
      navigator.clipboard.writeText(nomor).then(() => {
        alert("Nomor rekening disalin: " + nomor);
      });
    }
    // ! preview Bukti Transfer
    function previewBuktiTransfer(event) {
      const file = event.target.files[0];
      const fileInfo = document.getElementById('fileInfo');
      const fileLink = document.getElementById('fileLink');
      const filePreview = document.getElementById('filePreview');
      if (!file) {
        fileInfo.classList.add('hidden');
        filePreview.innerHTML = '';
        return;
      }
      const url = URL.createObjectURL(file);
      // Tampilkan nama file sebagai link
      fileLink.href = url;
      fileLink.textContent = file.name;
      fileInfo.classList.remove('hidden');
      // Preview untuk gambar
      if (file.type.startsWith('image/')) {
        filePreview.innerHTML = `<img src="${url}" class="max-h-64 rounded border" />`;
      }
      // Preview untuk PDF
      else if (file.type === 'application/pdf') {
        filePreview.innerHTML = `<embed src="${url}" type="application/pdf" width="100%" height="400px" class="border rounded"/>`;
      } else {
        filePreview.innerHTML = `<p class="text-red-600 text-sm">File tidak bisa ditampilkan.</p>`;
      }
    }
    // ! Bg carousel
    const carousel = document.getElementById("carouselImages");
    const slides = carousel.children;
    let current = 0;

    setInterval(() => {
      current = (current + 1) % slides.length;
      carousel.style.transform = `translateX(-${current * 100}%)`;
    }, 4000); // ganti tiap 4 detik


    // ! Tampilkan popup otomatis saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
      document.getElementById('popup-info').classList.remove('hidden');
    });

    function closePopup() { // Fungsi untuk menutup popup
      document.getElementById('popup-info').classList.add('hidden');
    }
  </script>




</body>

</html>
</DOCTYPE>