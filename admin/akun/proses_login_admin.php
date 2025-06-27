<?php
session_start();
// 1. Koneksi ke DB
include '../../connect/connect.php';

// 2. Cek jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 3. Cek user di DB
    $stmt = $conn->prepare("SELECT id_admin, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // 4. Jika ditemukan
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id_admin, $db_username, $db_password);
        $stmt->fetch();

        // ❗ Gunakan ini jika password masih plain text di DB
        if ($password === $db_password) {
        // ✅ Gunakan ini jika sudah password_hash()
        // if (password_verify($password, $db_password)) {

            // 5. Set session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $id_admin;
            $_SESSION['admin_username'] = $db_username;

            header("Location: ../dashboard/beranda/beranda_admin.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Password salah.";
        }
    } else {
        $_SESSION['login_error'] = "Username tidak ditemukan.";
    }

    $stmt->close();
    header("Location: login_admin.php");
    exit;
}

$conn->close();
?>