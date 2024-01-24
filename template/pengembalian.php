<?php
include '../database/database.php';
include 'role.php';
// $traines = mysqli_query($conn, "SELECT * FROM `tb_trainee` ORDER BY id_trainee DESC");
if (isset($_POST['cari'])){
  $awal = $_POST['date_awal'];
  $akhir = $_POST['date_akhir'];
$pengembalian = mysqli_query($conn, "SELECT * FROM `tb_pengembalian` where date BETWEEN '$awal' and '$akhir'");
} else {
  $pengembalian = mysqli_query($conn, "SELECT * FROM `tb_pengembalian`");
}
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
        
          <h2 class="jr-content-title">Returns Table</h2>
          <form action="" method="post">
          
          <div class="container">
              <input type="date" name="date_awal" class="form-control col-2 rounded-10 shadow mr-2">
              <input type="date" name="date_akhir" class="form-control col-2 rounded-10 shadow mr-2">
              <button type="submit" name="cari" class="btn btn-primary rounded-10 shadow">Show</button>
              <a href="pengembalian.php" class="btn btn-danger rounded-10 ml-2 shadow">Reset</a>
            </div>
          </form>
          <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
 
 <thead>
   <tr>
     <th scope="col">No</th>
     <th scope="col">Trainee</th>
     <th scope="col">Book title</th>
     <th scope="col">Number of Books</th>
     <th scope="col">Borrower Date</th>
     <th scope="col">Return Due Date</th>
     <th scope="col">Late fees</th>
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
  $sqly = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_buku WHERE tb_kode_buku='$nama_buku'"));
  return $sqly['tb_judul_buku'];
}
      function nama_($traines_)
{
  global $conn;
  $sqly1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$traines_'"));
  return $sqly1['Nama_traines'];
}
      foreach ($pengembalian as $row) :
    ?>
   <tr>
  
<td><?= $i; ?></td>
<td><?= nama_($row['tb_nip']); ?></td>
<td><?= nama($row['tb_kod_buku']); ?></td>
<td><?= $row['tb_stok_buku_kembali']; ?></td>
<td><?= $row['tb_tanggal_pinjam']; ?></td>
<td><?= $row['tb_tanggal_akhir_kembali']; ?></td>
<td><?= $row['tb_denda']; ?></td>
<td><?= $row['date']; ?></td>
<td><?= $row['status_denda']; ?></td>


     
   </tr>
   <?php $i++; ?>
    <?php endforeach; ?>
 </tbody>
</table>
 
 
 



</div>
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

  </body>
</html>
