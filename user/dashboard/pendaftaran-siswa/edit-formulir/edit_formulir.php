<?php
$conn = new mysqli("localhost", "root", "", "yayasan_almuhajirin_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi dan ambil ID siswa dari URL
if (!isset($_GET['id_siswa']) || !is_numeric($_GET['id_siswa'])) {
    die("ID siswa tidak valid.");
}
$id = (int) $_GET['id_siswa'];

// Ambil data dari database
$siswa  = $conn->query("SELECT * FROM siswa WHERE id_siswa = $id")->fetch_assoc();
$ayah   = $conn->query("SELECT * FROM ayah WHERE id_siswa = $id")->fetch_assoc();
$ibu    = $conn->query("SELECT * FROM ibu WHERE id_siswa = $id")->fetch_assoc();
$berkas = $conn->query("SELECT * FROM berkas WHERE id_siswa = $id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Formulir Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Data Siswa</h1>

    <form action="proses_edit_formulir.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="id_siswa" value="<?= $id ?>">

        <!-- Data Siswa -->
        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="full_name" value="<?= $siswa['full_name'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Nama Panggilan</label>
            <input type="text" name="nickname" value="<?= $siswa['nickname'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Tempat, Tanggal Lahir</label>
            <input type="text" name="birth" value="<?= $siswa['birth'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Jenis Kelamin</label>
            <select name="gender" class="block w-full border rounded p-2" required>
                <option <?= $siswa['gender'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                <option <?= $siswa['gender'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div>
            <label>Agama</label>
            <input type="text" name="religion" value="<?= $siswa['religion'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Anak Ke-</label>
            <input type="number" name="child_order" value="<?= $siswa['child_order'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Jumlah Saudara</label>
            <input type="number" name="siblings" value="<?= $siswa['siblings'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Status dalam Keluarga</label>
            <input type="text" name="family_status" value="<?= $siswa['family_status'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="address" rows="3" class="block w-full border rounded p-2" required><?= $siswa['address'] ?></textarea>
        </div>

        <!-- Data Ayah -->
        <h2 class="text-xl font-semibold pt-4">Data Ayah</h2>
        <div>
            <label>Nama Ayah</label>
            <input type="text" name="father_name" value="<?= $ayah['name'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Tempat Tanggal Lahir</label>
            <input type="text" name="father_birthplace" value="<?= $ayah['birthplace'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Agama</label>
            <input type="text" name="father_religion" value="<?= $ayah['religion'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Pekerjaan</label>
            <input type="text" name="father_job" value="<?= $ayah['job'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Pendidikan</label>
            <input type="text" name="father_education" value="<?= $ayah['education'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="father_address" rows="3" class="block w-full border rounded p-2"><?= $ayah['address'] ?></textarea>
        </div>
        <div>
            <label>No. Telp</label>
            <input type="text" name="father_phone" value="<?= $ayah['phone'] ?>" class="block w-full border rounded p-2" required>
        </div>

        <!-- Data Ibu -->
        <h2 class="text-xl font-semibold pt-4">Data Ibu</h2>
        <div>
            <label>Nama Ibu</label>
            <input type="text" name="mother_name" value="<?= $ibu['name'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Tempat Tanggal Lahir</label>
            <input type="text" name="mother_birthplace" value="<?= $ibu['birthplace'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Agama</label>
            <input type="text" name="mother_religion" value="<?= $ibu['religion'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Pekerjaan</label>
            <input type="text" name="mother_job" value="<?= $ibu['job'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Pendidikan</label>
            <input type="text" name="mother_education" value="<?= $ibu['education'] ?>" class="block w-full border rounded p-2" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="mother_address" rows="3" class="block w-full border rounded p-2"><?= $ibu['address'] ?></textarea>
        </div>
        <div>
            <label>No. Telp</label>
            <input type="text" name="mother_phone" value="<?= $ibu['phone'] ?>" class="block w-full border rounded p-2" required>
        </div>

        <!-- Upload Berkas -->
        <h2 class="text-xl font-semibold pt-4">Update Berkas (kosongkan jika tidak diubah)</h2>
        <div>
            <label>KK</label>
            <input type="file" name="kk" class="block w-full border rounded p-2">
        </div>
        <div>
            <label>Akte</label>
            <input type="file" name="akte" class="block w-full border rounded p-2">
        </div>
        <div>
            <label>KTP</label>
            <input type="file" name="ktp" class="block w-full border rounded p-2">
        </div>
        <div>
            <label>Pas Foto</label>
            <input type="file" name="foto" class="block w-full border rounded p-2">
        </div>
        <div>
            <label>Bukti Pembayaran</label>
            <input type="file" name="bukti_bayar" class="block w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</body>
</html>
