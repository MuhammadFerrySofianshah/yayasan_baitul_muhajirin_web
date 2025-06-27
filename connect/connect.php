<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yayasan_almuhajirin_db";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    echo '
    <div style="
      background-color: #FEE2E2;
      color: #991B1B;
      padding: 16px;
      border: 1px solid #FCA5A5;
      border-radius: 8px;
      margin: 20px auto;
      width: 80%;
      font-family: sans-serif;
    ">
      <strong>⚠️ Gagal Terhubung ke Database</strong><br>
      Maaf, sistem tidak bisa memproses data saat ini. Silakan coba beberapa saat lagi.<br><br>
      <small>Error teknis: ' . htmlspecialchars($conn->connect_error) . '</small>
    </div>';
    exit;
}
?>
