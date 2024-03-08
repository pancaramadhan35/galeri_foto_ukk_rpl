<?php 
$details=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.UserID=user.UserID WHERE foto.FotoID='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]' AND UserID='".@$_SESSION['user_id']."'"));
?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <img src="uploads/<?= $data['NamaFile'] ?>" alt="<?= $data['JudulFoto'] ?>" class="object-fit-cover">
                <div class="card-body">
                    <h3 class="card-title mb-0"><?= $data['JudulFoto'] ?> <a href="<?php if(isset($_SESSION['user_id'])){echo '?url=like&&id='.$data['FotoID'].'';}else{echo 'login.php';} ?>" class="btn-dark btn btn-sm"><?php if($cek==0){echo 'Like';}else{echo 'Dislike';} ?> <?= $likes ?></a></h3>
                    <small class="text-muted mb-3">by:<?= $data['Username'] ?>, <?= $data['TanggalUnggah'] ?></small>
                    <p><?= $data['DeskripsiFoto'] ?></p>
                    <?php 
                    //ambil data komentar
                    $komen_id=@$_GET["komentar_id"];
                    $submit=@$_POST['submit'];
                    $komentar=@$_POST['komentar'];
                    $foto_id=@$_POST['foto_id'];
                    $user_id=@$_SESSION['user_id'];
                    $tanggal=date('Y-m-d');
                    $dataKomentar=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM komentar WHERE KomentarID='$komen_id' AND UserID='$user_id' AND FotoID='$foto_id'"));
                    if ($submit=='Kirim') {
                        $komen=mysqli_query($conn, "INSERT INTO komentar VALUES('','$foto_id','$user_id','$komentar','$tanggal')");
                        header("Location: ?url=detail&&id=$foto_id");
                    }elseif($submit=='Edit'){
                        
                    }
                    ?>
                    <form action="?url=detail" method="post">
                        <div class="form-group d-flex flex-row">
                            <input type="hidden" name="foto_id" value="<?= $data['FotoID'] ?>">
                            <a href="?url=home" class="btn btn-secondary">Kembali</a>
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <input type="text" class="form-control" name="komentar" required placeholder="Masukan Komentar">
                                <input type="submit" value="Kirim" name="submit" class="btn btn-secondary">
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <?= @$alert ?>
            <?php $UserID=@$_SESSION["user_id"]; $komen=mysqli_query($conn, "SELECT * FROM komentar INNER JOIN user ON komentar.UserID=user.UserID INNER JOIN foto ON komentar.FotoID=foto.FotoId WHERE komentar.FotoID='$_GET[id]'"); ?>
            <?php foreach ($komen as $komens): ?>
                <p class="mb-0 fw-bold"><?= $komens['Username'] ?></p>
                <p class="mb-1"><?= $komens['IsiKomentar'] ?></p>
                <p class="text-muted small mb-0"><?= $komens['TanggalKomentar'] ?></p>
                <?php 
                // Tambahkan kode untuk menampilkan tombol hapus hanya jika komentar milik pengguna yang sedang login
                if ($komens['UserID'] == @$_SESSION['user_id']): ?>
                    <form action="komentar.php" method="post">
                        <input type="hidden" name="komentar_id" value="<?= $komens['KomentarID'] ?>">
                        <button type="submit" name="delete_comment" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
