<?php 

    // Menjalankan session
    session_start();

    // Jika tidak ada session login
    if( !isset($_SESSION["login"]) ) {
        // Maka keluarkan user ke halaman login
        header("Location: ../login.php");
        exit;
    }

    // Menghubungkan halaman ubah yang kita punya ke dalam halaman function tempan menyimpan function nya
    require '../functions.php';

    // Mengambil data dari url
    $id = $_GET["id_alternatif"];
    // var_dump($id);

    // Query data mahasiswa berdasarkan id
    $alternatif = query("SELECT * FROM alternatif WHERE id_alternatif = $id")[0];

    // Mengecek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) { 

        // var_dump($_POST);

        // Mengecek apakah data berhasil diubah atau tidak
        if( update_data_alternatif($_POST) > 0 ) {
            echo "<script>
                        alert('Data berhasil diubah');
                        document.location.href = 'alternatif.php';
                  </script>";
        } else {
            echo "<script>
                        alert('Data gagal diubah');
                  </script>";
        }

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
                     <h1 class="h3 mb-2 text-gray-800">Update Data Alternatif</h1>

                    

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary mb-4">Form Update Data Alternatif</h6>
                            <form method="post" action="">
                            <input type="hidden" class="form-control" name="id_alternatif" id="id_alternatif" value="<?= $alternatif["id_alternatif"]; ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nama_alternatif" >Nama Alternatif : </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_alternatif" id="nama_alternatif" value="<?= $alternatif["nama_alternatif"]; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin : </label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>  
                                        <option <?php if($alternatif["jenis_kelamin"]=="laki-laki") echo 'selected="selected"'; ?> value="laki-laki">Laki-laki</option>
                                        <option <?php if($alternatif["jenis_kelamin"]=="perempuan") echo 'selected="selected"'; ?> value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="no_hp">Nomor Handphone : </label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?= $alternatif["no_hp"]; ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="pendidikan_terakhir">Pendidikan Terakkhir : </label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="tidak sekolah") echo 'selected="selected"'; ?> value="tidak sekolah">Tidak Sekolah</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="sd/sederajat") echo 'selected="selected"'; ?> value="sd/sederajat">SD/Sederajat</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="smp/sederajat") echo 'selected="selected"'; ?> value="smp/sederajat">SMP/Sederajat</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="sma/sederajat") echo 'selected="selected"'; ?> value="sma/sederajat">SMA/Sederajat</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="diploma 1/2/3") echo 'selected="selected"'; ?> value="diploma 1/2/3">Diploma I/II/III</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="diploma 4/strata 1") echo 'selected="selected"'; ?> value="diploma 4/strata 1">Diploma IV/Strata I</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="strata 2") echo 'selected="selected"'; ?> value="strata 2">Strata II</option>
                                            <option <?php if($alternatif["pendidikan_terakhir"]=="strata 3") echo 'selected="selected"'; ?> value="strata 3">Strata III</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="keahlian">Keahlian : </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="keahlian" id="keahlian" value="<?= $alternatif["keahlian"]; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tugas">Tugas : </label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="tugas" id="tugas">
                                            <option  <?php if($alternatif["tugas"]=="guru mata pelajaran") echo 'selected="selected"'; ?> value="guru mata pelajaran">Guru Mata Pelajaran</option>
                                            <option  <?php if($alternatif["tugas"]=="guru agama") echo 'selected="selected"'; ?> value="guru agama">Guru Agama</option>
                                            <option  <?php if($alternatif["tugas"]=="guru bimbingan konseling") echo 'selected="selected"'; ?> value="guru bimbingan konseling">Guru Bimbingan Konseling</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="asal">Asal : </label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="asal" id="asal" required>
                                                <option  <?php if($alternatif["asal"]=="guru pns") echo 'selected="selected"'; ?> value="guru pns">Guru PNS</option>
                                                <option  <?php if($alternatif["asal"]=="guru non-pns") echo 'selected="selected"'; ?> value="guru non-pns">Guru Non-PNS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                            <button type="submit" name="submit" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                            </svg>
                                Update</button>
                            </div>
                        </form>
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