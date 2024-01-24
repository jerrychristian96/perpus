<?php
include '../database/database.php';
include 'role.php';
if (isset($_POST['cari'])){
  $awal = $_POST['date_awal'];
  $akhir = $_POST['date_akhir'];
$peminjam = mysqli_query($conn, "SELECT * FROM `tb_peminjaman` where date_peminjaman BETWEEN '$awal' and '$akhir'");
} else {
  $peminjam = mysqli_query($conn, "SELECT * FROM `tb_peminjaman`");
}

$traines = mysqli_query($conn, "SELECT * FROM `tb_trainee` ORDER BY id_trainee DESC");

// $peminjam = mysqli_query($conn, "SELECT * FROM `tb_peminjaman` ORDER BY date_peminjaman DESC");
?>
<html lang="en">
<?php
include 'header.php';
?> 
  <body>
  <?php
include 'navbar.php';
?> 

    <div class="jr-content mt-5 pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
        
        <div class="jr-content-body pd-lg-l-40 d-flex flex-column">
        
          <h2 class="jr-content-title">Loan Table</h2>
          <form action="" method="post">
          <div class="container">
              <input type="date" name="date_awal" class="form-control col-2 rounded-10 shadow mr-2">
              <input type="date" name="date_akhir" class="form-control col-2 rounded-10 shadow mr-2">
              <button type="submit" name="cari" class="btn btn-primary rounded-10 shadow">Show</button>
              <a href="peminjaman.php" class="btn btn-danger rounded-10 ml-2 shadow">Reset</a>
            </div>
          </form>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
 
 <thead>
   <tr>
     <th scope="col">No</th>
     <th scope="col">Trainee</th>
     <th scope="col">Book title</th>
     <th scope="col">Number of Books</th>
     <th scope="col">Borrower Date</th>
     <th scope="col">Date of return</th>
     <th scope="col">Status</th>

   </tr>
 </thead>
 <tbody>
 <?php
      $i = 1;
      function nama($nama_buku)
{
  global $conn;
  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE tb_kode_buku='$nama_buku'"));
  return $sqly['tb_judul_buku'];
}
      function nama_($traines_)
{
  global $conn;
  $sqly1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$traines_'"));
  return $sqly1['Nama_traines'];
}
      foreach ($peminjam as $row) :
    ?>
   <tr>
  
<td><?= $i; ?></td>
<td><?= nama_($row['tb_nip']); ?></td>
<td><?= nama($row['tb_kd_buku']); ?></td>
<td><?= $row['tb_stok_peminjaman']; ?></td>
<td><?= $row['date_peminjaman']; ?></td>
<td><?= $row['tb_kembali']; ?></td>
<td><?= $row['tb_status']; ?></td>


     
   </tr>
   <?php $i++; ?>
    <?php endforeach; ?>
 </tbody>
</table>
 
 
 



</div>
</div>

  
       
        

          <div class="ht-40"></div>

        </div><!-- jr-content-body -->
      </div><!-- container -->
    </div><!-- jr-content -->

    <?php
include 'ft_script.php';
include '../alert/alert.php';
?> 

<script>
    $(document).on("click", "#edit_siswa", function() {
      let nip = $(this).data('nip');
      let name = $(this).data('name');
      let batch = $(this).data('batch');
      let idtraines = $(this).data('idtraines');
      $(" #modal-edit #nip").val(nip);
      $(" #modal-edit #name").val(name);
      $(" #modal-edit #batch").val(batch);
      $(" #modal-edit #idtraines").val(idtraines);
    });
</script>
  </body>
</html>
