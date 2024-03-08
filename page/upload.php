<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4>Halaman Upload</h4>
                    <?php 
                        //ambil data dari <form>
                        $submit=@$_POST['submit'];
                        if ($submit=='Simpan') {
                            $judul_foto=@$_POST['judul_foto'];
                            $deskripsi_foto=@$_POST['deskripsi_foto'];
                            $nama_file=@$_FILES['namafile']['name'];
                            $tmp_foto=@$_FILES['namafile']['tmp_name'];
                            $tanggal=date('Y-m-d');
                            $album_id=@$_POST['album_id'];
                            $user_id=@$_SESSION['user_id'];
                            if (move_uploaded_file($tmp_foto, 'uploads/'.$nama_file)) {
                                $insert=mysqli_query($conn, "INSERT INTO foto VALUES('','$judul_foto','$deskripsi_foto','$tanggal','$nama_file','$album_id','$user_id')");
                                echo 'Gambar Berhasil di simpan';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                            }else{
                                echo 'Gambar gagal di simpan';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                            }
                        }
                        //mencari data album
                        $album=mysqli_query($conn, "SELECT * FROM album");
                    ?>
                    <form action="?url=upload" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul Foto</label>
                            <input type="text" class="form-control" required name="judul_foto">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Foto</label>
                            <textarea name="deskripsi_foto" class="form-control" required cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pilih Gambar</label>
                            <input type="file" name="namafile" class="form-control" required>
                            <small class="text-danger">File Harus Berupa: *.jpg, *.png *.gif</small>
                        </div>
                        <div class="form-group">
                            <label>Pilih Album</label>
                            <select name="album_id" class="form-select">
                                <?php foreach($album as $albums): ?>
                                <option value="<?= $albums['AlbumID'] ?>"><?= $albums['NamaAlbum'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="submit" value="Simpan" name="submit" class="btn btn-danger my-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>