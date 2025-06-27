<?php
include '../../connect/connect.php';

$id = isset($_POST['id_pendaftar']) ? intval($_POST['id_pendaftar']) : 0;
$status = $_POST['status'] ?? '';

if ($id && in_array($status, ['diterima', 'ditolak'])) {
    $stmt = $conn->prepare("UPDATE pendaftar SET status = ? WHERE id_pendaftar = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

header("Location: ../dashboard/data-pendaftar-akun/data_pendaftar_akun.php");
exit();
