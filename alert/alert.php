<style>
  .small-alert {
  width: 200px; /* Sesuaikan dengan lebar yang diinginkan */
  /* height: 100px; */
  font-size: 8px;
  color: red; 
  background-color: #D8D8D8;
}
</style>

<?php

  if (isset($cekdata)) { ?>

<script>
     Swal.fire({
  position: "small",
  icon: "success",
  title: "Perubahan berhasil disimpan",
  showConfirmButton: false,
  timer: 1500
}).then(() => {
        // Redirect to another page
        window.location.href = '../template/detailbuku.php?kd_buku=<?= $cekdata ?>';
    });

    </script>

  <?php unset($cekdata);
  } elseif (isset($datagagal)) { ?>

    <script>
         Swal.fire({
      position: "small",
      icon: "error",
      title: "Perubahan berhasil disimpan",
      showConfirmButton: false,
      timer: 1500
    }).then(() => {
            // Redirect to another page
            window.location.href = '../template/detailbuku.php?kd_buku=<?= $cekdata ?>';
        });
    
        </script>
    
      <?php unset($datagagal);
      } elseif (isset($alert)) { ?>

<script>
  Swal.fire({
  position: "smallS",
  icon: "error",
  title: "Your Nip Is Not Registered",
  showConfirmButton: false,
  timer: 3200,
  customClass: {
    popup: 'small-alert', // Menambahkan kelas CSS khusus untuk mengatur ukuran alert
  },
});
    </script>
        
          <?php unset($alert);
          }