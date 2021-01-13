<?php
require 'library.php';

//transit
$id=$_GET['id'];
$update = $_GET['update'];
//db
$datahewan = query("SELECT * FROM hewan");
$dataid = query("SELECT * FROM hewan WHERE id=$id")[0];

//button
if(isset($_POST['tambah'])){
  if(input($_POST)>0){
        header('location:satwa.php');
        exit;
  }else{
      echo "<script>alert('Gagal Ditambahkan')</script>";
  }
}

if(isset($_POST['delete'])){
    if(delete($id)>0){
        header('location:satwa.php');
        exit;
    }else{
        echo "<script>alert('Gagal Dihapus')</script>";
    }
    
}


if(isset($_POST['update'])){
    if(update($_POST)>0){
        header('location:satwa.php');
        exit;
    }else{
        echo "<script>alert('Update Gagal')</script>";
    }
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>STTA ZOO</title>
    <link rel="stylesheet" href="style.css">
    <style>
        ul li{
                list-style-type: none;
                }
    </style>
  </head>
  <body>
      <div class="fixed-top">
      <div class="">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="#" style="color:green; font-size: 30px;">
                    <img src="img/hmf.png" width="50" height="50" >
                    Informatic Zoo

              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <strong>
                                    <a class="nav-link active" aria-current="page" href="index.html" >Home</a>
                                     </strong>
                                </li>
                                <li class="nav-item">
                                    <strong>
                                        <a class="nav-link active" aria-current="page" href="about.html" >Tentang Kami</a>
                                    </strong>
                                </li>
                                <li class="nav-item">
                                    <strong>
                                        <a class="nav-link active" aria-current="page" href="#">Satwa</a>
                                    </strong>
                                </li>
                        </ul>
                    </div>
            </div>
          </nav>
      </div>
    </div>

    <div class="navbarsatwa2">
    <div class="position-sticky" style="top:10rem">
        <nav class="navbar navbar-light bg-light">
            <form class="container-fluid justify-content-start">
                <button class="btn btn-outline-success me-2" type="button">Main button</button>
                <button class="btn btn-sm btn-outline-secondary" type="button">Smaller button</button>
            </form>
    </nav>
    </div>
    </div>

   <div class="input">
        <h2>Tambahkan Satwa</h2>
        <form method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <div class="form-floating mb-3">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example" name="nama_satwa" autofocus required>
                    <label for="floatingInput">Nama Satwa</label>
                </div>
            </li>
            <li>
                <div class="form-floating mb-3">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example" name="makanan" autofocus required>
                    <label for="floatingInput">Makanan</label>
                </div>
            </li>
            <li>
                <div class="form-floating mb-3">
                <input class="form-control form-control-lg harga" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example" name="jenis_hewan" required>
                    <label for="floatingInput">Jenis Hewan</label>
                </div>
            </li>
            <li>
                <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="gambar" required>
                </div>
            </li>
            <button type="submit" name="tambah" class="btn btn-primary">Tambahkan</button>
        </ul>
        </form>
   </div>

   <?php foreach($datahewan as $data ) :?>
<div class="posisitampilsatwa">
    <div class="tampilsatwa">
                 <div class="card" style="width: 18rem;">
                 <img src="img/<?= $data['gambar']; ?>" class="card-img-top" width="60px" height="150px">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['nama_hewan']; ?></h5>
                        <p class="card-text"><?= $data['makanan'];?></p>
                        <p class="card-text"><?= $data['jenis_hewan'];?></p>
                        <form method="post" action="?id=<?= $data['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            <a type="button" href="?id=<?= $data['id']; ?>&&update=2"  class="btn btn-success">Update</a>
                        </form>
                    </div>
                </div>
    </div>
</div>
<?php endforeach; ?>

<?php if($update == 2) : ?>
<div class="update">
<div class="input">
        <h2>Ubah Data Satwa</h2>
        <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="gambarlama" value="<?= $dataid['gambar']; ?>">
        <ul>
            <li>
                <div class="form-floating mb-3">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example" name="nama_satwa" value="<?= $dataid['nama_hewan'] ?>" autofocus required>
                    <label for="floatingInput">Nama Satwa</label>
                </div>
            </li>
            <li>
                <div class="form-floating mb-3">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example" name="makanan"value="<?= $dataid['makanan'] ?>" autofocus required>
                    <label for="floatingInput">Makanan</label>
                </div>
            </li>
            <li>
                <div class="form-floating mb-3">
                <input class="form-control form-control-lg harga" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example" name="jenis_hewan"value="<?= $dataid['jenis_hewan'] ?>" required>
                    <label for="floatingInput">Jenis Hewan</label>
                </div>
            </li>
            <li>
                <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="gambar">
                </div>
            </li>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </ul>
        </form>
   </div>
   </div>
   <?php endif; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>
