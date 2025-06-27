<?php
session_start();

// Koneksi database
$conn = new mysqli("localhost", "root", "", "yayasan_almuhajirin_db");
if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Koneksi database gagal: ' . $conn->connect_error
    ]));
}
// Karena gak pake session lagi:
$conn->query("UPDATE pendaftar SET status = 'diterima' WHERE id_pendaftar = 1");

// $id_pendaftar = 1; // Default
$id_pendaftar = $_SESSION['user_id'] ?? null;
// id ppendaftar
if (!$id_pendaftar) {
  echo "<script>alert('Session hilang. Silakan login ulang.'); window.location.href='../../../index.php';</script>";
  exit;
}
$id_admin = 1;     // Default

$stmt = $conn->prepare("INSERT INTO siswa (
    id_pendaftar, id_admin, nama_lengkap, nama_panggilan, tempat_tgl_lahir, 
    jenis_kelamin, agama, anak_ke, jumlah_saudara, status_keluarga, alamat
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "iisssssiiss", // 2 integer pertama
    $id_pendaftar,
    $id_admin,
    $_POST['full_name'],
    $_POST['nickname'],
    $_POST['birth'],
    $_POST['gender'],
    $_POST['religion'],
    $_POST['child_order'],
    $_POST['siblings'],
    $_POST['family_status'],
    $_POST['address']
);


if (!$stmt->execute()) {
    throw new Exception("Gagal menyimpan data siswa: " . $stmt->error);
}

$id_siswa = $conn->insert_id;

// 2. Insert data ayah - SESUAIKAN DENGAN TABEL ayah_siswa
$stmt_ayah = $conn->prepare("INSERT INTO ayah_siswa (
        id_siswa, nama_ayah, tempat_tgl_lahir_ayah, agama_ayah, 
        pekerjaan_ayah, pendidikan_ayah, alamat_ayah, nope_ayah
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt_ayah->bind_param(
    "isssssss",
    $id_siswa,
    $_POST['father_name'],
    $_POST['father_birthplace'],
    $_POST['father_religion'],
    $_POST['father_job'],
    $_POST['father_education'],
    $_POST['father_address'],
    $_POST['father_phone']
);
$stmt_ayah->execute();

// 3. Insert data ibu - SESUAIKAN DENGAN TABEL ibu_siswa
$stmt_ibu = $conn->prepare("INSERT INTO ibu_siswa (
        id_siswa, nama_ibu, tempat_tgl_lahir_ibu, agama_ibu,
        pekerjaan_ibu, pendidikan_ibu, alamat_ibu, nope_ibu
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt_ibu->bind_param(
    "isssssss",
    $id_siswa,
    $_POST['mother_name'],
    $_POST['mother_birthplace'],
    $_POST['mother_religion'],
    $_POST['mother_job'],
    $_POST['mother_education'],
    $_POST['mother_address'],
    $_POST['mother_phone']
);
$stmt_ibu->execute();

// 4. Upload file
function uploadFile($name)
{
    if (!empty($_FILES[$name]['name'])) {
        $folder = "uploads/";
        $filename = time() . "_" . basename($_FILES[$name]['name']);
        $target = $folder . $filename;

        if (move_uploaded_file($_FILES[$name]['tmp_name'], $target)) {
            return $target;
        }
    }
    return null;
}

$kk = uploadFile('kk');
$akte = uploadFile('akte');
$ktp = uploadFile('ktp');
$foto = uploadFile('foto');
$bukti_bayar = uploadFile('bukti_bayar');

// 5. Insert data berkas - SESUAIKAN DENGAN TABEL berkas_siswa
$stmt_berkas = $conn->prepare("INSERT INTO berkas_siswa (
        id_siswa, kk, akta_kelahiran, ktp_ortu
    ) VALUES (?, ?, ?, ?)");

$stmt_berkas->bind_param(
    "isss",
    $id_siswa,
    $kk,
    $akte,
    $ktp
);
$stmt_berkas->execute();

// 6. Update bukti pembayaran di tabel siswa
if ($bukti_bayar) {
    $conn->query("UPDATE siswa SET bukti_pembayaran = '$bukti_bayar' WHERE id_siswa = $id_siswa");
}

// 7. Update status pendaftar
$conn->query("UPDATE pendaftar SET status = 'diterima' WHERE id_pendaftar = " . $_SESSION['user_id']);

// Redirect ke halaman cetak
header("Location: info_hasil.php?id_siswa=" . $id_siswa);
exit;
?>
