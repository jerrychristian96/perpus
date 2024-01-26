<?php
include '../database/database.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('D - M / Y');


include 'role.php';
?>
<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
include 'header.php';
?> 
 <script>
        function updateClock() {
            var waktuElement = document.getElementById('waktu');
            var waktuSekarang = new Date();
            var waktuFormatted = waktuSekarang.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
            waktuElement.innerHTML = waktuFormatted;
        }
        setInterval(updateClock, 1000);
  </script>

  <body>
<?php
include 'navbar.php';

?> 

  
    <div class="jr-content mt-5 jr-content-dashboard">
      <div class="container">
        <div class="jr-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Welcome back!</h2>
              <p class="az-dashboard-text">{ <?= $dataadmin['Nama']?> }</p>
            </div>
            <div class="jr-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>time now</label>
                  <?php  $waktu_sekarang = date('H:i:s'); ?>
                  <h6 id="waktu"></h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>current date</label>
                  <h6><?= $hari_ini; ?></h6>
                </div><!-- media-body -->
              </div><!-- media -->
             
              <!-- <button class="btn btn-warning rounded-10 shadow font-weight-bold hover">Cek Data</button> -->
            </div>
          </div><!-- az-dashboard-one-title -->

          <div class="row">
            <div class="col-sm-2 mb-2 mb-sm-0 ">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <center>
                    <h5 class="card-title">Total books available</h5>
                   <?php  $totalbuku = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(tb_stok_buku) AS jumlah FROM `tb_buku`")); ?>
                   <h3 class="font-weight-bold"><?= $totalbuku['jumlah']; ?></h3>
                  </center>
                  <!-- <a href="#" class="btn btn-primary rounded-20">Lihat</a> -->
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <center>
                    <?php  $totalpeminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_peminjaman) as peminjaman FROM `tb_peminjaman`")); ?>
                    <h5 class="card-title">Total book borrowings</h5>
                    <h3 class="font-weight-bold"><?= $totalpeminjaman['peminjaman']; ?></h3>
                  </center>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <center>
                  <?php  $totalkembali = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(tb_stok_buku_kembali) as kembali FROM `tb_pengembalian`")); ?>
                    <h5 class="card-title">Total book returns</h5>
                    <h3 class="font-weight-bold"><?= $totalkembali['kembali']; ?></h3>
                  </center>
                 
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <h5 class="card-title">PENGEMBALIAN</h5>
                  <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                  <a href="#" class="btn btn-primary rounded-20">Lihat</a>
                </div>
              </div>
            </div>

          </div>
          <hr class="bg-primary">
          <div class="mb-2">
            <center>
              <h2 class="az-dashboard-title">Book lending chart</h2>
              <!-- <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
            </center>
          </div>
          <hr class="bg-primary">
          <div class="row m-2 mt-3">
            <form action="" class="form-inline" method="post">
            <input type="date" name="awal" class="form-control mr-2 col-4 rounded-10" required>
            <input type="date" name="akhir" class="form-control col-4 rounded-10 mr-2" required>
            <button type="submit" name="view" class="btn btn-primary rounded-10">View</button>
          </form>
          <style>
            .reset{
              margin-left: -30px;
            }
          </style>
          <a href="index.php" class="btn reset btn-danger rounded-10">Reset</a>
            <canvas id="myChart" width="300" height="150"></canvas>

          <script>
    // Inisialisasi array untuk data grafik
    var data = {
      labels: [],
      datasets: [{
        label: 'Peminjaman',
        backgroundColor: '#11009E',
        borderColor: '#525CEB',
        borderWidth: 2,
        data: [],
      }]
    };

    // Mengambil data dari PHP (koneksi ke database)
    <?php
   
    function nama_($traines_)
    {
       global $conn;
         $sqly1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$traines_'"));
         return $sqly1['Nama_traines'];
     }
     if(isset($_POST['view'])){
      $awal_ = $_POST['awal'];
      $akhir_ = $_POST['akhir'];
      $result = mysqli_query($conn, "SELECT tb_nip, SUM(tb_stok_peminjaman) as total FROM `tb_peminjaman` where date_peminjaman between '$awal_' and '$akhir_' GROUP BY tb_nip");
    } else{
      $result = mysqli_query($conn, "SELECT tb_nip, SUM(tb_stok_peminjaman) as total FROM `tb_peminjaman` GROUP BY tb_nip");

    }
    while ($row = mysqli_fetch_assoc($result)) {
        echo "data.labels.push('" . nama_($row['tb_nip']) . "');\n";
        echo "data.datasets[0].data.push(" . $row['total'] . ");\n";
    }
    ?>

    // Konfigurasi grafik
    var options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    // Inisialisasi grafik
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options
    });
  </script>

          </div>
        
         
          
          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
         
          <hr class="bg-primary">
          <div class="mb-2">
            <center>
              <h2 class="az-dashboard-title">Buku Baru</h2>
              <!-- <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
            </center>
          </div>
          <hr class="bg-primary">



        </div><!-- jr-content-body -->
      </div>
    </div><!-- jr-content -->

    <?php
include 'ft_script.php';
?> 
  
  </body>
</html>
