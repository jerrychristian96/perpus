<?php
include '../database/database.php';
if (isset($_POST['qr'])) {
  include "../qr_code/qrlib.php";
  /*create folder*/
  $tempdir = "../img/fotoqr/";
  if (!file_exists($tempdir))
    mkdir($tempdir, 0755);
  $file_name = date("Ymd") . rand() . ".png";
  $file_path = $tempdir . $file_name;
  QRcode::png($_POST['qr'], $file_path, "L", 7, 8);
  /* param (1)qrcontent,(2)filename,(3)errorcorrectionlevel,(4)pixelwidth,(5)margin */
?>
  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
      img{
        width: 100%;
  height: auto;
      }
    </style>
  </head>
  
  
  <body>
    <div class="row">
    <?php
  $buku = mysqli_query($conn, "SELECT * FROM tb_buku where tb_kode_buku='".$_POST['qr']."'");
  while ($buku_ = mysqli_fetch_array($buku)){
    $judul_buku = $buku_['tb_judul_buku'];
    $penulis = $buku_['tb_penulis'];
    $kode_buku = $buku_['tb_kode_buku']; 
    $id_buku = $buku_['tb_id']; 
    $stok_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(tb_stok) as stok FROM `tb_tambah_stokbuku` where `tb_kode_buku`='$kode_buku' and `id_buku`='$id_buku'"));
    $jumlah = $buku_['tb_stok_buku']+$stok_buku['stok']; 
    $p=1;
    while ($p<=$jumlah) {
    ?>


<div class="col-sm-5 m-2">
  <div class="card">
    <div class="card-body">
        <img src="<?= $file_path ?>" alt="...">
        <center>
          <h5 class="card-title"><?= $judul_buku; ?></h5>
        </center>
      </div>
    </div>
    </div>


    
    
 <?php   
 $p++;
    }
  }


?>
</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
      window.print()
    </script>
  </body>

  </html>

<?php } ?>