<?php
// Include your database connection here
// Pastikan session dimulai sebelum penggunaan $_SESSION
session_start();

if (isset($_POST['delete_comment'])) {
    // Periksa apakah session user_id sudah ada atau belum
    if(isset($_SESSION['user_id'])) {
        // Ambil data dari form
        $komen_id = $_POST['komentar_id'];

        // Periksa izin pengguna
        $user_id = $_SESSION['user_id'];
        $cek = mysqli_query($conn, "SELECT * FROM komentar WHERE UserID='$user_id' AND KomentarID='$komen_id'");
        if (mysqli_num_rows($cek) > 0) {
            // Hapus komentar dari database
            $delete = mysqli_query($conn, "DELETE FROM komentar WHERE KomentarID='$komen_id'");
            if ($delete) {
                echo '<script>alert("Komentar berhasil dihapus");</script>';
            } else {
                echo '<script>alert("Gagal menghapus komentar");</script>';
            }
        } else {
            // User tidak diizinkan menghapus komentar
            echo '<script>alert("Anda tidak berhak menghapus komentar ini");</script>';
        }
        // Redirect kembali ke halaman detail
        header("Location: detail.php?id=".$_GET['id']);
        exit(); // Penting: pastikan tidak ada output lain sebelum header
    } else {
        echo '<script>alert("Anda harus login untuk menghapus komentar");</script>';
        // Redirect ke halaman login jika pengguna tidak masuk
        header("Location: login.php");
        exit();
    }
}
?>
