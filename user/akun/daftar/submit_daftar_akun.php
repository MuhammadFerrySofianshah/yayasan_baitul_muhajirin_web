<?php
// ! 1. Connect DB
include '../../../connect/connect.php' ;

$nama = $_POST['nama'];
$nope = $_POST['nope'];
$tglLahir = $_POST['tglLahir'];
$password = $_POST['password'];

// ! 2. Bagian Daftar Akun
// ? Cek apakah nomor HP sudah digunakan
$cekNope = $conn->prepare("SELECT 1 FROM pendaftar WHERE nope = ?");
$cekNope->bind_param("s", $nope);
$cekNope->execute();
$cekNope->store_result();

if ($cekNope->num_rows > 0) {
    echo "<script>alert('Nomor HP sudah terdaftar. Gunakan nomor lain!'); window.history.back();</script>";
    exit();
}

// ? Batas min/max field no hp
if (!preg_match('/^[0-9]{10,13}$/', $nope)) {
    echo "<script>alert('Nomor HP harus antara 10 sampai 13 angka.'); window.history.back();</script>";
    exit();
}

// ? Hash password biar aman
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ? Upload file bukti
$uploadDir = "../../../admin/uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Auto bikin folder kalau belum ada
}

$buktiName = time() . "_" . basename($_FILES["bukti_transfer"]["name"]);
$buktiPath = $uploadDir . $buktiName;

// ? Cek tipe file
$allowedTypes = ['image/jpg','image/jpeg', 'image/png', 'application/pdf'];
if (!in_array($_FILES['bukti_transfer']['type'], $allowedTypes)) {
    die("Format file tidak diizinkan!");
}

// ? Upload file
if (!move_uploaded_file($_FILES["bukti_transfer"]["tmp_name"], $buktiPath)) {
    die("Upload file gagal.");
}

// ? Simpan ke DB
$stmt = $conn->prepare("INSERT INTO pendaftar (nama, nope, tglLahir, password, bukti_byPendaftar) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nama, $nope, $tglLahir, $hashedPassword, $buktiPath);

if ($stmt->execute()) {
    header("Location: bukti_daftar.php?nope=" . urlencode($nope));
    exit();
} else {
    header('Location: gagal.html');
    exit();
}
