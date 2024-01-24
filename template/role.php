<?php
error_reporting(0);
session_start();
$hari_ini = date('Y-m-d');
if (!isset($_SESSION['id'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus masukan NIP terlebih dahulu!');
  window.location = '../index.php'
</script>";
} else {
  $id = $_SESSION['id'];
  $admin = mysqli_query($conn, "SELECT * FROM `tb_admin` WHERE nip='$id'");
  $dataadmin = mysqli_fetch_array($admin);

}