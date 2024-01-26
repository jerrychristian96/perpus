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
      $pd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_buku` WHERE tb_kode_buku='$kodebuku'"));
      $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_peminjaman`) As id FROM `tb_peminjaman`"));
      $idBuku = $max_id['id'] + 1;
      $katego = $pd['tb_kategori_buku'];
      $insertbuku = mysqli_query($conn, "INSERT INTO `tb_peminjaman`(`id_peminjaman`,`tb_nip`, `tb_kd_buku`, `tb_stok_peminjaman`,`tb_kategori`) VALUES ('$idBuku','$id','$kodebuku','$pinjam','$katego')");
      if($insertbuku){
        echo "<script>setTimeout(function(){ window.location.href = 'peminjaman.php'; }, 3000);</script>";
      }
    } else{
        // $kd=$_POST['kd_buku'];
        // $ambil_stokbuku = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_buku`) As jumlahbuku FROM `tb_buku` where tb_kode_buku='$kd'"));
        // $ambilstok = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`tb_stok_peminjaman`) As jumlahstok FROM `tb_peminjaman` where tb_nip='$id'"));
        // $stok_ = $ambil_stokbuku['jumlahbuku']-$ambilstok['jumlahstok'];
        // mysqli_query($conn, "UPDATE `tb_buku` SET `tb_stok_buku`='$stok_' WHERE `tb_kode_buku`='$kd'");
        echo "<script type='text/javascript'>
        alert('Buku sudah ada');
      </script>";
      }
   
    
  } 


  $get_data = mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$id'");
  $data = mysqli_fetch_array($get_data);
  $peminjam = mysqli_query($conn, "SELECT * FROM `tb_peminjaman` where tb_nip='$id' and tb_status='Dipinjam'");
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
  
  <div class="container-fluid">

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
  function formatRupiah($nilai) {
    return "Rp: " . number_format($nilai, 0, ',', '.');
  }
  foreach ($peminjam  as $data) :?>
    <tr>
      <td scope="row"><?= $i;?></td>
      <td class="font-italic">
            <a href="lihat.php?lihat=<?= $data['tb_kd_buku']; ?>" class=" text-dark font-weight-bold"><?= nama($data['tb_kd_buku']);?></a>
      </td>
      <td><?= $data['date_peminjaman'];?></td>
      <td><?= $data['tb_stok_peminjaman'];?></td>
      <td>
      <?php
          if($data['tb_kategori'] == 'Pembinaan Dasar'){
        $start_date = new DateTime($data['date_peminjaman']);
        $last_date = clone $start_date;
        $last_date->add(new DateInterval('P3D')); 
        mysqli_query($conn, "UPDATE `tb_peminjaman` SET `tb_kembali`='".$last_date->format('Y-m-d')."' WHERE  `id_peminjaman`='".$data['id_peminjaman']."'"); 
        
      } else {
        $start_date = new DateTime($data['date_peminjaman']);
        $last_date = clone $start_date;
        $last_date->add(new DateInterval('P14D')); 
        mysqli_query($conn, "UPDATE `tb_peminjaman` SET `tb_kembali`='".$last_date->format('Y-m-d')."' WHERE  `id_peminjaman`='".$data['id_peminjaman']."'"); 
      }
            
      ?>
      <?= $data['tb_kembali'];?>
    </td>
     <td>
     <?php

$tanggalJatuhTempo = new DateTime($hari_ini); // Gantilah dengan tanggal jatuh tempo yang sesuai

// Tanggal pembayaran
$tanggalPembayaran = new DateTime($data['tb_kembali']); // Gantilah dengan tanggal pembayaran yang sesuai

// Hitung selisih hari
$selisihHari = $tanggalJatuhTempo->diff($tanggalPembayaran)->days;

// Denda per hari
$dendaPerHari = 1000;

// Hitung total denda jika lewat 1 hari atau lebih
if ($data['tb_kembali'] <= $hari_ini) {
    $totalDenda = $selisihHari * $dendaPerHari;
    echo "A fine of " . $totalDenda . " for being " . $selisihHari . " days past the due date.";
} else {
    echo "No fines, payment on time.";
}

?>

</td>
<td>
<form action="" method="post">
<input type="hidden" name="idpeminjam" value="<?= $data['id_peminjaman']?>">
<input type="hidden" name="nmr_buku" value="<?= $data['tb_kd_buku']?>">
<input type="hidden" name="total_buku" value="<?= $data['tb_stok_peminjaman']?>">
<input type="hidden" name="tgl_peminjam" value="<?= $data['date_peminjaman']?>">
<input type="hidden" name="tgl_kembali" value="<?= $data['tb_kembali']?>">
<input type="hidden" name="tagihan" value="<?= formatRupiah($totalDenda) ?>">
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
        background-color: #fff;
        color: black;
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
 


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script type="text/javascript" src="scanner/js/jquery.js"></script>
  <script type="text/javascript" src="scanner/js/qrcodelib.js"></script>
  <script type="text/javascript" src="scanner/js/webcodecamjquery.js"></script>
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