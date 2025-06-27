<?php
$conn = new mysqli("localhost", "root", "", "yayasan_almuhajirin");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_POST['id'];

// Update siswa
$conn->query("UPDATE siswa SET
    full_name = '$_POST[full_name]',
    nickname = '$_POST[nickname]',
    birth = '$_POST[birth]',
    gender = '$_POST[gender]',
    address = '$_POST[address]'
    WHERE id = $id
");

// Update ayah
$conn->query("UPDATE ayah SET
    name = '$_POST[father_name]'
    WHERE siswa_id = $id
");

// Update ibu
$conn->query("UPDATE ibu SET
    name = '$_POST[mother_name]'
    WHERE siswa_id = $id
");

// Update file (jika ada)
function updateFile($input, $oldFilePath) {
    if (!empty($_FILES[$input]['name'])) {
        $target = "uploads/" . time() . "_" . basename($_FILES[$input]['name']);
        move_uploaded_file($_FILES[$input]['tmp_name'], $target);
        return $target;
    }
    return $oldFilePath;
}

// Ambil data berkas lama
$berkas = $conn->query("SELECT * FROM berkas WHERE siswa_id = $id")->fetch_assoc();
$kk = updateFile("kk", $berkas['kk']);
$akte = updateFile("akte", $berkas['akte']);
$ktp = updateFile("ktp", $berkas['ktp']);
$foto = updateFile("foto", $berkas['foto']);
$bukti_bayar = updateFile("bukti_bayar", $berkas['bukti_bayar']);

$conn->query("UPDATE berkas SET
    kk = '$kk',
    akte = '$akte',
    ktp = '$ktp',
    foto = '$foto',
    bukti_bayar = '$bukti_bayar'
    WHERE siswa_id = $id
");

echo "<script>alert('Data berhasil diperbarui!');window.location='dashboard_user.php';</script>";
?>
