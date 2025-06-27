<?php
require_once __DIR__ . '/vendor/autoload.php';

$conn = new mysqli("localhost", "root", "", "yayasan_almuhajirin_db");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$id_siswa = isset($_GET['id_siswa']) ? intval($_GET['id_siswa']) : 0;
if ($id_siswa <= 0) die("ID tidak valid.");

// Ambil data
$siswa = $conn->query("SELECT * FROM siswa WHERE id_siswa = $id_siswa")->fetch_assoc();

// Ambil data
$siswa = $conn->query("SELECT * FROM siswa WHERE id_siswa = $id_siswa")->fetch_assoc();
$ayah = $conn->query("SELECT * FROM ayah_siswa WHERE id_siswa = $id_siswa")->fetch_assoc();
$ibu = $conn->query("SELECT * FROM ibu_siswa WHERE id_siswa = $id_siswa")->fetch_assoc();
$berkas = $conn->query("SELECT * FROM berkas_siswa WHERE id_siswa = $id_siswa")->fetch_assoc();

// Generate HTML
$html = '
<h1 style="text-align:center;">Formulir Pendaftaran</h1>

<h2>Data Siswa</h2>
<table border="1" cellpadding="6" cellspacing="0">
<tr><td>Nama Lengkap</td><td>' . htmlspecialchars($siswa['nama_lengkap']) . '</td></tr>
<tr><td>Nama Panggilan</td><td>' . htmlspecialchars($siswa['nama_panggilan']) . '</td></tr>
<tr><td>Tempat & Tanggal Lahir</td><td>' . htmlspecialchars($siswa['tempat_tgl_lahir']) . '</td></tr>
<tr><td>Jenis Kelamin</td><td>' . htmlspecialchars($siswa['jenis_kelamin']) . '</td></tr>
<tr><td>Agama</td><td>' . htmlspecialchars($siswa['agama']) . '</td></tr>
<tr><td>Anak Ke</td><td>' . htmlspecialchars($siswa['anak_ke']) . '</td></tr>
<tr><td>Jumlah Saudara</td><td>' . htmlspecialchars($siswa['jumlah_saudara']) . '</td></tr>
<tr><td>Status Keluarga</td><td>' . htmlspecialchars($siswa['status_keluarga']) . '</td></tr>
<tr><td>Alamat</td><td>' . htmlspecialchars($siswa['alamat']) . '</td></tr>
</table>

<h2>Data Ayah</h2>
<table border="1" cellpadding="6" cellspacing="0">
<tr><td>Nama Ayah</td><td>' . htmlspecialchars($ayah['nama_ayah']) . '</td></tr>
<tr><td>Tempat & Tgl Lahir</td><td>' . htmlspecialchars($ayah['tempat_tgl_lahir_ayah']) . '</td></tr>
<tr><td>Agama</td><td>' . htmlspecialchars($ayah['agama_ayah']) . '</td></tr>
<tr><td>Pekerjaan</td><td>' . htmlspecialchars($ayah['pekerjaan_ayah']) . '</td></tr>
<tr><td>Pendidikan</td><td>' . htmlspecialchars($ayah['pendidikan_ayah']) . '</td></tr>
<tr><td>Alamat</td><td>' . htmlspecialchars($ayah['alamat_ayah']) . '</td></tr>
<tr><td>No. HP</td><td>' . htmlspecialchars($ayah['nope_ayah']) . '</td></tr>
</table>

<h2>Data Ibu</h2>
<table border="1" cellpadding="6" cellspacing="0">
<tr><td>Nama Ibu</td><td>' . htmlspecialchars($ibu['nama_ibu']) . '</td></tr>
<tr><td>Tempat & Tgl Lahir</td><td>' . htmlspecialchars($ibu['tempat_tgl_lahir_ibu']) . '</td></tr>
<tr><td>Agama</td><td>' . htmlspecialchars($ibu['agama_ibu']) . '</td></tr>
<tr><td>Pekerjaan</td><td>' . htmlspecialchars($ibu['pekerjaan_ibu']) . '</td></tr>
<tr><td>Pendidikan</td><td>' . htmlspecialchars($ibu['pendidikan_ibu']) . '</td></tr>
<tr><td>Alamat</td><td>' . htmlspecialchars($ibu['alamat_ibu']) . '</td></tr>
<tr><td>No. HP</td><td>' . htmlspecialchars($ibu['nope_ibu']) . '</td></tr>
</table>

<h2>Status Berkas</h2>
<table border="1" cellpadding="6" cellspacing="0">
<tr><td>Kartu Keluarga</td><td>' . ($berkas['kk'] ? '✅ Ada' : '❌ Kosong') . '</td></tr>
<tr><td>Akta Kelahiran</td><td>' . ($berkas['akta_kelahiran'] ? '✅ Ada' : '❌ Kosong') . '</td></tr>
<tr><td>KTP Orang Tua</td><td>' . ($berkas['ktp_ortu'] ? '✅ Ada' : '❌ Kosong') . '</td></tr>
<tr><td>Bukti Pembayaran</td><td>' . ($siswa['bukti_pembayaran'] ? '✅ Ada' : '❌ Kosong') . '</td></tr>
</table>

<p style="margin-top:30px;">Dicetak pada: ' . date('d-m-Y H:i:s') . '</p>
';

// bikin objek mPDF
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

// tulis HTML-nya ke PDF
$mpdf->WriteHTML($html);

// langsung download (pakai constant biar jelas)
$mpdf->Output(
  'Formulir_Pendaftaran_' . preg_replace("/[^a-zA-Z0-9]/", "_", $siswa['nama_lengkap']) . '.pdf',
  \Mpdf\Output\Destination::DOWNLOAD
);

exit;