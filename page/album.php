<div class="container">
   <div class="row">
      <div class="col-5">
         <div class="card">
            <div class="card-body">
               <h4>Halaman Album</h4>
               <?php 
               //ambil data yang di kirim oleh <form>
               $submit=@$_POST['submit'];
               if ($submit=='Simpan') {
                  $nama_album=@$_POST['nama_album'];
                  $deskripsi_album=@$_POST['deskripsi_album'];
                  $tanggal=date('Y-m-d');
                  $user_id=@$_SESSION['user_id'];
                  $insert=mysqli_query($conn, "INSERT INTO album VALUES('','$nama_album','$deskripsi_album','$tanggal','$user_id')");
                  if ($insert) {
                     echo 'Berhasil Membuat Album';
                     echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                  }else{
                     echo 'Gagal Membuat Album';
                     echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                  }
               }
               ?>
               
               <form action="?url=album" method="post">
                  <div class="form-group">
                     <label>Nama Album</label>
                     <input type="text" class="form-control" required name="nama_album">
                  </div>
                  <div class="form-group">
                     <label>Deskripsi Album</label>
                     <textarea name="deskripsi_album" class="form-control" required cols="30" rows="5"></textarea>
                  </div>
                  <input type="submit" value="Simpan" name="submit" class="btn btn-danger my-3">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>