<?php
include '../../../connect/connect.php';

$nope = $_GET['nope'];
$stmt = $conn->prepare("SELECT * FROM pendaftar WHERE nope = ?");
$stmt->bind_param("s", $nope);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

function formatTanggal($tgl) {
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tanggal = date('d', strtotime($tgl));
    $bulanIdx = date('m', strtotime($tgl)) - 1;
    $tahun = date('Y', strtotime($tgl));
    return "$tanggal {$bulan[$bulanIdx]} $tahun";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white max-w-xl w-full p-6 rounded shadow-lg text-gray-800" id="buktiContent">
    <div class="text-center">
        <img src="../../../img/logo-navbar.jpg" alt="Logo Yayasan" class="mx-auto w-[200px] h-auto mb-2">
        <h2 class="text-xl font-bold text-teal-800">Bukti Pendaftaran Akun</h2>
        <p class="text-sm text-gray-600">Yayasan Baitul Muhajirin</p>
        <hr class="my-4 border-t">
    </div>

    <div class="text-sm space-y-2">
        <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($data['nama']) ?></p>
        <p><strong>No. HP:</strong> <?= htmlspecialchars($data['nope']) ?></p>
        <p><strong>Tanggal Lahir:</strong> <?= formatTanggal($data['tglLahir']) ?></p>
        <p><strong>Tanggal Pendaftaran:</strong> <?= formatTanggal($data['waktu_pendaftaran_akun'] ?? date('Y-m-d')) ?></p>
        <p><strong>Bukti Transfer:</strong></p>
        <img src="<?= htmlspecialchars($data['bukti_byPendaftar']) ?>" alt="Bukti Transfer" class="w-40 border rounded shadow">
        <p class="mt-3 text-xs italic text-gray-600">*Bukti ini sah dikeluarkan oleh sistem pendaftaran Yayasan.</p>
    </div>

    <div class="text-center mt-6">
        <button onclick="downloadPDF()" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded shadow">
            ⬇️ Simpan sebagai PDF
        </button>
        <a href="../../../index.php" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow">Kembali</a>
    </div>
</div>

<script>
function downloadPDF() {
    const element = document.getElementById('buktiContent');
    html2pdf().from(element).save('Bukti-Pendaftaran.pdf');
}
</script>
</body>
</html>
