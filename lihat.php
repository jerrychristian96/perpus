<?php
include 'database/database.php';
error_reporting(0);
session_start();
if (!isset($_SESSION['id'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus masukan NIP terlebih dahulu!');
  window.location = 'index.php'
</script>";
} else {
  $id = $_SESSION['id'];
  $_POST['kd_book'];
  $get_data = mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$id'");
  $data = mysqli_fetch_array($get_data);
 
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user.css">
    <title>FTTI | Library</title>
  
    
  </head>
  <body>
 <?php
include 'navbar.php';
if(isset($_POST['kd_book'])){
  $get_data_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` WHERE tb_kode_buku='".$_POST['kd_book']."'");
  $data_buku = mysqli_fetch_array($get_data_buku);
?>
  
<hr>
  <div class="container">
      <div class="jr-content-body pd-lg-l-40 d-flex flex-column">
        <h2 class="jr-content-title">Book Details</h2>
        <div class="form-row">
           <div class="col-md-4 form-group">
            <div class="m-1">
            <img src="img/<?= $data_buku['tb_gambar_buku']; ?>" class=" rounded-20"  width="50%" height="70%">
            </div>
          </div>


        <div class="col-md-4 form-group">
           <div class="m-1">
              <label for="">Book title :</label>
              <input type="text" value="<?= $data_buku['tb_judul_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Author :</label>
              <input type="text" value="<?= $data_buku['tb_penulis']; ?>" class="form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book code :</label>
              <input type="text" value="<?= $data_buku['tb_kode_buku']; ?>" class="form-control" readonly>
             </div>
        </div>

        <div class="col-md-2 form-group">
            <div class="m-1">
              <label for="">Number of books :</label>
              <input type="text" value="<?= $data_buku['tb_stok_buku']+$stok_buku['stok']; ?>" class=" form-control" readonly >
            </div>
      
            <div class="m-1">
              <label for="">Book category :</label>
              <input type="text" value="<?= $data_buku['tb_kategori_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Publication Year :</label>
              <input type="text" value="<?= $data_buku['tb_tahun_terbit']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book entry date :</label>
              <input type="text" value="<?= $data_buku['tb_tanggal_input_buku']; ?>" class=" form-control" readonly>
             </div>
          </div>
   
        <div class="col-md-2 form-group">
            <div class="m-1">
              <label for="">Bookshelf :</label>
              <input type="text" value="<?= $data_buku['tb_rak_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book row :</label>
              <input type="text" value="<?= $data_buku['tb_baris_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book publisher :</label>
              <input type="text" value="<?= $data_buku['tb_penerbit']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book volumes :</label>
              <input type="text" value="<?= $data_buku['tb_volume']; ?>" class=" form-control" readonly>
            </div>
            
            <div class="m-1">
             
              <a href="buku.php" class="btn btn-danger rounded-10">return</a>
            </div>

   
  
        <div class="ht-40"></div>
      </div><!-- jr-content-body -->
</div><!-- container -->
<?php } else if ($_GET['lihat']) {
    $get_data_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` WHERE tb_kode_buku='".$_GET['lihat']."'");
    $data_buku = mysqli_fetch_array($get_data_buku); ?>
  <hr>
  <div class="container">
      <div class="jr-content-body pd-lg-l-40 d-flex flex-column">
        <h2 class="jr-content-title">Book Details</h2>
        <div class="form-row">
           <div class="col-md-4 form-group">
            <div class="m-1">
            <img src="img/<?= $data_buku['tb_gambar_buku']; ?>" class=" rounded-20"  width="50%" height="70%">
            </div>
          </div>
        <div class="col-md-4 form-group">
           <div class="m-1">
              <label for="">Book title :</label>
              <input type="text" value="<?= $data_buku['tb_judul_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Author :</label>
              <input type="text" value="<?= $data_buku['tb_penulis']; ?>" class="form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book code :</label>
              <input type="text" value="<?= $data_buku['tb_kode_buku']; ?>" class="form-control" readonly>
             </div>
        </div>

        <div class="col-md-2 form-group">
            <div class="m-1">
              <label for="">Number of books :</label>
              <input type="text" value="<?= $data_buku['tb_stok_buku']+$stok_buku['stok']; ?>" class=" form-control" readonly >
            </div>
      
            <div class="m-1">
              <label for="">Book category :</label>
              <input type="text" value="<?= $data_buku['tb_kategori_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Publication Year :</label>
              <input type="text" value="<?= $data_buku['tb_tahun_terbit']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book entry date :</label>
              <input type="text" value="<?= $data_buku['tb_tanggal_input_buku']; ?>" class=" form-control" readonly>
             </div>
          </div>
   
        <div class="col-md-2 form-group">
            <div class="m-1">
              <label for="">Bookshelf :</label>
              <input type="text" value="<?= $data_buku['tb_rak_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book row :</label>
              <input type="text" value="<?= $data_buku['tb_baris_buku']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book publisher :</label>
              <input type="text" value="<?= $data_buku['tb_penerbit']; ?>" class=" form-control" readonly>
            </div>

            <div class="m-1">
              <label for="">Book volumes :</label>
              <input type="text" value="<?= $data_buku['tb_volume']; ?>" class=" form-control" readonly>
            </div>
            
            <div class="m-1">
             
              <a href="peminjaman.php" class="btn btn-danger rounded-10">return</a>
            </div>

   
  
        <div class="ht-40"></div>
      </div><!-- jr-content-body -->
</div><!-- container -->



<?php } ?>



 
  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
   
  </body>
  <?php
include 'fotter.php';
?>
</html>

<?php
function notice($type)
{
  if ($type == 1) {
    return "<audio autoplay><source src='" . 'music/error.wav' . "'></audio>";
  } elseif ($type == 0) {
    return "<audio autoplay><source src='" . 'music/error.wav' . "'></audio>";
  } elseif ($type == 2) {
    return "<audio autoplay><source src='" . 'music/beep.mp3' . "'></audio>";
  } elseif ($type == 3) {
    return "<audio autoplay><source src='" . 'music/late_2.mp3' . "'></audio>";
  }
}
?>