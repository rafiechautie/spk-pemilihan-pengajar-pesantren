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
                        <h1 class="h3 mb-0 text-gray-800">Halaman Kriteria</h1>
                    </div>

                     <!--START SCRIPT HITUNG-->
                      <script>
                            function fungsiku() {
                              let a = (document.getElementById("absensi_kehadiran_param").value).substring(0, 1);
                              let b = (document.getElementById("kecakapan_sosial_param").value).substring(0, 1);
                              let c = (document.getElementById("kecakapan_kepribadian_param").value).substring(0, 1);
                              let d = (document.getElementById("kecakapan_pedagogis_param").value).substring(0, 1);
                              let e = (document.getElementById("sikap_inklusif_param").value).substring(0, 1);
                              let total = Number(a) + Number(b) + Number(c) + Number(d) + Number(e);
                              document.getElementById("absensi_kehadiran").value = (Number(a) / total).toFixed(2);
                              document.getElementById("kecakapan_sosial").value = (Number(b) / total).toFixed(2);
                              document.getElementById("kecakapan_kepribadian").value = (Number(c) / total).toFixed(2);
                              document.getElementById("kecakapan_pedagogis").value = (Number(d) / total).toFixed(2);
                              document.getElementById("sikap_inklusif").value = (Number(e) / total).toFixed(2);
                            }
                      </script>
                      <!--END SCRIPT HITUNG-->

                      <?php 
          
                      //START SCRIPT INSER

                      if (isset($_POST['submit'])) {
                        $absensi_kehadiran = $_POST['absensi_kehadiran'];
                        $kecakapan_sosial = $_POST['kecakapan_sosial'];
                        $kecakapan_kepribadian = $_POST['kecakapan_kepribadian'];
                        $kecakapan_pedagogis = $_POST['kecakapan_pedagogis'];
                        $sikap_inklusif = $_POST['sikap_inklusif'];
                        if (($absensi_kehadiran == "") or
                          ($kecakapan_sosial == "") or
                          ($kecakapan_kepribadian == "") or
                          ($kecakapan_pedagogis == "") or
                          ($sikap_inklusif == "")
                        ) {
                          echo "<script>
                          alert('Tolong Lengkapi Data yang Ada!');
                          </script>";
                        } else {
                          $sql = "SELECT * FROM kriteria";
                          $hasil = $conn->query($sql);
                          $rows = $hasil->num_rows;
                          if ($rows > 0) {
                            echo "<script>
                            alert('Hapus Bobot Lama untuk Membuat Bobot Baru');
                            </script>";
                          } else {
                            $sql = "INSERT INTO kriteria(
                              absensi_kehadiran,kecakapan_sosial,kecakapan_kepribadian,kecakapan_pedagogis,sikap_inklusif)
                              values ('" . $absensi_kehadiran . "',
                              '" . $kecakapan_sosial . "',
                              '" . $kecakapan_kepribadian . "',
                              '" . $kecakapan_pedagogis . "',
                              '" . $sikap_inklusif . "')";
                            $hasil = $conn->query($sql);
                            echo "<script>
                            alert('Bobot Berhasil di Inputkan!');
                            </script>";
                          }
                        }
                      }
                      //END SCRIPT INSERT
                      
                      ?>

                       <!--start inputan-->
                      <form class="form-validate form-horizontal" id="register_form" method="post" action="">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"><b>Kriteria</b></label>
                          <div class="col-sm-3">
                            <label><b>Bobot</b></label>
                          </div>
                          <div class="col-sm-1">
                            <label><b>Atribut</b></label>
                          </div>
                          <div class="col-sm-2">
                            <label><b>Perbaikan Bobot</b></label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Absensi Kehadiran</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="absensi_kehadiran_param" id="absensi_kehadiran_param">
                              <option>1. Sangat Rendah</option>
                              <option>2. Rendah</option>
                              <option>3. Cukup</option>
                              <option>4. Tinggi</option>
                              <option>5. Sangat Tinggi</option>
                            </select>
                          </div>
                          <div class="col-sm-1 mt-2">
                            Cost
                          </div>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" name="absensi_kehadiran" id="absensi_kehadiran">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Kecakapan Sosial</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="kecakapan_sosial_param" id="kecakapan_sosial_param">
                              <option>1. Sangat Rendah</option>
                              <option>2. Rendah</option>
                              <option>3. Cukup</option>
                              <option>4. Tinggi</option>
                              <option>5. Sangat Tinggi</option>
                            </select>
                          </div>
                          <div class="col-sm-1 mt-2">
                            Cost
                          </div>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" name="kecakapan_sosial" id="kecakapan_sosial">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Kecakapan Kepribadian</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="kecakapan_kepribadian_param" id="kecakapan_kepribadian_param">
                              <option>1. Sangat Rendah</option>
                              <option>2. Rendah</option>
                              <option>3. Cukup</option>
                              <option>4. Tinggi</option>
                              <option>5. Sangat Tinggi</option>
                            </select>
                          </div>
                          <div class="col-sm-1 mt-2">
                            Cost
                          </div>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" name="kecakapan_kepribadian" id="kecakapan_kepribadian">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Kecakapan Pedagogis</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="kecakapan_pedagogis_param" id="kecakapan_pedagogis_param">
                              <option>1. Sangat Rendah</option>
                              <option>2. Rendah</option>
                              <option>3. Cukup</option>
                              <option>4. Tinggi</option>
                              <option>5. Sangat Tinggi</option>
                            </select>
                          </div>
                          <div class="col-sm-1 mt-2">
                            Cost
                          </div>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" name="kecakapan_pedagogis" id="kecakapan_pedagogis">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sikap Inklusif</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="sikap_inklusif_param" id="sikap_inklusif_param">
                              <option>1. Sangat Rendah</option>
                              <option>2. Rendah</option>
                              <option>3. Cukup</option>
                              <option>4. Tinggi</option>
                              <option>5. Sangat Tinggi</option>
                            </select>
                          </div>
                          <div class="col-sm-1 mt-2">
                            Cost
                          </div>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" name="sikap_inklusif" id="sikap_inklusif">
                          </div>
                          <div class="col-sm-3">
                            <button class="btn btn-outline-success" type="button" id="hitung" onclick="fungsiku()" name="hitung">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                              <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                              <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                            </svg>
                             Hitung</button>
                          </div>
                        </div>
                        
                        <div class="mb-4">
                          <button class="btn btn-outline-primary" type="submit" name="submit">
                          
                             Submit</button>
                        </div>
                      </form>
                      <table class="table">
                        <thead>
                          <tr>
                            <th><i class="fa fa-arrow-down"></i>Absensi Kehadiran</th>
                            <th><i class="fa fa-arrow-down"></i>Kecakapan Sosial</th>
                            <th><i class="fa fa-arrow-down"></i>Kecakapan Kepribdadian</th>
                            <th><i class="fa fa-arrow-down"></i>Kecakapan Pedagogis</th>
                            <th><i class="fa fa-arrow-down"></i>Sikap Inklusif</th>
                            <th><i class="fa fa-cogs"></i> Aksi</th>
                          </tr>
                        </thead>
                        <?php
                        $b = 0;
                        $sql = "SELECT * FROM kriteria";
                        $hasil = $conn->query($sql);
                        $rows = $hasil->num_rows;
                        if ($rows > 0) {
                          while ($row = $hasil->fetch_row()) {
                        ?>
                            <tr>
                              <td Align="center"><?= $row[1] ?></td>
                              <td Align="center"><?= $row[2] ?></td>
                              <td Align="center"><?= $row[3] ?></td>
                              <td Align="center"><?= $row[4] ?></td>
                              <td Align="center"><?= $row[5] ?></td>
                              <td>
                                <div class="btn-group">
                                  <a href="hapus_data_kriteria.php?id_kriteria=<?= $row[0]; ?>" onclick="return confirm('yakin ?'); ">
                                      <svg class="ml-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg>
                                    </a>
                                </div>
                              </td>
                            </tr>
                        <?php }
                        } else {
                          echo "<tr>
                              <td>Data Tidak Ada</td>
                          <tr>";
                        } ?>
                        </tbody>
                      </table>

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