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
  $get_data_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` WHERE tb_kode_buku='$kodebuku'");
  $data_buku = mysqli_fetch_array($get_data_buku);
  $get_data = mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$id'");
  $data = mysqli_fetch_array($get_data);
  if (isset($_POST['cari'])){
    $awal = $_POST['date_awal'];
    $akhir = $_POST['date_akhir'];
    $pengembalian = mysqli_query($conn, "SELECT * FROM `tb_pengembalian` where tb_nip='$id' and date between '$awal' and '$akhir'");
} else {
      $pengembalian = mysqli_query($conn, "SELECT * FROM `tb_pengembalian` where tb_nip='$id'");

  }
}
?>
<!DOCTYPE html>
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
?>
    <form action="" method="post">
    <div class=" ml-4 mt-3 form-inline">
              <input type="date" name="date_awal" class="form-control col-2 rounded-10 shadow mr-2">
              <input type="date" name="date_akhir" class="form-control col-2 rounded-10 shadow mr-2">
              <button type="submit" name="cari" class="btn btn-primary rounded-10 shadow">Show</button>
              <a href="pengembalian.php" class="btn btn-danger rounded-10 ml-2 shadow">Reset</a>
            </form>
    </div>


<div class="row m-2 mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-capitalize font-italic">Book Return Table</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Book</th>
                            <th scope="col">Borrowing date</th>
                            <th scope="col">Number of Books</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Late fees</th>
                            <th scope="col">Return Date</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        function nama($nama_buku)
                        {
                            global $conn;
                            $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE tb_kode_buku='$nama_buku'"));
                            return $sqly['tb_judul_buku'];
                        }
                        foreach ($pengembalian as $data) :?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= nama($data['tb_kod_buku']); ?></td>
                                <td><?= $data['tb_tanggal_pinjam']; ?></td>
                                <td><?= $data['tb_stok_buku_kembali']; ?>
                                    <?php
                                    ?>
                                </td>
                                <td>
                                    <?= $data['tb_tanggal_akhir_kembali']; ?>
                                </td>
                                <td>
                                    <?= $data['tb_denda']; ?>
                                </td>
                                <td>
                                    <?= $data['date']; ?>
                                </td>
                                <td>
                                    <span class="badge badge-warning"> <?= $data['status_denda']; ?></span>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
<?php
include 'fotter.php';
?>
</html>
