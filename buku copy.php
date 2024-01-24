<?php
include 'database/database.php';
error_reporting(0);
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<title>Daftar Buku Perpustakaan</title>
<!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css" integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/user.css">

</head>
<body>
    <?php
include 'navbar.php';
?>
<div class="container mt-4">

 
    <ul class="nav justify-content-center">
      
    <form class="form-inline my-2 my-lg-0" action="" method="post">
      <input class="form-control mr-sm-2" type="text" name="search" placeholder="Enter the book title" aria-label="Search">
      <button class="btn bt my-2 my-sm-0 riht" type="submit">Search</button>
    </form>


 
 
</ul>
<hr>
<div class="container mt-3">
    <div class="row">
    <?php
    $cari = $_POST['ket'];
    $cari1 = $_POST['search'];
  


    if(isset($cari)){
        
    $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_kategori_buku`='".$_POST['kategori']."'");
    while ($row = mysqli_fetch_array($database_buku)){ ?>
  <div class="col-sm-3 mb-3" href="<?= $kategori['kategori']; ?>">
    <div class="card">
        <img src="img/<?= $row['tb_gambar_buku']; ?>" alt="">
        <div class="card-body">
            <h5 class="card-title"><?= $row['tb_judul_buku']; ?></h5>
      </div>
      <div class="card-footer">
        <form action="lihat.php" method="post">
          <button type="submit" name="kd_book" value="<?= $row['tb_kode_buku']; ?>" class="btn btn-warning rounded-20">view more</button>
        </form>
	    </div>
    </div>
  </div>
  <?php } 
  
} else if (isset($cari1)){
    $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_judul_buku`='$cari1'");
    while ($row = mysqli_fetch_array($database_buku)){ ?>
  <div class="col-sm-3 mb-3" href="<?= $kategori['kategori']; ?>">
    <div class="card">
        <img src="img/<?= $row['tb_gambar_buku']; ?>" alt="">
        <div class="card-body">
            <h5 class="card-title"><?= $row['tb_judul_buku']; ?></h5>
      </div>
      <div class="card-footer">
          <form action="lihat.php" method="post">
          <button type="submit" name="kd_book" value="<?= $row['tb_kode_buku']; ?>" class="btn btn-warning rounded-20">view more</button>
        </form>
        </div>
    </div>
  </div>
  <?php } 
} else { 
    $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku`");
    while ($row = mysqli_fetch_array($database_buku)){ ?>
  <div class="col-sm-3 mb-3" href="<?= $kategori['kategori']; ?>">
    <div class="card">
        <img src="img/<?= $row['tb_gambar_buku']; ?>" alt="">
        <div class="card-body">
            <h5 class="card-title"><?= $row['tb_judul_buku']; ?></h5>
      </div>
      <div class="card-footer">
			<form action="lihat.php" method="post">
          <button type="submit" name="kd_book" value="<?= $row['tb_kode_buku']; ?>" class="btn btn-warning rounded-20">view more</button>
        </form>
	    </div>
    </div>
  </div>
  
  <?php } 



}

  ?>





</div>
</div>
</div>




</div>
<?php
include 'fotter.php';
?>
</body>
</html>