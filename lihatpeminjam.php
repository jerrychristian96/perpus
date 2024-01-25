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
  $_POST['kd_bo'];
  $get_data = mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$id'");
  $data = mysqli_fetch_array($get_data);

      $pengembalian = mysqli_query($conn, "SELECT * FROM `tb_pengembalian` where tb_kod_buku='". $_POST['kd_bo']."'");

  
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
<div class="row m-2 mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-capitalize font-italic">Book Borrowing Table</h5>
                <a class="ml-auto btn btn-danger mb-2" href="buku.php">Back</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name Traines</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Borrowing date</th>
                            <th scope="col">Return Date</th>
                           
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
                        function nama_($traines_)
                        {
                          global $conn;
                          $sqly1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$traines_'"));
                          return $sqly1['Nama_traines'];
                        }
                        foreach ($pengembalian as $data) :?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= nama_($data['tb_nip']); ?></td>
                                <td><?= nama($data['tb_kod_buku']); ?></td>
                                <td><?= $data['tb_tanggal_pinjam']; ?></td>
                                <td>
                                    <?= $data['date']; ?>
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
