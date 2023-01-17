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


    $sql = "SELECT*FROM penilaian INNER JOIN alternatif ON alternatif.id_alternatif=penilaian.id_alternatif";
    $hasil = $conn->query($sql);
    $rows = $hasil->num_rows;

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
                        <h1 class="h3 mb-0 text-gray-800">Halaman Perhitungan</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">MATRIX X</h6>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
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
                                    if ($rows > 0) {
                                        while ($row = $hasil->fetch_row()) {

                                    ?>
                                      <!-- <?php //$no = 1 ?>                                  
                                      <?php //foreach($penilaian as $data) : ?> -->
                    
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row[8] ?></td>
                                            <td><?= $row[2] ?></td>
                                            <td><?= $row[3] ?></td>
                                            <td><?= $row[4] ?></td>
                                            <td><?= $row[5] ?></td>
                                            <td><?= $row[6] ?></td>
                                        </tr>
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
                                    <tr>";
                                } ?>
                                        <!-- <?php //$no++ ?>
                                        <?php //endforeach ?>                                      -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">NORMALISASI</h6>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
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
                                    
                                    if($rows>0){
                                        $minimum_absensi = 0;
                                        $maximum_kecakapan_sosial = 0;
                                        $maximum_kecakapan_kepribadian = 0;
                                        $maximum_kecakapan_pedagogis = 0;
                                        $maximum_sikap_inklusif = 0;
                                    
    
                                        //Absensi (Cost), cari value yang paling kecil dibagi dengan setiap nilai di setiap alternatif
                                        $sql = "SELECT*FROM penilaian ORDER BY absensi_kehadiran ASC";
                                        $hasil = $conn->query($sql);
                                        $row = $hasil->fetch_row();
                                        $minimum_absensi = (int) $row[2];
    
                                        // var_dump($minimum_absensi); die;
    
                                        //Kecakapan Sosial (Benefit), cari value yang paling besar. setiap alternatif dibagi dengan value paling besar
                                        $sql = "SELECT*FROM penilaian ORDER BY kecakapan_sosial DESC";
                                        $hasil = $conn->query($sql);
                                        $row = $hasil->fetch_row();
                                        $maximum_kecakapan_sosial = (int) $row[3]; 
    
                                        // var_dump($maximum_kecakapan_sosial); die;
    
                                        //Kecakapan Kepribadian, cari value yang paling besar. setiap alternatif dibagi dengan value paling besar
                                        $sql = "SELECT*FROM penilaian ORDER BY kecakapan_kepribadian DESC";
                                        $hasil = $conn->query($sql);
                                        $row = $hasil->fetch_row();
                                        $maximum_kecakapan_kepribadian = (int) $row[4];  
    
                                        //Kecakapan Pedagogis, cari value yang paling besar. setiap alternatif dibagi dengan value paling besar
                                        $sql = "SELECT*FROM penilaian ORDER BY kecakapan_pedagogis DESC";
                                        $hasil = $conn->query($sql);
                                        $row = $hasil->fetch_row();
                                        $maximum_kecakapan_pedagogis = (int) $row[5];   
    
                                        //Sikap Inklusif, cari value yang paling besar. setiap alternatif dibagi dengan value paling besar
                                        $sql = "SELECT*FROM penilaian ORDER BY sikap_inklusif DESC";
                                        $hasil = $conn->query($sql);
                                        $row = $hasil->fetch_row();
                                        $maximum_sikap_inklusif = (int) $row[5];   
                                    }else {
                                        echo "<tr>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                        <tr>";
                                    }

                                    $no = 1;
                                    $sql = "SELECT*FROM penilaian INNER JOIN alternatif ON alternatif.id_alternatif=penilaian.id_alternatif";
                                    $hasil = $conn->query($sql);
                                    $rows = $hasil->num_rows;
                                    if ($rows > 0) {
                                        while ($row = $hasil->fetch_row()) {

                                            // var_dump($row); die;
                                    
                                    ?>                                      
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row[8] ?></td>
                                            <td><?= round($minimum_absensi / $row[2] , 2) ?></td>
                                            <td><?= round($row[3] / $maximum_kecakapan_sosial, 2) ?></td>
                                            <td><?= round($row[4] / $maximum_kecakapan_kepribadian, 2) ?></td>
                                            <td><?= round($row[5] / $maximum_kecakapan_pedagogis, 2) ?></td>
                                            <td><?= round($row[6] / $maximum_sikap_inklusif, 2) ?></td>
                                        </tr>
                                        <?php }
                                }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">NILAI PREFERENSI</h6>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alternatif</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    
                                    $bobot_kriteria1 = 0;
                                    $bobot_kriteria2 = 0;
                                    $bobot_kriteria3 = 0;
                                    $bobot_kriteria4 = 0;
                                    $bobot_kriteria5 = 0;
                                    $B7 = '';
                                    $total_penilaian_alternatif = 0.0;
                                    $id_alternatif = 0;
                                    $x = 0;
                                    $sql = "SELECT * FROM kriteria";
                                    $hasil = $conn->query($sql);
                                    $rows = $hasil->num_rows;
                                    if ($rows > 0) {
                                        $row = $hasil->fetch_row();
                                        $bobot_kriteria1 = $row[1];
                                        $bobot_kriteria2 = $row[2];
                                        $bobot_kriteria3 = $row[3];
                                        $bobot_kriteria4 = $row[4];
                                        $bobot_kriteria5 = $row[5];
                                        
                                    }
                                    // var_dump($bobot_kriteria5);die;

                                    // var_dump($bobot_kriteria1); die;

                                    $sql = "TRUNCATE TABLE perankingan";
                                    $hasil = $conn->query($sql);


                                    $sql = "SELECT * FROM penilaian INNER JOIN alternatif ON alternatif.id_alternatif=penilaian.id_alternatif";
                                    $hasil = $conn->query($sql);
                                    $rows = $hasil->num_rows;
                                    if ($rows > 0) {
                                        while ($row = $hasil->fetch_row()) {
                                            // var_dump($row); die;

                                            $total_penilaian_alternatif = round((( $minimum_absensi / $row[2]) * $bobot_kriteria1) +
                                            (($row[3] / $maximum_kecakapan_sosial) * $bobot_kriteria2) +
                                            (($row[4] / $maximum_kecakapan_kepribadian) * $bobot_kriteria3) +
                                            (($row[5] / $maximum_kecakapan_pedagogis) * $bobot_kriteria4) +
                                            (($row[6] / $maximum_sikap_inklusif) * $bobot_kriteria5), 3);

                                            $id_alternatif = $row[1];
                                            $sql1 = "INSERT INTO perankingan(id_alternatif,nilai_akhir) VALUES ('" . $id_alternatif . "','" . $total_penilaian_alternatif . "')";
                                            $hasil1 = $conn->query($sql1);
                                        }
                                    }


                                    ?>
                                    <?php 
                                    
                                    //$perankingan = query("SELECT * FROM perankingan INNER JOIN alternatif ON alternatif.id_alternatif=perankingan.id_alternatif");
                                    
                                    $sql = "SELECT * FROM perankingan INNER JOIN alternatif ON alternatif.id_alternatif=perankingan.id_alternatif";
                                    $hasil = $conn->query($sql);
                                    $rows = $hasil->num_rows;
                                    if ($rows > 0) {
                                        while ($row = $hasil->fetch_row()) {
                                            // var_dump($row);
                                    ?>
                                      <?php $no = 1 ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row[4] ?></td>
                                            <td><?= $row[2]?></td>
                                        </tr>
                                        <?php }
                                        } else {
                                            echo "<tr>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                                <td>Data Tidak Ada</td>
                                            <tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">PERANKINGAN</h6>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alternatif</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    
                                    //$perankingan = query("SELECT * FROM perankingan INNER JOIN alternatif ON alternatif.id_alternatif=perankingan.id_alternatif ORDER BY nilai_akhir DESC");
                                    $sql = "SELECT*FROM perankingan INNER JOIN alternatif ON alternatif.id_alternatif=perankingan.id_alternatif ORDER BY nilai_akhir DESC";
                                    $hasil = $conn->query($sql);
                                    if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {

                                    ?>
                                      <?php $no = 1 ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row[4] ?></td>
                                            <td><?= $row[2]?></td>
                                        </tr>
                                        <?php }
                                    } else {
                                        echo "<tr>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                            <td>Data Tidak Ada</td>
                                        <tr>";
                                    } ?>
                                    </tbody>
                                </table>
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