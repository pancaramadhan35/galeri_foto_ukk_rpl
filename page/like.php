<?php
//cek apakah foto dengan di detail.php sudah di like oleh user yang login
$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]' AND UserID='$_SESSION[user_id]'"));
if ($cek == 0) {
   //ambil data yang di kirim melalui url
   $foto_id = @$_GET['id'];
   $user_id = @$_SESSION['user_id'];
   $tanggal = date('Y-m-d');
   $like = mysqli_query($conn, "INSERT INTO likefoto VALUES('','$foto_id','$user_id','$tanggal')");
   header("Location: ?url=detail&&id=$foto_id");
} else {
   //jika user yang login sudah like foto ini maka lakukan dislike
   $foto_id = @$_GET['id'];
   $user_id = @$_SESSION['user_id'];
   $dislike = mysqli_query($conn, "DELETE FROM likefoto WHERE FotoID='$foto_id' AND UserID='$user_id'");
   header("Location: ?url=detail&&id=$foto_id");
}
