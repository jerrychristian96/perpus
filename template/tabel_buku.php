<?php
include '../database/database.php';
include 'role.php';
if (isset($_POST['kategori_buku'])) {
  $_kategori_buku = $_POST['kategori_buku'];
  $simpan_data_buku = mysqli_query($conn, "INSERT INTO `tb_kategori`(`kategori`) VALUES ('$_kategori_buku')");
}
if (isset($_POST['hapus_kategori'])) {
  $hapus_kategori_buku = $_POST['hapus_kategori'];
  $hapus_data_kategori_buku = mysqli_query($conn, "DELETE FROM `tb_kategori` WHERE id_='$hapus_kategori_buku'");
}

if (isset($_POST['save'])) {
  $sumber = $_FILES['image']['tmp_name'];
  $target = '../img/';
  $nama_gambar = $_FILES['image']['name'];
  $volume = $_POST['volume'];
  $kode_buku = $_POST['kode_buku'];
  $judul = $_POST['judul'];
  $penerbit = $_POST['penerbit'];
  $rakbuku = $_POST['rakbuku'];
  $stok = $_POST['stok'];
  $Penulis = $_POST['Penulis'];
  $kategori = $_POST['kategori'];
  $thn_terbit = $_POST['thn_terbit'];
  $Baris = $_POST['Baris'];
  if ($nama_gambar != '') {
    if (move_uploaded_file($sumber, $target . $nama_gambar)) {
      $simpan_data_buku = mysqli_query($conn, "INSERT INTO `tb_buku`(`tb_judul_buku`, `tb_kategori_buku`, `tb_penulis`, `tb_penerbit`, `tb_tahun_terbit`, `tb_rak_buku`, `tb_baris_buku`, `tb_stok_buku`,`tb_kode_buku`,`tb_volume`,`tb_gambar_buku`) VALUES ('$judul','$kategori','$Penulis','$penerbit','$thn_terbit','$rakbuku','$Baris','$stok','$kode_buku','$volume','$nama_gambar')");
    }
  } else {
    $simpan_data_buku = mysqli_query($conn, "INSERT INTO `tb_buku`(`tb_judul_buku`, `tb_kategori_buku`, `tb_penulis`, `tb_penerbit`, `tb_tahun_terbit`, `tb_rak_buku`, `tb_baris_buku`, `tb_stok_buku`,`tb_kode_buku`,`tb_volume`) VALUES ('$judul','$kategori','$Penulis','$penerbit','$thn_terbit','$rakbuku','$Baris','$stok','$kode_buku','$volume')");
  }

}
$database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` order by `tb_id` DESC ");
$kategori__buku = mysqli_query($conn, "SELECT * FROM `tb_kategori`");
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
        
          <h2 class="jr-content-title">Book Table</h2>
        
<table class="mb-2">
<thead>

    <tr>
      <th scope="col">





      <!-- Button trigger modal -->
      
      <button type="button" class="btn btn-primary rounded-10 zoom-in-button shadow zoom-in-out-button" data-toggle="modal" data-target="#tambah_buku">
      Enter Book Data
      </button>
   
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary ml-4 rounded-10 zoom-in-button " data-toggle="modal" data-target="#tambah_kategori">
Enter Book Category
</button>

<!-- Modal -->
<div class="modal fade" id="tambah_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  header-modal">
        <h5 class="modal-title text-light" id="exampleModalLabel">Book Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <div class="">
          <label for="">Enter Category : </label>
          <input type="text" class="form-control col-4" name="kategori_buku" id="">
          <button type="submit" class="btn btn-success mt-2">Save</button>
        </div>
        </form>
        <span class="text-danger font-italic">If the book category has been used then you are not allowed to delete the book category, you can only add a new category.</span>
      <hr>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Category</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $b = 1;
      foreach ($kategori__buku as $row) :
    ?>
    <tr>
      <th scope="row"><?= $b; ?></th>
      <td><?= $row['kategori']; ?></td>
      <td>
<form action="" method="post">
  <button type="submit" name="hapus_kategori" value="<?= $row['id_']; ?>" class="btn btn-danger btn-sm rounded-10">Delete</button>
</form>
      </td>
    </tr>
    <?php $b++; ?>
    <?php endforeach; ?>
   
  </tbody>
</table>


      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>










<!-- Modal tambah buku-->
<div class="modal fade" id="tambah_buku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title text-light" id="staticBackdropLabel">Add Book Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form action="" method="post"  enctype="multipart/form-data">
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
            <div class="m-2">
                <label for="">Book code :</label>
              <input type="text" class="form-control" name="kode_buku">
              </div>
            <div class="m-2">
                <label for="">Image :</label>
              <input type="file" class="form-control" name="image">
              </div>
            <div class="m-2">
                <label for="">Book title :</label>
              <input type="text" class="form-control" name="judul">
              </div>
            <div class="m-2">
                <label for="">Book publisher :</label>
              <input type="text" class="form-control" name="penerbit">
              </div>
            <div class="m-2">
                <label for="">Bookshelf :</label>
              <input type="text" class="form-control" name="rakbuku">
              </div>
            <div class="m-2">
                <label for="">Number of books :</label>
              <input type="number" class="form-control" name="stok">
              </div>

            </div>

            <div class="col-sm-6">
            <div class="m-2">
                <label for="">Author :</label>
              <input type="text" name="Penulis" class="form-control">
            </div>
            <div class="m-2">
              <label for="">Category :</label>
              <select  id="" class="form-control" name="kategori">
              <?php
$perulangan_ = mysqli_query($conn,"SELECT * FROM `tb_kategori`");
while ($perulangan_kategori = mysqli_fetch_array($perulangan_)) { ?>
                <option value="<?= $perulangan_kategori['kategori']?>"><?= $perulangan_kategori['kategori']?></option>
<?php } ?>
              </select>
            </div>
            <div class="m-2">
                <label for="">Publication Year :</label>
              <input type="text" name="thn_terbit" class="form-control">
            </div>
            <div class="m-2">
                <label for="">Book row :</label>
              <input type="text" name="Baris" class="form-control">
            </div>
            <div class="m-2">
              <label for="">Book volumes :</label>
              <select  id="" class="form-control" name="volume">
                <option value="">There isn't any</option>
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
            <div class="m-2">
            <span class="text-danger font-italic">*Make sure all data presented is in accordance with the facts*</span>
            </div>
          </div>
       </div>
      <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-primary zoom-in-button rounded-10">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
      </th>

     
      </tr>


  </thead>
</table>

  <table id="example" class="table table-striped table-bordered" style="width:100%">
 
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Book title</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
      <th scope="col">Book publisher</th>
      <th scope="col">Publication Year</th>
      <th scope="col">Book volumes</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach ($database_buku as $row) :
    ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $row['tb_judul_buku']; ?></td>
      <td><?= $row['tb_penulis']; ?></td>
      <td><?= $row['tb_kategori_buku']; ?></td>
      <td><?= $row['tb_penerbit']; ?></td>
      <td><?= $row['tb_tahun_terbit']; ?></td>
      <td><?= $row['tb_volume']; ?></td>
      <td>
<span>

  <form action="detailbuku.php" method="get">
    <button type="submit" name="kd_buku" value="<?= $row['tb_kode_buku']; ?>" class="btn btn-sm btn-info rounded-10 mr-2 zoom-in-button">Show</button>
        </form>
        <?php   
       $kode_buku=$row['tb_kode_buku'];
       $id_buku = $row['tb_id']; 

        $stok_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(tb_stok) as stok FROM `tb_tambah_stokbuku` where `tb_kode_buku`='$kode_buku' and `id_buku`='$id_buku'")); ?>
        <form action="qrcode.php"  target="_blank" method="post" enctype="multipart/form-data">
          <button type="submit" name="qr" value="<?= $row['tb_kode_buku']; ?>" id="qr" class="btn btn-success rounded-10 zoom-in-button">Print QR Code <sup class="badge badge-light"><?= $row['tb_stok_buku']+$stok_buku['stok']; ?></sup></button>
        </form>
      </span>
      <!-- <button class="btn btn-sm rounded-10 btn-az-secondary zoom-in-button">Lihat Peminjaman Aktif</button> -->
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
   
  </tbody>
</table>
      

  
       
        

          <div class="ht-40"></div>

        </div><!-- jr-content-body -->
      </div><!-- container -->
    </div><!-- jr-content -->

    <?php
include 'ft_script.php';
?> 

  </body>
</html>
