<?php
include 'database/database.php';
error_reporting(0);
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user.css">
    <title>FTTI | Library</title>
    <style>
      img{
        height: 200px;
        width: 150px;
      }
      .bdy{
        background-color: #DCF2F1;
      }
      .title{
        width: 150px;

      }

    
    </style>
  </head>
  <body class="bdy">
  <?php
include 'navbar.php';
?>

<div class="container mt-4">
  <ul class="nav">
        <form class="form-inline my-2 my-lg-0" action="" method="post">
          <input class="form-control mr-sm-2" type="text" name="search" placeholder="Enter the book title" aria-label="Search">
          <button class="btn bt my-2 my-sm-0 riht" type="submit">Search</button>
        </form>
    </ul>
    <hr>
  <div class="row">
  <?php
  $cari = $_POST['kat'];
  $cari1 = $_POST['search'];
if(isset($cari)){
$database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_kategori_buku` = '".$_POST['kat']."'");
while ($row = mysqli_fetch_array($database_buku)){ ?>
  <div class="col-6 col-md-2 col-lg-2 mb-3">
      <div class="card-body">
      <img src="img/<?= $row['tb_gambar_buku']; ?>" alt="">
        <h5 class="title mt-1 text-uppercase text-black-50"><?= $row['tb_judul_buku']; ?></h5>
        <!-- <a href="#" class=" text-capitalize font-weight-bold text-dark">View More</a> -->
        <form action="lihat.php" method="post">
            <button type="submit" name="kd_book" value="<?= $row['tb_kode_buku']; ?>" class="btn-sm btn font-weight-bold mr-2">View more</button>
        </form>
      </div>
  
  </div>
<?php } 

} else if(isset($cari1)) { ?>
 <?php
$database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_judul_buku` = '$cari1'");
while ($row = mysqli_fetch_array($database_buku)){ ?>
  <div class="col-6 col-md-2 col-lg-2 mb-3">
      <div class="card-body">
      <img src="img/<?= $row['tb_gambar_buku']; ?>" alt="">
        <h5 class="title mt-1 text-uppercase text-black-50"><?= $row['tb_judul_buku']; ?></h5>
        <!-- <a href="#" class=" text-capitalize font-weight-bold text-dark">View More</a> -->
        <form action="lihat.php" method="post">
            <button type="submit" name="kd_book" value="<?= $row['tb_kode_buku']; ?>" class="btn-sm btn font-weight-bold mr-2">View more</button>
        </form>
      </div>
  
  </div>

<?php }
}  else { ?>
 <?php
$database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku`");
while ($row = mysqli_fetch_array($database_buku)){ ?>
  <div class="col-6 col-md-2 col-lg-2 mb-3">
      <div class="card-body">
      <img src="img/<?= $row['tb_gambar_buku']; ?>" alt="">
        <h5 class="title mt-1 text-uppercase text-black-50"><?= $row['tb_judul_buku']; ?></h5>
        <!-- <a href="#" class=" text-capitalize font-weight-bold text-dark">View More</a> -->
        <form action="lihat.php" method="post">
            <button type="submit" name="kd_book" value="<?= $row['tb_kode_buku']; ?>" class="btn-sm btn font-weight-bold mr-2">View more</button>
        </form>
      </div>
  
  </div>

<?php } 
}?>

</div>
</div>







    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
    <?php
include 'fotter.php';
?>
</html>