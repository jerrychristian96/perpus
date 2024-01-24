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
      $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_peminjaman`) As id FROM `tb_peminjaman` WHERE date_peminjaman=date(now()) AND tb_kd_buku='$kodebuku'"));
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
      .navbar{
        background-color: #001B79;
        
      }
      .md{
        background-color: #001B79;
        
      }
      body{
        background-color: #F5F5F5;
        
      }
      thead{
        background-color: #001B79;
        color: #FFFFFF;
        

      }
      canvas {
      height: 250px;
      width: 100%;
      border-radius: 10px;
      margin-right: 10px;
    }

    .formscaner {
      height: 450px;
    }

    /* .formdailypresence {
      height: 450px;
    } */

    /* .today {
      height: 450px;
    } */

    body {
      height: 800px;
      width: 100%;
      background-color: #DCF2F1;

    }

    @media screen and (max-width: 575px) {

      canvas {
        height: 170px;
        width: 250px;
        border-radius: 10px;

      }
    }
    </style>
    
  </head>
  <body>
 <?php
include 'navbar.php';
?>
  

<div class="row m-2 mt-3">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-capitalize font-italic">Tabel Peminjaman Buku</h5>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Buku</th>
      <th scope="col">Tanggal Peminjam</th>
      <th scope="col">Jumlah Buku</th>
       <th scope="col">Tanggal Kembali</th>
       <th scope="col">Denda</th>
      <th scope="col">Aksi</th>
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
  foreach ($peminjam  as $data) :?>
    <tr>
      <th scope="row"><?= $i;?></th>
      <td><?= $data['tb_kd_buku'];?></td>
      <td><?= $data['date_peminjaman'];?></td>
      <td><?= $data['tb_stok_peminjaman'];?></td>
      <td>
        <?php
        $start_date = new DateTime($data['date_peminjaman']);
         // Buat rentang tanggal dengan interval 14 hari
         $last_date = clone $start_date;
         $last_date->add(new DateInterval('P14D')); 
        mysqli_query($conn, "UPDATE `tb_peminjaman` SET `tb_kembali`='".$last_date->format('Y-m-d')."' WHERE  `id_peminjaman`='".$data['id_peminjaman']."'"); ?>
    <?= $data['tb_kembali'];?>
    </td>
     <td>
     <?php
// Tanggal jatuh tempo pembayaran (misalnya dari database)
$tanggal_jatuh_tempo = $data['tb_kembali'];

// Tanggal pembayaran yang seharusnya dilakukan (misalnya dari input atau database)
$tanggal_pembayaran = $hari_ini;

// Mengubah string tanggal menjadi objek DateTime
$tanggal_jatuh_tempo_obj = new DateTime($tanggal_jatuh_tempo);
$tanggal_pembayaran_obj = new DateTime($tanggal_pembayaran);

// Menghitung selisih hari
$selisih_hari = $tanggal_jatuh_tempo_obj->diff($tanggal_pembayaran_obj)->days;

function formatRupiah($nilai) {
  return "Rp: " . number_format($nilai, 0, ',', '.');
}
// Tarif denda per hari
$tarif_denda_per_hari = 1000;



// Menghitung total denda
$total_denda = max(0, $selisih_hari) * $tarif_denda_per_hari;

// Menampilkan total denda
echo "Total ". formatRupiah($total_denda);
?>

</td>
<td>
  <?php
 

if($data['tb_denda'] <= 0){ ?>
<form action="" method="post">
<input type="hidden" name="idpeminjam" value="<?= $data['id_peminjaman']?>">
<input type="hidden" name="nmr_buku" value="<?= $data['tb_kd_buku']?>">
<input type="hidden" name="total_buku" value="<?= $data['tb_stok_peminjaman']?>">
<input type="hidden" name="tgl_peminjam" value="<?= $data['date_peminjaman']?>">
<input type="hidden" name="tgl_kembali" value="<?= $data['tb_kembali']?>">
<input type="hidden" name="tagihan" value="<?= formatRupiah($total_denda) ?>">
  <button type="submit" name="bayar"  class="btn btn-sm btn-success">Kembalikan</button>
</form>



<?php } else { 
 $pengembalianbuku = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `tb_pengembalian` where tb_nip='$id' and tb_kod_buku='".$data['tb_kd_buku']."' and tb_tanggal_pinjam='".$data['date_peminjaman']."' and tb_tanggal_akhir_kembali='".$data['tb_kembali']."'"));
  if($pengembalianbuku == 0){ ?>
<form action="" method="post">
<input type="hidden" name="idpeminjam" value="<?= $data['id_peminjaman']?>">
<input type="hidden" name="nmr_buku" value="<?= $data['tb_kd_buku']?>">
<input type="hidden" name="total_buku" value="<?= $data['tb_stok_peminjaman']?>">
<input type="hidden" name="tgl_peminjam" value="<?= $data['date_peminjaman']?>">
<input type="hidden" name="tgl_kembali" value="<?= $data['tb_kembali']?>">
<input type="hidden" name="tagihan" value="<?= $data['tb_denda']?>">
  <!-- <button type="submit"  class="btn btn-sm btn-success">Bayar</button> -->
  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#staticBackdrop">
  Bayar
</button>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header md">
        <h5 class="modal-title text-light" id="staticBackdropLabel">Pesan Penting!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class=" font-italic font-weight-bold">Apabila saudara/i mau bayar denda buku, silahkan bayar terlebih dahulu ke Asisten atau ke team perpustakaan, diharapkan agar saudara/i menyediakan uang sesuai denda tersebut</p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="bayar" class="btn btn-warning">Konfirmasi Bayar</button>
      </div>
    </div>
  </div>
</div>

</form>
<?php  } else { ?>
<button>Konfirmasi Hapus</button>
<?php
}
  ?>
<?php }
?>
</td>

    </tr>
    <?php $i++;   endforeach ; ?>
  </tbody>
</table>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <center>

          <h5 class="card-title">Scanner Qr Code</h5>
        </center>
        <canvas></canvas>
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
            let idpeminjam = $(this).data('idpeminjam');
            let tanggalkembali = $(this).data('tanggalkembali');
            $(" #modal-kembali #idpeminjam").val(idpeminjam);
            $(" #modal-kembali #tanggalkembali").val(tanggalkembali);

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