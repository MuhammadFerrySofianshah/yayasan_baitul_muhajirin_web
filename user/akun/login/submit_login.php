<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'yayasan_almuhajirin_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nope = $_POST['nope'];
$password = $_POST['password'];

// Cek user di database
$query = "SELECT * FROM pendaftar WHERE nope = '$nope'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Cek status akun
    if ($user['status'] == 'pending') {
        echo "<script>alert('Akun belum diverifikasi oleh admin.'); window.location.href='../../../index.php';</script>";
        exit;
    }
    if ($user['status'] == 'ditolak') {
        echo "<script>alert('Akun ditolak oleh admin.'); window.location.href='../../../index.php';</script>";
        exit;
    }
}

// Cek password
if (password_verify($password, $user['password'])) {
    // ✅ Set semua session yang kamu perlukan
    $_SESSION['id_pendaftar']   = $user['id_pendaftar']; // <--- ini penting buat status siswa
    $_SESSION['user_id']        = $user['id_pendaftar'];
    $_SESSION['nope']           = $user['nope'];
    $_SESSION['nama_lengkap']   = $user['nama'];
    $_SESSION['tanggal_lahir']  = $user['tglLahir'];


    header("Location: ../../dashboard/beranda/beranda_user.php");
    exit;
} else {
    echo "<script>alert('Password salah.'); window.location.href='../../../index.php';</script>";
    exit;
}
