<?php
include '../../../connect/connect.php';



$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) die("ID tidak valid.");

// Ambil data utama
$siswa = $conn->query("SELECT * FROM siswa WHERE id_siswa = $id")->fetch_assoc();
$ayah = $conn->query("SELECT * FROM ayah_siswa WHERE id_siswa = $id")->fetch_assoc();
$ibu = $conn->query("SELECT * FROM ibu_siswa WHERE id_siswa = $id")->fetch_assoc();
$berkas = $conn->query("SELECT * FROM berkas_siswa WHERE id_siswa = $id")->fetch_assoc();

function val($array, $key)
{
    return isset($array[$key]) && $array[$key] !== '' ? htmlspecialchars($array[$key]) : '-';
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Detail Siswa</h1>
        <!-- Data Siswa -->
        <h2 class="text-lg font-semibold mt-4">Data Siswa</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Nama Lengkap:</strong> <?= val($siswa, 'nama_lengkap') ?></p>
            <p><strong>Nama Panggilan:</strong> <?= val($siswa, 'nama_panggilan') ?></p>
            <p><strong>Tempat Tanggal Lahir:</strong> <?= val($siswa, 'tempat_tgl_lahir') ?></p>
            <p><strong>Jenis Kelamin:</strong> <?= val($siswa, 'jenis_kelamin') ?></p>
            <p><strong>Agama:</strong> <?= val($siswa, 'agama') ?></p>
            <p><strong>Anak Ke:</strong> <?= val($siswa, 'anak_ke') ?></p>
            <p><strong>Jumlah Saudara:</strong> <?= val($siswa, 'jumlah_saudara') ?></p>
            <p><strong>Status Keluarga:</strong> <?= val($siswa, 'status_keluarga') ?></p>
            <p><strong>Alamat:</strong> <?= val($siswa, 'alamat') ?></p>
            <!-- Jika ingin menampilkan status dari tabel status -->
            <p><strong>Status Verifikasi:</strong> <span class="font-semibold <?= $currentStatus === 'diterima' ? 'text-green-600' : ($currentStatus === 'ditolak' ? 'text-red-600' : 'text-yellow-600') ?>">
                    <?= $currentStatus ?>
                </span></p>
        </div>

        <h2 class="text-lg font-semibold mt-6">Data Ayah</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Nama:</strong> <?= val($ayah, 'nama_ayah') ?></p>
            <p><strong>TTL:</strong> <?= val($ayah, 'tempat_tgl_lahir_ayah') ?></p>
            <p><strong>Agama:</strong> <?= val($ayah, 'agama_ayah') ?></p>
            <p><strong>Pekerjaan:</strong> <?= val($ayah, 'pekerjaan_ayah') ?></p>
            <p><strong>Pendidikan:</strong> <?= val($ayah, 'pendidikan_ayah') ?></p>
            <p><strong>Alamat:</strong> <?= val($ayah, 'alamat_ayah') ?></p>
            <p><strong>No HP:</strong> <?= val($ayah, 'nope_ayah') ?></p>
        </div>

        <h2 class="text-lg font-semibold mt-6">Data Ibu</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Nama:</strong> <?= val($ibu, 'nama_ibu') ?></p>
            <p><strong>TTL:</strong> <?= val($ibu, 'tempat_tgl_lahir_ibu') ?></p>
            <p><strong>Agama:</strong> <?= val($ibu, 'agama_ibu') ?></p>
            <p><strong>Pekerjaan:</strong> <?= val($ibu, 'pekerjaan_ibu') ?></p>
            <p><strong>Pendidikan:</strong> <?= val($ibu, 'pendidikan_ibu') ?></p>
            <p><strong>Alamat:</strong> <?= val($ibu, 'alamat_ibu') ?></p>
            <p><strong>No HP:</strong> <?= val($ibu, 'nope_ibu') ?></p>
        </div>

        <h2 class="text-lg font-semibold mt-6">Berkas</h2>
        <div class="grid grid-cols-1 gap-2">
            <p><strong>Kartu Keluarga:</strong> <?= !empty($berkas['kk']) ? "<a href='{$berkas['kk']}' class='text-blue-600 underline' target='_blank'>Lihat KK</a>" : '-' ?></p>
            <p><strong>Akta Kelahiran:</strong> <?= !empty($berkas['akta_kelahiran']) ? "<a href='{$berkas['akta_kelahiran']}' class='text-blue-600 underline' target='_blank'>Lihat Akta</a>" : '-' ?></p>
            <p><strong>KTP Ortu:</strong> <?= !empty($berkas['ktp_ortu']) ? "<a href='{$berkas['ktp_ortu']}' class='text-blue-600 underline' target='_blank'>Lihat KTP</a>" : '-' ?></p>
            <p><strong>Bukti Pembayaran:</strong> <?= !empty($siswa['bukti_pembayaran']) ? "<a href='{$siswa['bukti_pembayaran']}' class='text-blue-600 underline' target='_blank'>Lihat Bukti</a>" : '-' ?></p>
        </div>

        <a href="data_pendaftar_formulir.php" class="mt-6 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Kembali</a>
    </div>
</body>

</html>