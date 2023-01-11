<?php
    // Menjalankan session
    session_start();

    // Jika tidak ada session login
    if( !isset($_SESSION["signin"]) ) {
        // Maka keluarkan user ke halaman login
        header("Location: ../login.php");
        exit;
    }

    // Menyiapkan data yang akan disimpan ke dalam tabel
    // Menghubungkan functions ke dalam file
    require '../functions.php';

    // Query data mahasiswa disimpan ke dalam variabel mahasiswa dan bentuknya array
    // ASC / Ascending (Membesar)
    // DESC / Descending (Mengecil)
    // $mahasiswa = query("SELECT * FROM mahasiswa");

    // Jika tombol cari ditekan
    // if( isset($_POST["cari"]) ) {

    //     // Maka jalankan pencarian keyword
    //     $mahasiswa = cari($_POST["keyword"]);
    // } 
?>


<!doctype html>
<html lang="en">
  <?php include '../components/head.php'; ?>
  <body>

  <?php include '../components/navbar_penilai.php'; ?>

<div class="container-fluid">
  <div class="row">
    <?php include '../components/sidebar_penilai.php' ?>

    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat datang di Dashboard Penilai</h1>
      </div>
    </main>
  </div>
</div>


    <script src="../assests/boostrap/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../boostrap/js/dashboard.js"></script>
  </body>
</html>
