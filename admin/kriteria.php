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

    

?>
<!doctype html>
<html lang="en">
  <?php include '../components/head.php'; ?>
  <body>

  <?php include '../components/navbar_admin.php'; ?>

<div class="container-fluid">
  <div class="row">
    <?php include '../components/sidebar_admin.php' ?>

    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat datang di Dashboard Admin</h1>
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
              <div class="col-sm-1">
                <input type="text" class="form-control" name="sikap_inklusif" id="sikap_inklusif">
              </div>
            </div>
            <div class="col-sm-1">
                <button class="btn btn-outline-success" type="button" id="hitung" onclick="fungsiku()" name="hitung"><i class="fa fa-calculator"></i> Hitung</button>
              </div>
            <div class="mb-4">
              <button class="btn btn-outline-primary" type="submit" name="submit"><i class="fa fa-save"></i> Submit</button>
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
                      <a class="btn btn-danger" href="kriteria_hapus.php?id=<?= $row[0] ?>"><i class="fa fa-close"></i></a>
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
    </main>
  </div>
</div>


    <script src="../assests/boostrap/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  </body>
</html>
