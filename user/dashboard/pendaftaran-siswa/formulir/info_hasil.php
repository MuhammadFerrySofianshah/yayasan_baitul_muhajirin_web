<?php
$id_siswa = isset($_GET['id_siswa']) ? intval($_GET['id_siswa']) : 0;
if ($id_siswa <= 0) die("ID tidak valid.");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Download Formulir...</title>
  <script>
    // 1. Auto-download file
    window.onload = () => {
      const a = document.createElement("a");
      a.href = "cetak_formulir.php?id_siswa=<?= $id_siswa ?>";
      a.download = "formulir.pdf"; // Optional: bisa diabaikan, browser handle otomatis
      a.click();

      // 2. Setelah 3 detik redirect ke halaman sukses
      setTimeout(() => {
        window.location.href = "sukses.php";
      }, 3000);
    };
  </script>
</head>
<body>
  <p>Silakan tunggu... Formulir akan terdownload dan kamu akan dialihkan ke halaman sukses.</p>
</body>
</html>
