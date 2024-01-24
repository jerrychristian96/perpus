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
      }