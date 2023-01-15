<?php
    // Menjalankan session
    session_start();

    // Jika tidak ada session login
    if( !isset($_SESSION["login"]) ) {
        // Maka keluarkan user ke halaman login
        header("Location: ../login.php");
        exit;
    }

    require '../functions.php';

    // Mengecek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) { 

        // var_dump($_POST); die;

        // Mengecek apakah data berhasil ditambahkan atau tidak
        if( tambah_alternatif($_POST) > 0 ) {
            echo "<script>
                        alert('Data berhasil ditambahkan');
                        document.location.href = 'alternatif.php';
                  </script>";
        } else {
            echo "<script>
                        alert('Data gagal ditambahkan');
                        document.location.href = 'alternatif.php';
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
 
 
     $alternatif = query("SELECT * FROM alternatif LIMIT $awalData, $jumlahDataPerHalaman");
 
     // Jika tombol cari ditekan
     if( isset($_POST["cari"]) ) {
 
         // Maka jalankan pencarian keyword
         $alternatif = cari_alternatif($_POST["keyword"]);
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
                     <h1 class="h3 mb-2 text-gray-800">Halaman Data Alternatif</h1>
                    <p class="mb-4">Halaman untuk menentukan alternatif yang akan digunakan ke dalam perhitugan sistem pendukung keputusan.</p>

                    <form method="post" action="">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nama_alternatif" >Nama Alternatif : </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nama_alternatif" id="nama_alternatif" auto required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>  
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="no_hp">Nomor Handphone : </label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" name="no_hp" id="no_hp" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="pendidikan_terakhir">Pendidikan Terakkhir : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" required>
                                        <option value="tidak sekolah">Tidak Sekolah</option>
                                        <option value="sd/sederajat">SD/Sederajat</option>
                                        <option value="smp/sederajat">SMP/Sederajat</option>
                                        <option value="sma/sederajat">SMA/Sederajat</option>
                                        <option value="diploma 1/2/3">Diploma I/II/III</option>
                                        <option value="diploma 4/strata 1">Diploma IV/Strata I</option>
                                        <option value="strata 2">Strata II</option>
                                        <option value="strata 3">Strata III</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="keahlian">Keahlian : </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keahlian" id="keahlian" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tugas">Tugas : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="tugas" id="tugas" required>
                                        <option value="guru mata pelajaran">Guru Mata Pelajaran</option>
                                        <option value="guru agama">Guru Agama</option>
                                        <option value="guru bimbingan konseling">Guru Bimbingan Konseling</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="asal">Asal : </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="asal" id="asal" required>
                                            <option value="guru pns">Guru PNS</option>
                                            <option value="guru non-pns">Guru Non-PNS</option>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
                        </div>
                        <div class="card-body">

                        

                        <form action="" method="post" class="d-none d-sm-inline form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Cari data user"
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
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Handphone</th>
                                            <th>Pendidikan Terakhir</th>
                                            <th>Keahlian</th>
                                            <th>Tugas</th>
                                            <th>Asal</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                      <?php $no = 1 ?>
                                      <?php foreach($alternatif as $data) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data["nama_alternatif"] ?></td>
                                            <td><?= $data["jenis_kelamin"] ?></td>
                                            <td><?= $data["no_hp"] ?></td>
                                            <td><?= $data["pendidikan_terakhir"] ?></td>
                                            <td><?= $data["keahlian"] ?></td>
                                            <td><?= $data["tugas"] ?></td>
                                            <td><?= $data["asal"] ?></td>
                                            <td>
                                              <a href="update_data_alternatif.php?id_alternatif=<?= $data["id_alternatif"] ?>" >
                                                <svg class="mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.  5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                              </svg>
                                              </a>
                                              <a href="hapus_data_alternatif.php?id_alternatif=<?= $data["id_alternatif"]; ?>" onclick="return confirm('yakin ?'); ">
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