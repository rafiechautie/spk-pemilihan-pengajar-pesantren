<?php 

    require 'functions.php';

    // Jika tombol registrasi ditekan
    if( isset($_POST["signup"]) ) {

        // Jika nilainya lebih dari nol
        if( registrasi($_POST) > 0 ) {
            echo "<script>
                        alert('User baru berhasil ditambahkan');
                </script>";
        } else {
            echo mysqli_error($conn);
        }
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
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
    <form action="" method = "post">
        <div class="form-floating">
        <input type="name" class="form-control" id="name" placeholder="Name" name="name" require>
        <label for="name">Name</label>
        </div>
        <div class="form-floating">
        <input type="username" class="form-control" id="username" name="username" placeholder="Username" require>
        <label for="username">Username</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Password">
        <label for="confirmPassword">Konfirmasi Password</label>
        </div>
        <div class="form-floating">
        <input type="hidden" class="form-control" id="level" name="level" value="pengunjung">
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="signup">Sign Up</button>
        <p>Sudah punya akun? <a href="registration.php">login sekarang</a></p>
    </form>
</main>


    
  </body>
</html>
