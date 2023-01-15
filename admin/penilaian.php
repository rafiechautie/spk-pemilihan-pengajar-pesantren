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