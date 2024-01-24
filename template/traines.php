<?php
include '../database/database.php';
include 'role.php';
if (isset($_POST['perubahan'])) {
  $nip_traine_ = $_POST['nip_traine_'];
  $nama_traine_ = $_POST['nama_traine_'];
  $angkatan_ = $_POST['angkatan_'];
  $id__traine = $_POST['id__traine'];
  $traines_perubahan = mysqli_query($conn, "UPDATE `tb_trainee` SET `nip_traines`='$nip_traine_',`Nama_traines`='$nama_traine_',`angkatan_`='$angkatan_' WHERE `id_trainee`='$id__traine'");
  if ($traines_perubahan){
    $cekdata = $_SESSION['cek_data'] = $_POST['kodebuku'];
  }
}
if (isset($_POST['simpan'])) {
  $nip_traine = $_POST['nip_traine'];
  $nama_traine = $_POST['nama_traine'];
  $angkatan = $_POST['angkatan'];
  $traines_ = mysqli_query($conn, "INSERT INTO `tb_trainee`(`nip_traines`, `Nama_traines`, `angkatan_`) VALUES ('$nip_traine','$nama_traine','$angkatan')");
}
$traines = mysqli_query($conn, "SELECT * FROM `tb_trainee` ORDER BY id_trainee DESC");
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
        
          <h2 class="jr-content-title">Trainees</h2>
          <table>
            <thead>
              <tr>
                <th>
                  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3 rounded-10" data-toggle="modal" data-target="#staticBackdrop">
Add Trainees
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title text-light" id="staticBackdropLabel">Add Trainees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <div>
          <label for="">Nip :</label>
          <input type="text" name="nip_traine" class="form-control" required>
        </div>
        <div class="mt-2">
          <label for="">Name :</label>
          <input type="text" name="nama_traine" class="form-control" required>
        </div>
        <div class="mt-2">
          <label for="">Batch :</label>
          <input type="number" name="angkatan" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="simpan" class="btn btn-primary">Save</button>
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
     <th scope="col">Nip</th>
     <th scope="col">Name</th>
     <th scope="col">Batch</th>
     <th scope="col">Actions</th>

   </tr>
 </thead>
 <tbody>
 <?php
      $i = 1;
      foreach ($traines as $row) :
    ?>
   <tr>
  
<td><?= $i; ?></td>
<td><?= $row['nip_traines']; ?></td>
<td><?= $row['Nama_traines']; ?></td>
<td><?= $row['angkatan_']; ?></td>
<td>
<!-- Button trigger modal -->

<a id="edit_siswa" type="button" data-nip="<?= $row['nip_traines']; ?>" data-name="<?= $row['Nama_traines']; ?>" data-batch="<?= $row['angkatan_']; ?>" data-idtraines="<?= $row['id_trainee']; ?>" class="btn btn-warning btn-sm rounded-10" data-toggle="modal" data-target="#edit_traines">
  Edit
</a>

<!-- Modal -->
<div class="modal fade" id="edit_traines" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title text-light" id="edit_siswa">Edit Traines</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-edit">
      <form action="" method="post">
        <div>
          <input type="hidden" name="id__traine" id="idtraines">
          <label for="">Nip :</label>
          <input type="text" name="nip_traine_" class="form-control" id="nip">
        </div>
        <div class="mt-2">
          <label for="">Nama :</label>
          <input type="text" name="nama_traine_" class="form-control" id="name">
        </div>
        <div class="mt-2">
          <label for="">Angkatan :</label>
          <input type="number" name="angkatan_" class="form-control" id="batch">
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="perubahan" class="btn btn-primary rounded-10">Simpan Perubahan</button>
      </div>
      </form>
      
   
    </div>
  </div>
</div>

</td>

     
   </tr>
   <?php $i++; ?>
    <?php endforeach; ?>
 </tbody>
</table>
 
 
 



</div>
</div>

  
       
        

          <div class="ht-40"></div>

        </div><!-- jr-content-body -->
      </div><!-- container -->
    </div><!-- jr-content -->

    <?php
include 'ft_script.php';
include '../alert/alert.php';
?> 

<script>
    $(document).on("click", "#edit_siswa", function() {
      let nip = $(this).data('nip');
      let name = $(this).data('name');
      let batch = $(this).data('batch');
      let idtraines = $(this).data('idtraines');
      $(" #modal-edit #nip").val(nip);
      $(" #modal-edit #name").val(name);
      $(" #modal-edit #batch").val(batch);
      $(" #modal-edit #idtraines").val(idtraines);
    });
</script>
  </body>
</html>
