<!-- 1. Modal Pendaftaran Akun -->
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
                    action="./akun/daftar/submit_daftar_akun.php" class="space-y-4">
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

<!-- ! 2. Hasil Preview Daftar -->
<div
    id="ringkasanData"
    class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center flex">
    <div class="bg-white p-6 rounded-lg max-w-lg w-full shadow-lg">
        <h2 class="text-xl font-bold mb-4 text-teal-900">
            Konfirmasi Pendaftaran
        </h2>

        <!-- Data Ringkasan -->
        <div id="previewData" class="mb-4 text-gray-800"></div>

        <!-- Info Transfer -->
        <div
            class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md text-sm text-gray-700 relative">
            <p class="mb-2">
                💡 Silakan transfer biaya pendaftaran sebesar
                <strong class="text-red-600">Rp 70.000</strong> ke:
            </p>
            <div
                class="flex items-center justify-between bg-white border rounded-md px-3 py-2">
                <span>
                    <strong>BNI</strong> - <span id="noRek">3657788876</span><br />
                    a.n. Yayasan Baitul Muhajirin
                </span>
                <button
                    onclick="copyRekening()"
                    class="ml-2 text-blue-600 hover:underline text-sm">
                    📋 Salin
                </button>
            </div>
        </div>

        <!-- Upload Bukti Transfer -->
        <form
            id="submitFinal"
            action="../akun/daftar/submit_daftar_akun.php"
            method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="nama" />
            <input type="hidden" name="nope" />
            <input type="hidden" name="tglLahir" />
            <input type="hidden" name="password" />

            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Upload Bukti Transfer:</label>
                <input
                    type="file"
                    name="bukti_transfer"
                    accept="image/*,.pdf"
                    required
                    class="w-full p-2 border rounded" />
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between gap-4">
                <button
                    type="button"
                    onclick="kembaliKeForm()"
                    class="flex-1 bg-gray-200 text-gray-800 py-2 rounded hover:bg-gray-300 font-medium transition">
                    Kembali
                </button>
                <button
                    type="submit"
                    class="flex-1 bg-teal-500 text-white py-2 rounded hover:bg-teal-600 font-semibold transition">
                    Konfirmasi Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 3. Modal Login User -->
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
<!-- navbar.php -->
<header class="fixed top-0 left-0 w-full bg-white shadow-md z-10">
    <nav class="max-w-7xl mx-auto flex justify-between items-center py-3">
        <!-- Logo dan Nama -->
        <div class="flex items-center">
            <img src="./img/logo-yayasan.png" alt="logo" class="w-20 h-auto">
            <span class="font-bold text-teal-900 text-lg tracking-wide">YAYASAN BAITUL MUHAJIRIN</span>
        </div>

        <!-- Menu Navigasi -->
        <ul class="hidden md:flex items-center space-x-10 font-medium text-lg text-teal-900">
            <li><a href="#beranda" class="hover:text-teal-800 transition">Beranda</a></li>
            <li><a href="#profil" class="hover:text-teal-800 transition">Profil</a></li>
            <li><a href="#unit" class="hover:text-teal-800 transition">Unit</a></li>
            <li><a href="#kontak" class="hover:text-teal-800 transition">Kontak</a></li>
        </ul>

        <!-- Tombol -->
        <div class="flex items-center space-x-4">
            <a href="#" data-modal-target="pendaftaran-modal" data-modal-toggle="pendaftaran-modal"
                class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-medium px-4 py-2 rounded-lg shadow transition">
                <i data-feather="edit-3" class="w-4 h-4"></i> Daftar
            </a>
            <a href="#" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-4 py-2 rounded-lg shadow transition">
                <i data-feather="log-in" class="w-4 h-4"></i>Masuk
            </a>
        </div>
    </nav>
</header>