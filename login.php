<?php 
    // Menjalankan session start
    // session_start();
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
    // if( isset($_SESSION["login"]) ) {

        // Pindahkan ke halaman index setelah login
        // header("Location: index.php");
        // exit;
    // }


    // Menegcek apakah tombol login sudah ditekan atau belum
    if( isset($_POST["signin"]) ) {

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
                    // $_SESSION["login"] = true;

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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Signin Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    

    

<link href="assets/boostrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
    <img class="mb-4" src="assets/img/login.jpg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <!-- kalau username/password salah  -->
    <?php if(isset($error)) : ?>
        <p style="Color:">Username / Password Salah</p>
      <?php endif ?>
  <form action="" method="post">
    <div class="form-floating">
      <input type="username" class="form-control" id="username" name="username" placeholder="Username" require>
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" name="signin" type="submit">Sign in</button>
    <p>Belum punya akun? <a href="registration.php">register sekarang</a></p>
  </form>
</main>


    
  </body>
</html>
