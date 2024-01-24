<?php
include 'database/database.php';
error_reporting(0);
session_start();
$hari_ini = date('Y-m-d');
if (!isset($_SESSION['id'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus masukan NIP terlebih dahulu!');
  window.location = 'index.php'
</script>";
} else {
  $id = $_SESSION['id'];
  $kodebuku = $_POST['kd_buku'];
  $get_data_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` WHERE tb_kode_buku='$kodebuku'");
  $data_buku = mysqli_fetch_array($get_data_buku);

  if (isset($_POST['datekembali'])) {
    $id__ = $_POST['id'];
    $date__ = $_POST['tanggal_kembali'];
mysqli_query($conn,"UPDATE `tb_peminjaman` SET `tb_kembali`='$date__' WHERE `id_peminjaman`='$id__'");
  }

  


  if (isset($_POST['bayar'])) {
    $idpeminjam = $_POST['idpeminjam'];
    $nmr_buku = $_POST['nmr_buku'];
    $total_buku = $_POST['total_buku'];
    $tgl_peminjam = $_POST['tgl_peminjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $tagihan = $_POST['tagihan'];
    $insert_kembali_buku = mysqli_query($conn, "INSERT INTO `tb_pengembalian`(`tb_nip`, `tb_kod_buku`, `tb_stok_buku_kembali`, `tb_tanggal_pinjam`, `tb_tanggal_akhir_kembali`,`tb_denda`) VALUES ('$id','$nmr_buku','$total_buku','$tgl_peminjam','$tgl_kembali','$tagihan')");
if($insert_kembali_buku){
  mysqli_query($conn,"DELETE FROM `tb_peminjaman` WHERE tb_nip='$id' and tb_kd_buku='$nmr_buku' and date_peminjaman='$tgl_peminjam' and tb_kembali='$tgl_kembali'");
  
  $pengembalianbuku1 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `tb_pengembalian` where tb_nip='$id' and tb_kod_buku='$nmr_buku'"));
  if($pengembalianbuku1 > 0){ 


    
  $pengembalianbuku1 =  mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `tb_pengembalian` where tb_nip='$id' and tb_kod_buku='$nmr_buku'"));
  $tb_nip = $pengembalianbuku1['tb_nip'];
  $tb_kod_buku = $pengembalianbuku1['tb_kod_buku'];
  $tb_tanggal_pinjam = $pengembalianbuku1['tb_tanggal_pinjam'];
  $tb_tanggal_akhir_kembali = $pengembalianbuku1['tb_tanggal_akhir_kembali'];
  mysqli_query($conn,"DELETE FROM `tb_peminjaman` WHERE tb_nip='$tb_nip' and tb_kd_buku='$tb_kod_buku' and date_peminjaman='$tb_tanggal_pinjam' and tb_kembali='$tb_tanggal_akhir_kembali'");
  }
  $ambilstok = mysqli_fetch_array(mysqli_query($conn, "SELECT tb_stok_buku FROM `tb_buku` WHERE tb_kode_buku='$nmr_buku'"));
  $input = $ambilstok['tb_stok_buku'] + $total_buku;
  mysqli_query($conn, "UPDATE `tb_buku` SET `tb_stok_buku`='$input' WHERE tb_kode_buku='$nmr_buku'");

}
  }  

  if (isset($_POST['kd_buku'])) {
    $kodebuku = $_POST['kd_buku'];
    $pinjam = '+1';
    $sql_cekdata_peminjaman = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_peminjaman` WHERE tb_nip='$id' and tb_kd_buku='$kodebuku'"));
    if($sql_cekdata_peminjaman == 0){
      $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_peminjaman`) As id FROM `tb_peminjaman`"));
      $idBuku = $max_id['id'] + 1;
      $insertbuku = mysqli_query($conn, "INSERT INTO `tb_peminjaman`(`id_peminjaman`,`tb_nip`, `tb_kd_buku`, `tb_stok_peminjaman`) VALUES ('$idBuku','$id','$kodebuku','$pinjam')");



      // if ($insertbuku){
      //   $kd=$_POST['kd_buku'];
      //   $ambil_stokbuku = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_buku`) As jumlahbuku FROM `tb_buku` where tb_kode_buku='$kd'"));
      //   $ambilstok = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_peminjaman`) As jumlahstok FROM `tb_peminjaman` where tb_nip='$id'"));
      //   $stok_ = $ambil_stokbuku['jumlahbuku']-$ambilstok['jumlahstok'];
      //   mysqli_query($conn, "UPDATE `tb_buku` SET `tb_stok_buku`='$stok_' WHERE `tb_kode_buku`='$kd'");
      //   echo notice(0);
      // }
    } 
    // else{
      // $sql_cekdata_peminjaman_stok = mysqli_fetch_array(mysqli_query($conn, "SELECT tb_stok_peminjaman FROM `tb_peminjaman` WHERE tb_nip='$id' and tb_kd_buku='$kodebuku'"));
      // if($sql_cekdata_peminjaman_stok['tb_stok_peminjaman'] < 3){
      //   $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_peminjaman`) As stok FROM `tb_peminjaman` WHERE date_peminjaman=date(now()) AND tb_kd_buku='$kodebuku'"));
      //   $stokBuku = $max['stok'] + 1;
      // $tambahstok = mysqli_query($conn, "UPDATE `tb_peminjaman` SET `tb_stok_peminjaman`='$stokBuku' WHERE `tb_nip`='$id' and `tb_kd_buku`='$kodebuku' limit 3");
      
    // } 
    else{
        // $kd=$_POST['kd_buku'];
        // $ambil_stokbuku = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_buku`) As jumlahbuku FROM `tb_buku` where tb_kode_buku='$kd'"));
        // $ambilstok = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_peminjaman`) As jumlahstok FROM `tb_peminjaman` where tb_nip='$id'"));
        // $stok_ = $ambil_stokbuku['jumlahbuku']-$ambilstok['jumlahstok'];
        // mysqli_query($conn, "UPDATE `tb_buku` SET `tb_stok_buku`='$stok_' WHERE `tb_kode_buku`='$kd'");
        echo "<script type='text/javascript'>
        alert('Buku sudah ada');
      </script>";
      }
    // }
    
  } 
  
  $peminjam = mysqli_query($conn, "SELECT * FROM `tb_peminjaman` where tb_nip='$id' and tb_status='Dipinjam'");
  $get_data = mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$id'");
  $data = mysqli_fetch_array($get_data);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="css/user.css">
    <title>FTTI | Library</title>
    
  </head>
  <body>
 <?php
include 'navbar.php';
?>
  
  <div class="container-fluid mt-3">

<div class="row m-2 mt-3">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-capitalize font-italic">Book Borrowing Table</h5>
        <div class="table-responsive">
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Book</th>
      <th scope="col">Borrowing date</th>
      <th scope="col">Number of Books</th>
       <th scope="col">Return Date</th>
       <th scope="col">Late fees</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  function nama($nama_buku)
  {
    global $conn;
    $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE tb_kode_buku='$nama_buku'"));
    return $sqly['tb_judul_buku'];
  }
  $i = 1; 
  $tanggal_jatuh_tempo = $data['tb_kembali'];
$tanggal_pembayaran = $data['date_peminjaman'];
$tanggal_jatuh_tempo_obj = new DateTime($tanggal_jatuh_tempo);
$tanggal_pembayaran_obj = new DateTime($tanggal_pembayaran);
$selisih_hari = $tanggal_jatuh_tempo_obj->diff($tanggal_pembayaran_obj)->days;
function formatRupiah($nilai) {
  return "Rp: " . number_format($nilai, 0, ',', '.');
}
$tarif_denda_per_hari = 1000;
$total_denda = max(0, $selisih_hari) * $tarif_denda_per_hari;
  foreach ($peminjam  as $data) :?>
    <tr>
      <th scope="row"><?= $i;?></th>
      <td class=" font-italic">
            <a href="lihat.php?lihat=<?= $data['tb_kd_buku']; ?>" class=" text-dark font-weight-bold"><?= nama($data['tb_kd_buku']);?></a>
      </td>
      <td><?= $data['date_peminjaman'];?></td>
      <td><?= $data['tb_stok_peminjaman'];?></td>
      <td>
        <?php
            if($data['tb_kembali'] < 0){ ?>
              <button id="kembali" data-id="<?= $data['id_peminjaman'];?>" type="button" class="btn tmb font-italic btn-sm" data-toggle="modal" data-target="#staticBackdrop">
              Enter the return date
              </button>
            <?php
            } else {
             echo $data['tb_kembali'];
            } ?>
 
    </td>
     <td>
 <?php

echo "Total ". formatRupiah($total_denda);
?>
</td>
<td>
<form action="" method="post">
<input type="hidden" name="idpeminjam" value="<?= $data['id_peminjaman']?>">
<input type="hidden" name="nmr_buku" value="<?= $data['tb_kd_buku']?>">
<input type="hidden" name="total_buku" value="<?= $data['tb_stok_peminjaman']?>">
<input type="hidden" name="tgl_peminjam" value="<?= $data['date_peminjaman']?>">
<input type="hidden" name="tgl_kembali" value="<?= $data['tb_kembali']?>">
<input type="hidden" name="tagihan" value="<?= formatRupiah($total_denda) ?>">
  <button type="submit" name="bayar"  class="btn btn-sm btn-success">return</button>
</form>

</td>

    </tr>
    <?php $i++;   endforeach ; ?>
  </tbody>
</table>
      </div>
      </div>
    </div>
    <style>
      .background{
        background-color: #001B79;
        color: #fff;
      }
    </style>
  </div>
  <div class="col-md-4 mb-4">
    <div class="card background">
        <div class="card-body">
            <h5 class="card-title font-weight-bold font-italic text-center mb-3">Scan the Book</h5>
            <div class="text-center">
                <canvas id="bookCanvas"></canvas>
            </div>
        </div>
    </div>
</div>
 


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" id="modal-edit">
    <div class="modal-content">
      <div class="modal-header md">
        <h5 class="modal-title text-light font-italic" id="staticBackdropLabel">Book return date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <input type="date" name="tanggal_kembali" class="form-control">
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="datekembali" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
  </div>
</div>





  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script type="text/javascript" src="scanner/js/jquery.js"></script>
  <script type="text/javascript" src="scanner/js/qrcodelib.js"></script>
  <script type="text/javascript" src="scanner/js/webcodecamjquery.js"></script>
  <script>
  function toggleMobileMenu() {
    var desktopMenu = document.querySelector('.desktop-menu');
    desktopMenu.style.display = (desktopMenu.style.display === 'none' || desktopMenu.style.display === '') ? 'flex' : 'none';
  }
</script>
    <script type="text/javascript">
    var arg = {
      resultFunction: function(result) {

        var redirect = '';
        $.redirectPost(redirect, {
          kd_buku: result.code
        });
      }
    };

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();
    $('select').on('change', function() {
      decoder.stop().play();
    });

    $.extend({
      redirectPost: function(location, args) {
        var form = '';
        $.each(args, function(key, value) {
          form += '<input type="hidden" name="' + key + '" value="' + value + '">';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
      }
    });
    
  </script>

<script>
   $(document).on("click", "#kembali", function() {
            let id = $(this).data('id');
            $(" #modal-edit #id").val(id);

        });
</script>
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