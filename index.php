<?php
include 'database/database.php';
session_start();
if (isset($_POST['login'])) {
    $nip = htmlspecialchars($_POST['nip']);
    $sql = "SELECT * FROM tb_trainee WHERE nip_traines ='$nip'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['id'] = $row['nip_traines'];
      if ($result) {
        header("Location: peminjaman.php");
      } 
    } else{
        $alert = $_SESSION['datagagal']="SJS";
      }


    
    $sqli = "SELECT * FROM tb_admin WHERE nip ='$nip'";
    $result1 = mysqli_query($conn, $sqli);
    if ($result1->num_rows > 0) {
      $row1 = mysqli_fetch_assoc($result1);
      $_SESSION['id'] = $row1['nip'];
      if ($result1) {
        header("Location: template/index.php");
      }
    }


    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <title>FTTI | Library</title>
    <style>
        body {
            position: relative;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: black; /* Warna hitam */
            opacity: 0.8; /* Tingkat transparansi (0.5 sebagai contoh) */
            z-index: -1; /* Menempatkan lapisan di belakang gambar latar belakang */
        }

        body {
            background-image: url('img/perpustakaan.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: cover;
            color: white;
            padding: 20px;
        }

        h1 {
            margin-top: 200px;
            text-align: center;
        }

        .custom-container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="transparan-bg">
    <nav class="navbar navbar-expand-lg ">
        <h2 class="navbar-brand font-weight-bold" >FULL TIME TRAINING INDONESIA</h2>
       
    </nav>

    <div class="container custom-container">
        <h1 class="font-weight-bold font-italic text-capitalize text-light mb-3">library</h1>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="nip" class="form-control shadow rounded-20" placeholder="Enter your NIP" required>
            </div>
            <button type="submit" name="login" class="btn btn-info btn-block shadow rounded-10 mt-2">Login</button>
        </form>
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    <?php
include 'alert/alert.php';
    ?>
</body>
</html>
