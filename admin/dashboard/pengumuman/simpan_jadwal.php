<?php
include '../../../connect/connect.php';

$id = $_POST['id'] ?? null;

if ($id) {
    // Update
    $stmt = $conn->prepare("UPDATE jadwal_ppdb SET gelombang=?, pendaftaran_mulai=?, pendaftaran_selesai=?, pengumuman_mulai=?, pengumuman_selesai=? WHERE id=?");
    $stmt->bind_param("sssssi", $_POST['gelombang'], $_POST['pendaftaran_mulai'], $_POST['pendaftaran_selesai'], $_POST['pengumuman_mulai'], $_POST['pengumuman_selesai'], $id);
} else {
    // Insert
    $stmt = $conn->prepare("INSERT INTO jadwal_ppdb (gelombang, pendaftaran_mulai, pendaftaran_selesai, pengumuman_mulai, pengumuman_selesai) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['gelombang'], $_POST['pendaftaran_mulai'], $_POST['pendaftaran_selesai'], $_POST['pengumuman_mulai'], $_POST['pengumuman_selesai']);
}

$stmt->execute();
header("Location: admin_jadwal.php");
exit;
?>
