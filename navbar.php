<style>
    .tombol{
        color: #001B79;
    }
    .tombol:hover{
        color: #fff;
        background-color: #001B79;
        animation: shawdo;
    }
    .logout{
        color: #fff;
    }
    .logout:hover{
        color: red;
        background-color: #fff;
    }
</style>

<nav class="navbar navbar-expand-md fixed-top">
    <h1 class="font-weight-bold font-italic" href="#">Library</h1>

    <!-- Hamburger button for mobile -->
    <button class="navbar-toggler btn-danger navbar-dark bg-dark" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>

    <!-- Navigation links -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item text-biru">
                <a class="nav-link btn btn-light tombol font-weight-bold" href="peminjaman.php">Borrow Book</a>
            </li>
         

            <div class="btn-group nav-item">
                <a href="buku.php" type="button" class="nav-link btn btn-light tombol font-weight-bold">Book Catalogue</a>
                <button type="button" class="nav-link btn btn-light text-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" data-reference="parent">
                <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <?php
                        $dropdown = mysqli_query($conn,"SELECT * FROM `tb_kategori`");
                        while ($dropdown_ = mysqli_fetch_array($dropdown)){ ?>
                        <form action="buku.php" method="post">
                            <button class="dropdown-item tombol" type="submit" name="kat" value="<?= $dropdown_['kategori'] ?>"><?= $dropdown_['kategori'] ?></button>
                        </form>
                    <?php    }
                    ?>
                </div>
             </div>



            <li class="nav-item">
                <a class="nav-link btn btn-light tombol font-weight-bold" href="pengembalian.php">Returned Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger logout font-weight-bold " href="keluar.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

