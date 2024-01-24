<?php
include '../database/database.php';
include 'role.php';
?>
<html lang="en">
<?php
include 'header.php';
?> 
  <body>
  <?php
include 'navbar.php';
?> 
<div class="jr-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
<?php
if ($_GET['kd_buku'] > 0) {
  $kd_buku = $_GET['kd_buku'];
  if (isset($_POST['tmbh_stok'])) {
    $id_buku_ = $_POST['id_buku_'];
    $kode_buku_ = $_POST['kode_buku_'];
    $stok = $_POST['stok'];
    $simpan_data_stok_buku = mysqli_query($conn, "INSERT INTO `tb_tambah_stokbuku`(`tb_kode_buku`, `id_buku`, `tb_stok`) VALUES ('$kode_buku_','$id_buku_','$stok')");
  }

  $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_kode_buku`='$kd_buku'");
  $ambil_buku = mysqli_fetch_array($database_buku); 
  $stok_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(tb_stok) as stok FROM `tb_tambah_stokbuku` where `tb_kode_buku`='".$ambil_buku['tb_kode_buku']."' and `id_buku`='".$ambil_buku['tb_id']."'"));
  
  ?>
  <div class="container mt-5">
      <div class="jr-content-body pd-lg-l-40 d-flex flex-column">
        <h2 class="jr-content-title">Book Details</h2>
      <div class="form-row">
      <div class="col-md-4 form-group">
      <div class="m-1">
      <!-- <label for="">Gambar Buku :</label> -->
      <img src="../img/<?= $ambil_buku['tb_gambar_buku']; ?>" class=" rounded-20 shadow"  width="50%" height="70%">
      </div>
      </div>
      <div class="col-md-4 form-group">
      <div class="m-1">
      <label for="">Book title :</label>
      <input type="text" value="<?= $ambil_buku['tb_judul_buku']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Author :</label>
      <input type="text" value="<?= $ambil_buku['tb_penulis']; ?>" class="form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Book code :</label>
      <input type="text" value="<?= $ambil_buku['tb_kode_buku']; ?>" class="form-control" readonly>
      </div>
      <div class="m-1 mt-2">
        <form action="qrcode.php"  target="_blank" method="post" enctype="multipart/form-data">
       
        <button type="submit" name="qr" value="<?= $ambil_buku['tb_kode_buku']; ?>" id="qr" class="btn btn-success rounded-20">Print QR Code</button>
      </form>
      <br><br>
      <span class="text-danger"> *Sisa buku 10 dari jumlah awal buku</span>
      </div>

      </div>

      <div class="col-md-2 form-group">
      <div class="m-1">
      <label for="">Number of books :</label>
      <input type="text" value="<?= $ambil_buku['tb_stok_buku']+$stok_buku['stok']; ?>" class=" form-control" readonly >
      </div>
      <div class="m-1">
      <label for="">Book category :</label>
      <input type="text" value="<?= $ambil_buku['tb_kategori_buku']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Publication Year :</label>
      <input type="text" value="<?= $ambil_buku['tb_tahun_terbit']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Book entry date :</label>
      <input type="text" value="<?= $ambil_buku['tb_tanggal_input_buku']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-info rounded-20 mt-2" data-toggle="modal" data-target="#staticBackdrop">
      Add quantity
      </button>
      <!-- Modal tambah jumlah buku-->
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog  modal-sm">
      <div class="modal-content">
      <div class="modal-header header-modal ">
      <h5 class="modal-title text-light" id="staticBackdropLabel">Add the Number of Books</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
      <div>
        <label for="">Enter Amount :</label>
        <input type="hidden" name="id_buku_" value="<?= $ambil_buku['tb_id']; ?>">
        <input type="hidden" name="kode_buku_" value="<?= $ambil_buku['tb_kode_buku']; ?>">
        <input type="number" name="stok" class="form-control">
      </div>
      </div>
      <div class="modal-footer">
      <button type="submit" name="tmbh_stok" class="btn btn-primary rounded-20">Save</button>
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
      <div class="col-md-2 form-group">
      <div class="m-1">
      <label for="">Bookshelf :</label>
      <input type="text" value="<?= $ambil_buku['tb_rak_buku']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Book row :</label>
      <input type="text" value="<?= $ambil_buku['tb_baris_buku']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Book publisher :</label>
      <input type="text" value="<?= $ambil_buku['tb_penerbit']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <label for="">Book volumes :</label>
      <input type="text" value="<?= $ambil_buku['tb_volume']; ?>" class=" form-control" readonly>
      </div>
      <div class="m-1">
      <form action="" method="get">
          <button type="submit" name="id_buku" value="<?= $ambil_buku['tb_id']; ?>" class="btn btn-sm btn-warning rounded-20 mt-2  zoom-in-button">Edit Book Data</button>
        </form>

      <!-- <a href="detailbuku.php?id=<?= $ambil_buku['tb_id']; ?>" class="btn btn-warning rounded-20 mt-2">Edit Data Buku</a> -->
      </div>
      </div>
      </div>
        <div class="ht-40"></div>
      </div><!-- jr-content-body -->
</div><!-- container -->
















<?php
  
} else {  
  $id_buku = $_GET['id_buku'];
  if (isset($_POST['kd_buku'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/';
    $nama_gambar = $_FILES['image']['name'];
    $idkbuku = $_POST['id'];
    $judulbuku = $_POST['judulbuku'];
    $penulisbuku = $_POST['penulisbuku'];
    $kodebuku = $_POST['kodebuku'];
    $kategori = $_POST['kategori'];
    $thn_terbit = $_POST['thn_terbit'];
    $rakbuku = $_POST['rakbuku'];
    $barisbuku = $_POST['barisbuku'];
    $penerbitbuku = $_POST['penerbitbuku'];
    $volume = $_POST['volume'];
    if ($nama_gambar != '') {
      if (move_uploaded_file($sumber, $target . $nama_gambar)) {
        $simpan_data_buku = mysqli_query($conn, "UPDATE `tb_buku` SET `tb_judul_buku`='$judulbuku',`tb_kategori_buku`='$kategori',`tb_penulis`='$penulisbuku',`tb_penerbit`='$penerbitbuku',`tb_tahun_terbit`='$thn_terbit',`tb_rak_buku`='$rakbuku',`tb_baris_buku`='$barisbuku',`tb_kode_buku`='$kodebuku',`tb_volume`='$volume',`tb_gambar_buku`='$nama_gambar' WHERE `tb_id`='$idkbuku'");
        
        if($simpan_data_buku){
          $cekdata = $_SESSION['cek_data'] = $_POST['kodebuku'];
        } else {
          $datagagal = $_SESSION['datagagal'] = $_POST['kodebuku'];
    
        }
      }
    } else {
      $simpan_data_buku = mysqli_query($conn, "UPDATE `tb_buku` SET `tb_judul_buku`='$judulbuku',`tb_kategori_buku`='$kategori',`tb_penulis`='$penulisbuku',`tb_penerbit`='$penerbitbuku',`tb_tahun_terbit`='$thn_terbit',`tb_rak_buku`='$rakbuku',`tb_baris_buku`='$barisbuku',`tb_kode_buku`='$kodebuku',`tb_volume`='$volume' WHERE `tb_id`='$idkbuku'");
      if($simpan_data_buku){
        $cekdata = $_SESSION['cek_data'] = $_POST['kodebuku'];
      } else {
        $datagagal = $_SESSION['datagagal'] = $_POST['kodebuku'];
  
      }

    }
    
    








  
}
  $database_buku1 = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_id`='$id_buku'");
  $ambil_buku1 = mysqli_fetch_array($database_buku1); 
  $stok_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(tb_stok) as stok  FROM `tb_tambah_stokbuku` where `tb_kode_buku`='".$ambil_buku1['tb_kode_buku']."' and `id_buku`='".$ambil_buku1['tb_id']."'"));

  ?>

<form action="" method="post" enctype="multipart/form-data">
<div class="container mt-5">
      <div class="jr-content-body pd-lg-l-40 d-flex flex-column">
        <h2 class="jr-content-title">Edit Book</h2>
      <div class="form-row">
      <div class="col-md-4 form-group">
      <div class="m-1">
      <!-- <label for="">Gambar Buku :</label> -->
      <img src="../img/<?= $ambil_buku1['tb_gambar_buku']; ?>" class=" rounded-20"  width="50%" height="70%">
      <input type="file" name="image" class="mt-2">
      </div>
      </div>
      <div class="col-md-4 form-group">
      <div class="m-1">
      <label for="">Book title :</label>
      <input type="text" name="judulbuku" value="<?= $ambil_buku1['tb_judul_buku']; ?>" class=" form-control" >
      </div>
      <div class="m-1">
      <label for="">Author :</label>
      <input type="text" name="penulisbuku" value="<?= $ambil_buku1['tb_penulis']; ?>" class="form-control" >
      </div>
      <div class="m-1">
      <label for="">Book code :</label>
      <input type="text" name="kodebuku" value="<?= $ambil_buku1['tb_kode_buku']; ?>" class="form-control" >
      </div>
      <div class="m-1 mt-2">
      <button type="button" class="btn btn-primary rounded-20 position-relative">
      See Active Borrowers
      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      10
      </span>
      </button>
      <br><br>
      <span class="text-danger"> *Sisa buku 10 dari jumlah awal buku</span>
      </div>

      </div>


      <div class="col-md-2 form-group">
      <div class="m-1">
      <label for="">Number of books :</label>
      <input type="text" readonly value="<?= $ambil_buku1['tb_stok_buku']+$stok_buku['stok']; ?>" class=" form-control" >
      </div>
      <div class="m-1">
      <label for="">Book category :</label>

      <select  id="" class="form-control" name="kategori" value="<?= $ambil_buku1['tb_kategori_buku']; ?>">
      <?php
$perulangan_ = mysqli_query($conn,"SELECT * FROM `tb_kategori`");
while ($perulangan_kategori = mysqli_fetch_array($perulangan_)) { ?>
                <option value="<?= $perulangan_kategori['kategori']?>"><?= $perulangan_kategori['kategori']?></option>
<?php } ?>
      </select>
    
      </div>
      <div class="m-1">
      <label for="">Publication Year :</label>
      <input type="text" name="thn_terbit" value="<?= $ambil_buku1['tb_tahun_terbit']; ?>" class=" form-control" >
      </div>
      <div class="m-1">
      <label for="">Book entry date :</label>
      <input type="text" readonly value="<?= $ambil_buku1['tb_tanggal_input_buku']; ?>" class=" form-control" >
      </div>
      </div>
      
     
      <div class="col-md-2 form-group">
      <div class="m-1">
      <label for="">Bookshelf :</label>
      <input type="text" name="rakbuku"  value="<?= $ambil_buku1['tb_rak_buku']; ?>" class=" form-control" >
      </div>
      <div class="m-1">
      <label for="">Book row :</label>
      <input type="text" name="barisbuku" value="<?= $ambil_buku1['tb_baris_buku']; ?>" class=" form-control" >
      </div>
      <div class="m-1">
      <label for="">Book publisher :</label>
      <input type="text" name="penerbitbuku" value="<?= $ambil_buku1['tb_penerbit']; ?>" class=" form-control" >
      </div>
      <div class="m-1">
      <label for="">Book volumes :</label>
      <select  id="" value="<?= $ambil_buku1['tb_volume']; ?>" class="form-control" name="volume">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
              </select>
      </div>
      <div class="m-1">
     <input type="hidden" name="id" value="<?= $ambil_buku1['tb_id']; ?>">
          <button type="submit" name="kd_buku"   class="btn btn-sm btn-info rounded-10 mr-2 zoom-in-button">Save</button>
          <!-- <a href="detailbuku.php?idkbuku=<?= $ambil_buku1['tb_kode_buku']; ?>" class="btn btn-warning rounded-20 mt-2">Edit Data Buku</a> -->
        </div>
      </div>
    </div>
    <div class="ht-40"></div>
  </div><!-- jr-content-body -->
</div><!-- container -->
</form>

<?php

}



?>










     
    </div><!-- jr-content -->

    <?php
include 'ft_script.php';
include '../alert/alert.php';
?> 


  </body>
</html>
