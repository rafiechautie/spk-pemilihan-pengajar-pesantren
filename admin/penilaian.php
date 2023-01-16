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

    if( isset($_POST["submit"]) ) { 

        if( tambah_penilaian($_POST) > 0 ) {
            echo "<script>
                        alert('Data berhasil ditambahkan');
                        document.location.href = 'penilaian.php';
                  </script>";
        } else {
            echo "<script>
                        alert('Data gagal ditambahkan');
                        document.location.href = 'penilaian.php';
                  </script>";        }

    }

    // Konfigurasi Pagination
    $jumlahDataPerHalaman = 2;
    // $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    // $jumlahData = mysqli_num_rows($result);
    // var_dump($jumlahData);

    $jumlahData = count(query("SELECT * FROM alternatif"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;


    $penilaian = query("SELECT * FROM penilaian INNER JOIN alternatif ON alternatif.id_alternatif=penilaian.id_alternatif LIMIT $awalData, $jumlahDataPerHalaman");

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
                <?php include '../components/navbar_admin.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Halaman Penilaian</h1>
                    </div>

                    
                    <form method="post" action="">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="id_alternatif">Nama Alternatif : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="id_alternatif" id="id_alternatif" required>  
                                    <?php
                                    //load nama
                                    $sql = "SELECT * FROM alternatif";
                                    $hasil = $conn->query($sql);
                                    $rows = $hasil->num_rows;
                                    if ($rows > 0) {
                                        while ($row = mysqli_fetch_assoc($hasil)) :; {
                                        } ?> <option value="<?= $row["id_alternatif"]; ?>"><?php echo $row["nama_alternatif"]; ?></option>
                                    <?php endwhile;
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="absensi_kehadiran">Absensi Kehadiran : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="absensi_kehadiran" id="absensi_kehadiran" required>
                                        <option>(1) Pengajar tidak hadir >30 hari selama 1 tahun</option>
                                        <option>(2) Pengajar tidak hadir 21-30 hari selama 1 tahun</option>
                                        <option>(3) Pengajar tidak hadir 11-20 hari selama 1 tahun</option>
                                        <option>(4) Pengajar tidak hadir 1-10 hari selama 1 tahun</option>        
                                        <option>(5) Pengajar Selalu Hadir</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kecakapan_sosial">Kecakapan Sosial : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="kecakapan_sosial" id="kecakapan_sosial" required>
                                        <option>(1) Sangat Kurang</option>
                                        <option>(2) Kurang</option>     
                                        <option>(3) Cukup</option>  
                                        <option>(4) Baik</option> 
                                        <option>(5) Sangat Baik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kecakapan_kepribadian">Kecakapan Kepribadian : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="kecakapan_kepribadian" id="kecakapan_kepribadian" required>
                                        <option>(1) Sangat Kurang</option>
                                        <option>(2) Kurang</option>     
                                        <option>(3) Cukup</option>  
                                        <option>(4) Baik</option> 
                                        <option>(5) Sangat Baik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kecakapan_pedagogis">Kecakapan Pedagogis : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="kecakapan_pedagogis" id="kecakapan_pedagogis">
                                        <option>(1) Sangat Kurang</option>
                                        <option>(2) Kurang</option>     
                                        <option>(3) Cukup</option>  
                                        <option>(4) Baik</option> 
                                        <option>(5) Sangat Baik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="sikap_inklusif">Sikap Inklusif : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="sikap_inklusif" id="sikap_inklusif">
                                        <option>(1) Sangat Kurang</option>
                                        <option>(2) Kurang</option>     
                                        <option>(3) Cukup</option>  
                                        <option>(4) Baik</option> 
                                        <option>(5) Sangat Baik</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                        <button type="submit" name="submit" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                        </svg>
                             Submit</button>
                        </div>
                    </form>

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
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                      <?php $no = 1 ?>
                                      <?php foreach($penilaian as $data) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data["nama_alternatif"] ?></td>
                                            <td><?= $data["absensi_kehadiran"] ?></td>
                                            <td><?= $data["kecakapan_sosial"] ?></td>
                                            <td><?= $data["kecakapan_kepribadian"] ?></td>
                                            <td><?= $data["kecakapan_pedagogis"] ?></td>
                                            <td><?= $data["sikap_inklusif"] ?></td>
                                            <td>
                                              <a href="hapus_data_penilaian.php?id_penilaian=<?= $data["id_penilaian"]; ?>" onclick="return confirm('yakin ?'); ">
                                                <svg class="ml-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                              </a>
                                            </td>
                                        </tr>
                                        <?php $no++ ?>
                                        <?php endforeach ?>
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