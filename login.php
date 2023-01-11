<?php 
    // Menjalankan session start
    session_start();
    require 'functions.php';

    // Mengecek Cookie apkah sudah tersedia
    // if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
        
        // $id = $_COOKIE['id'];
        // $key = $_COOKIE['key'];

        // Ambil username berdasarkan id
        // $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");

        // $row = mysqli_fetch_assoc($result);

        // Cek cookie dan username
        // if( $key === hash('sha256', $row['username']) ) {
        //     $_SESSION['login'] = true;
        // }

        // Jika session login true (Bisa memakai cara ini)
        // if( $_COOKIE['login'] == 'true' ) {
            
        //     // Maka jalankan session login nya
        //     $_SESSION['login'] = true;
        // }
    // }

    // Jika sudah login
    if( isset($_SESSION["login"]) ) {

        //Kasih peringatan bahwa anda sudah login
        // TODO 
        
    }


    // Menegcek apakah tombol login sudah ditekan atau belum
    if( isset($_POST["login"]) ) {

            //menangkap data username dan password yang diinput oleh user
            $username = $_POST["username"];
            $password = $_POST["password"];

            //apakah ada username yang sama dengan data username yang diinput oleh user
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            
            // Mengecek apakah ada username
            /**
             * mysqli_num_rows adalah function untuk mengetahui ada berapa baris yang dikembalikan dari keyword sql "SELECT "
             * kalau ada username yang sama dengan data username yang diinput oleh user maka nilainya pasti 1
             * 
             * jika tidak ada maka nilainya pasti 0
             */
            if( mysqli_num_rows($result) === 1 ) {
                //kalau ada baru cek password
                // Mengecek apakah ada password
                //jadi di variable row berisi data id, name, username, password yang udah diacak, dan level
                $row = mysqli_fetch_assoc($result);
                
                // Jika berhasil diverifikasi
                if( password_verify($password, $row["password"]) ) {
        
                    // Set session
                    $_SESSION["login"] = true;

                    // Jika Rememberme dichecklist maka menggunakan cookie
                    // if( isset($_POST['remember']) ) {
                        
                        // Buat cookie
                    //     setcookie('id', $row['id'], time() + 60);
                    //     setcookie('key', hash('sha256', $row['username']), time() + 60);
                    // }


                    // Arahkan user untuk masuk ke sebuah sistem
                    if($row["level"] == "admin"){
                      header("Location: admin/index.php");
                      exit;
                    }else if($row["level"] == "penilai"){
                      header("Location: penilai/index.php");
                      exit;
                    }
                    
            }
        }

        $error = true;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPK Pemilihan Pengajar Pesantren - Login</title>

    <!-- Custom fonts for this template-->
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat datang di <br>Sistem Pendukung Keputusan Pengajar Pesantren </h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="username"
                                                placeholder="Masukkan Username Anda">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Masukkan Password Anda">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button name="login" type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <p>Belum punya akun?</p><a class="small" href="registration.php">register sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="jquery/jquery.min.js"></script>
    <script src="assests/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/jquery/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>