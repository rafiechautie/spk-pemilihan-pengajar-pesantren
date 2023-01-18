<?php
    // Menjalankan session
    session_start();

    // Jika tidak ada session login
    if( !isset($_SESSION["login"]) ) {
        // Maka keluarkan user ke halaman login
        header("Location: ../login.php");
        exit;
    }

    // Menyiapkan data yang akan disimpan ke dalam tabel
    // Menghubungkan functions ke dalam file
    require '../functions.php';

    // Konfigurasi Pagination
    $jumlahDataPerHalaman = 10;
    // $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    // $jumlahData = mysqli_num_rows($result);
    // var_dump($jumlahData);

    $jumlahData = count(query("SELECT * FROM alternatif"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;


    // $penilaian = query("SELECT * FROM penilaian INNER JOIN alternatif ON alternatif.id_alternatif=penilaian.id_alternatif LIMIT $awalData, $jumlahDataPerHalaman");

    // Jika tombol cari ditekan
    if( isset($_POST["cari"]) ) {

        // Maka jalankan pencarian keyword
        $alternatif = cari_penilaian($_POST["keyword"]);
    } 
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../components/head.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../components/sidebar_admin.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../components/navbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Halaman Penilaian</h1>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Penilaian</h6>
                        </div>
                        <div class="card-body">

                        

                        <form action="" method="post" class="d-none d-sm-inline form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Cari Data Penilaian"
                                aria-label="search" aria-describedby="basic-addon2" autofocus autocomplete="off" id="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="cari" id="tombol-cari">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-3">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alternatif</th>
                                            <th>Absensi Kehadiran</th>
                                            <th>Kecakapan Sosial</th>
                                            <th>Kecakapan Kepribadian</th>
                                            <th>Kecakapan Pedagogis</th>
                                            <th>Sikap Inklusif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        <?php

                                        $no = 1;
                                        $sql = "SELECT * FROM penilaian INNER JOIN alternatif ON alternatif.id_alternatif=penilaian.id_alternatif LIMIT $awalData, $jumlahDataPerHalaman";
                                        $hasil = $conn->query($sql);
                                        $rows = $hasil->num_rows;
                                        if ($rows > 0) {
                                            while ($row = $hasil->fetch_row()) 
                                            {

                                                // var_dump($row);die;
                                        ?>
                                        <tr>
                                            <td><?= $no + $awalData ?></td>
                                            <td><?= $row[8] ?></td>
                                            <td><?= $row[2] ?></td>
                                            <td><?= $row[3] ?></td>
                                            <td><?= $row[4] ?></td>
                                            <td><?= $row[5] ?></td>
                                            <td><?= $row[6] ?></td>
                                        </tr>
                                        <?php $no++ ?>
                                        <?php }
                                        } else {
                                            echo "<tr>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                            <tr>";
                                        } ?>
                                    </tbody>
                                </table>
                                <nav aria-label="...">
                                <ul class="pagination">
                                    <!-- Panah Navigasi Leter Then / Laquo -->
                                    <?php if( $halamanAktif > 1 ) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                                        </li>
                                    <?php endif; ?>

                                    <!-- Navigasi -->
                                    <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>

                                    <!-- Jika link nya aktif maka akan dicetak tebal -->
                                    <?php if( $i == $halamanAktif ) : ?>
                                        <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php endif; ?>
                                    <?php endfor; ?>

                                    <!-- Panah Navigasi Gretter Then / Raquo -->
                                    <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                                        <li class="page-item">
                                             <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Sistem Pendukung Keputusan Pemilihan Pengajar Pesantren</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

    <!-- Bootstrap core JavaScript-->
    <script src="../jquery/jquery.min.js"></script>
    <script src="../assests/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../jquery/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>