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
    $id = $_GET["id"];
    // var_dump($id);

    // Query data mahasiswa berdasarkan id
    $user = query("SELECT * FROM users WHERE id = $id")[0];

    // Mengecek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) { 

        // var_dump($_POST);

        // Mengecek apakah data berhasil diubah atau tidak
        if( update_data_user($_POST) > 0 ) {
            echo "<script>
                        alert('Data berhasil diubah');
                        document.location.href = 'users.php';
                  </script>";
        } else {
            echo "<script>
                        alert('Data gagal diubah');
                        
                  </script>";        }

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
                     <h1 class="h3 mb-2 text-gray-800">Update Data Users</h1>

                    

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Update Data Users</h6>
                                <form action="" method="post">
                                    <input type="hidden" class="form-control" name="id" aria-describedby="id" value="<?= $user["id"]; ?>">
                                    <div class="form-group">
                                        <label for="name" class="mt-4">Nama Lengkap : </label>
                                        <input type="text" class="form-control form-control-user"
                                            id="name" name="name" aria-describedby="name" value="<?= $user["nama"]; ?>"
                                             disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="mt-1">Username : </label>
                                        <input type="text" class="form-control form-control-user"
                                            id="username" name="username" aria-describedby="username" value="<?= $user["username"]; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="level" class="mt-1">Level : </label>
                                        <select id="level" name="level"  class="form-control">
                                            <option <?php if($user["tingkat"]=="admin") echo 'selected="selected"'; ?> >Admin</option>
                                            <option  <?php if($user["tingkat"]=="penilai") echo 'selected="selected"'; ?>>Penilai</option>
                                        </select>
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-primary btn-user btn-block">Update</button>
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