<?php
include '../database/database.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('D - M / Y');

include 'role.php';
?>
<!DOCTYPE html>
<html lang="en">
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
                    <h5 class="card-title">Total books</h5>
                   <?php  $totalbuku = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(tb_stok_buku) AS jumlah FROM `tb_buku`")); ?>
                   <h3 class="font-weight-bold"><?= $totalbuku['jumlah']; ?></h3>
                  </center>
                  <!-- <a href="#" class="btn btn-primary rounded-20">Lihat</a> -->
                </div>
              </div>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <h5 class="card-title">PEMINJAMAN</h5>
                  <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                  <a href="#" class="btn btn-primary rounded-20">Lihat</a>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
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
              <h2 class="az-dashboard-title">Kategori</h2>
              <!-- <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
            </center>
          </div>
          <hr class="bg-primary">


          <div class="row m-2">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mengenai Hayat</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mengenai Alkitab</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mengenai Kebenaran</h5>
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
