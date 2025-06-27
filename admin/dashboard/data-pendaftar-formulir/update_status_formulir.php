<?php
session_start();
include '../../../connect/connect.php'; // path ini harus sesuai

;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_siswa = $_POST['id_siswa'] ?? null;
    $status = $_POST['status_pending'] ?? null;

    if ($id_siswa && in_array($status, ['diterima', 'ditolak'])) {
        $stmt = $conn->prepare("UPDATE siswa SET status_pending = ? WHERE id_siswa = ?");
        $stmt->bind_param("si", $status, $id_siswa);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Status berhasil diubah menjadi: $status";
        } else {
            $_SESSION['msg'] = "❌ Gagal update status.";
        }
        $stmt->close();
    } else {
        $_SESSION['msg'] = "Data tidak valid!";
    }

    header("Location: ../data-siswa/data_siswa.php");
    exit();
}
