<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tata Cara Pendaftaran - Yayasan Baitul Muhajirin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="../../img/logo-yayasan.ico" />
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-white-100 text-gray-800">
  <!-- Modal Pendaftaran Akun -->
  <div id="pendaftaran-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative w-full max-w-4xl mx-auto p-4">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-teal-600 px-6 py-4 flex justify-between items-center">
          <h3 class="text-xl font-bold text-white">Form Pendaftaran Akun</h3>
          <button data-modal-hide="pendaftaran-modal" class="text-white text-2xl leading-none">&times;</button>
        </div>

        <!-- Body: Dua Kolom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
          <!-- Kolom Kiri: Tata Cara -->
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

          <!-- Kolom Kanan: Form -->
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


            <!-- Info Transfer -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded-md text-sm">
              <p class="mb-1">💸 Transfer ke:</p>
              <div class="flex items-center justify-between bg-white border px-3 py-2 rounded">
                <span><strong>BNI</strong> - <span id="noRek">3657788876</span><br />a.n. Yayasan Baitul Muhajirin</span>
                <button type="button" onclick="copyRekening()" class="text-blue-600 hover:underline text-sm">📋 Salin</button>
              </div>
            </div>

            <!-- Upload Bukti -->
            <div>
              <label class="block font-medium">Upload Bukti Transfer</label>
              <input type="file" name="bukti_transfer" accept="image/*,.pdf" required
                class="w-full p-2 border rounded" />
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 pt-2">
              <button type="button" data-modal-hide="pendaftaran-modal"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                Batal
              </button>
              <button type="submit"
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


  <!-- ✅ Navbar -->
  <header class="fixed top-0 left-0 w-full bg-white shadow-md z-10">
    <nav class="max-w-7xl mx-auto flex justify-between items-center py-3">
      <!-- Logo dan Nama -->
      <div class="flex items-center">
        <img src="../../img/logo-navbar.jpg" alt="logo" class="w-[200px] h-auto">
        <!-- <span class="font-bold text-teal-900 text-lg tracking-wide">YAYASAN BAITUL MUHAJIRIN</span> -->
      </div>

      <!-- Menu Navigasi -->
      <ul class="hidden md:flex items-center space-x-10 font-medium text-lg text-teal-900">
        <li><a href="../../index.php" class="hover:text-teal-800 transition">Beranda</a></li>
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

  <!-- background dekoratif -->
  <div class="absolute left-0 top-0 h-full w-full bg-no-repeat bg-left bg-contain opacity-10 z-0 pointer-events-none"
    style="background-image: url('../../img/bg-1.png');">
  </div>
  <!-- isi konten -->
  <section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-start">

      <!-- 🟢 Langkah 1: Pendaftaran Akun -->
      <div class="bg-white py-10 px-6 md:px-10 border border-teal-200 rounded-lg shadow-sm">
        <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-6 flex items-center gap-2">
          <i data-feather="user-plus" class="text-teal-600"></i> Langkah 1: Pendaftaran Akun
        </h2>

        <ol class="list-decimal pl-5 space-y-5 text-gray-800 text-sm md:text-base leading-relaxed">
          <li><strong>Isi Formulir Akun:</strong> Klik tombol <span class="text-teal-600 font-semibold">Daftar</span> di halaman beranda, lalu lengkapi data nama, nomor HP, tanggal lahir, dan password.</li>

          <li><strong>Gunakan Nomor HP Aktif:</strong> Nomor HP akan digunakan sebagai akun login dan penerima notifikasi.</li>

          <li>
            <strong>Transfer Biaya Pendaftaran:</strong> Transfer sebesar <span class="text-red-600 font-semibold">Rp 70.000</span> ke rekening resmi yayasan.
            <p class="text-red-600 text-sm font-semibold mt-1 ml-4">*Biaya ini menggantikan biaya pembelian formulir fisik.</p>

            <div class="bg-gray-100 border border-gray-300 rounded-md px-4 py-2 mt-2 ml-4 text-sm leading-relaxed">
              <strong>BNI</strong> - 3657788876<br />
              a.n. Yayasan Baitul Muhajirin
            </div>
          </li>

          <li><strong>Upload Bukti Transfer:</strong> Setelah melakukan pembayaran, upload bukti transfer di formulir pendaftaran akun.</li>

          <li><strong>Tunggu Verifikasi Admin:</strong> Admin akan memverifikasi data dan bukti transfer dalam waktu maksimal 1x24 jam.</li>

          <li><strong>Notifikasi Hasil:</strong> Kamu akan mendapatkan notifikasi melalui WhatsApp atau SMS jika akun sudah diverifikasi.</li>
        </ol>
      </div>

      <!-- 🟢 Langkah 2: Pengisian Formulir Pendaftaran Siswa -->
      <div class="bg-gray-50 py-10 px-6 md:px-10 border border-gray-200 rounded-lg shadow-sm">
        <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-6 flex items-center gap-2">
          <i data-feather="file-text" class="text-teal-600"></i> Langkah 2: Pengisian Formulir Siswa
        </h2>

        <ol class="list-decimal pl-5 space-y-5 text-gray-800 text-sm md:text-base leading-relaxed">
          <p class="text-red-600 font-semibold mt-1">*Login ke Akun terlebih dahulu: Gunakan <strong>nomor HP</strong> dan <strong>password</strong> yang telah diverifikasi untuk masuk ke sistem.</p>

          <li><strong>Isi Data Siswa:</strong> Lengkapi seluruh informasi seperti nama lengkap, tempat tanggal lahir, jenis kelamin, agama, jumlah saudara, dan status keluarga.</li>

          <li><strong>Isi Data Orang Tua:</strong> Masukkan informasi ayah dan ibu/wali, termasuk nama, pekerjaan, pendidikan, alamat, dan nomor telepon.</li>

          <li><strong>Upload Dokumen:</strong> Siapkan dan unggah dokumen berikut:
            <ul class="list-disc ml-6 mt-2 text-sm">
              <li>Scan Kartu Keluarga (KK)</li>
              <li>Scan Akta Kelahiran</li>
              <li>Scan KTP Orang Tua/Wali</li>
              <li>Pas Foto (latar merah/biru)</li>
            </ul>
          </li>

          <li><strong>Upload Bukti Pembayaran:</strong> Bukti transfer biaya awal pendidikan yang ditentukan (jika ada tahap lanjutan).</li>

          <li><strong>Submit Formulir:</strong> Setelah semua data diisi dan dicek, klik tombol “Kirim” untuk menyelesaikan proses pendaftaran.</li>
        </ol>
      </div>
    </div>

    <!-- 🎥 Video Panduan -->
    <div class="max-w-6xl mx-auto px-4 py-12">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">🎥 Video Panduan Pendaftaran</h2>
      <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-lg">
        <iframe class="w-full h-full" src="https://www.youtube.com/embed/VIDEOKAMU"
          title="Panduan Pendaftaran Akun" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </section>



  <!-- Footer -->
  <footer class="text-center text-sm py-6 text-gray-500">
    &copy; 2025 Yayasan Baitul Muhajirin. All rights reserved.
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

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

    // ! Button Back to Top
    function scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    }
    window.addEventListener("scroll", function() {
      const btn = document.getElementById("backToTop");
      btn.style.display = window.scrollY > 200 ? "block" : "none";
    });

    // ! Form Preview dan Modal
    const modalForm = document.getElementById("pendaftaran-modal");
    const ringkasan = document.getElementById("ringkasanData");
    const form = document.getElementById("pendaftaranForm");
    const preview = document.getElementById("previewData");
    const finalForm = document.getElementById("submitFinal");

    // Buka modal ketika link diklik
    document
      .querySelector('a[href="daftar_akun.php"]')
      ?.addEventListener("click", (e) => {
        e.preventDefault();
        modalForm.classList.remove("hidden");
      });

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

    // ! Tombol kembali ke form dari preview
    function kembaliKeForm() {
      ringkasan.classList.add("hidden");
      modalForm.classList.remove("hidden");
    }

    // ! Salin nomor rekening
    function copyRekening() {
      const nomor = document.getElementById("noRek").textContent;
      navigator.clipboard.writeText(nomor).then(() => {
        alert("Nomor rekening disalin: " + nomor);
      });
    }
    // ! Bg carousel
    const carousel = document.getElementById("carouselImages");
    const slides = carousel.children;
    let current = 0;

    setInterval(() => {
      current = (current + 1) % slides.length;
      carousel.style.transform = `translateX(-${current * 100}%)`;
    }, 4000); // ganti tiap 4 detik


    // Tampilkan popup otomatis saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
      document.getElementById('popup-info').classList.remove('hidden');
    });

    // Fungsi untuk menutup popup
    function closePopup() {
      document.getElementById('popup-info').classList.add('hidden');
    }
  </script>
</body>

</html>