<?php 

// Memisahkan logika codingan dengan tampilan web

    // Membuat koneksi ke database
    $conn = mysqli_connect("localhost", "root", "root", "spk_pengajar_pesantren");

    // Mmbuat fungsi query
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);

        // Data kosong
        $rows = [];

        // Data yang diambil setiap loopingnya
        while( $row = mysqli_fetch_assoc($result) ) {

            // Mengambil wadah data yang kosong untuk mengambil data dari setiap perulangan nya satu per satu
            $rows[] = $row;
        }
        // Mengembalikan wadah data yang kosong
        return $rows;
    }

    function registrasi($data) {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);


       // Cek username sudah ada atau belum
       $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");
       
       // Jika username nya sudah ada didalam database
       if( mysqli_fetch_assoc($result) ) {
           echo "<script>
                       alert('Username yang diketik sudah terdaftar!');
                 </script>";
           return false;
       }

       //  Cek konfirmasi password
       if ( $password !== $password2 ) {
           echo "<script>
                       alert('Konfirmasi password Anda tidak sesuai!');
                 </script>";
           return false;
       }
       // return 1;

       // Enkripsi password
       // $password = md5($password);
       // Link: https://md5.gromweb.com/?md5=ac43724f16e9241d990427ab7c8f4228

       $password = password_hash($password, PASSWORD_DEFAULT);
       // var_dump($password); die;

       // Tambahkan user baru ke dalam database
       mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
       return mysqli_affected_rows($conn);
       
   }

?>