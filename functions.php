<?php 

// Memisahkan logika codingan dengan tampilan web

    // Membuat koneksi ke database
    $conn = mysqli_connect("localhost", "root", "123456", "spk_pengajar_pesantren");

    // Mmbuat fungsi query
    function query($query) {
        global $conn;

        //ambil data dari database dan disimpan ke variable result
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
        //mengambil data koneksi ke database
        global $conn;

        //mengambil data yang dikirim oleh form melalui method post
        /**
         * function stripslashes untuk membersihkan data yang diinput user, misalnya user menginput data yang ada karakter "/"
         * maka akan dihapus karakter tersebut
         */
        /**
         * function strlower untuk mengkonversi data yang diinput user menjadi huruf kecil semua
         */
        /**
         * function mysqli_real_escape_string berguna untuk membuat user bisa memasukkan password yang ada karakter tanda kutip
         * dan tanda kutipnya bisa masuk ke database dengan aman
         */
        $name = stripslashes($data["name"]);
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $confirmPassword = mysqli_real_escape_string($conn, $data["confirmPassword"]);
        $level = strtolower($data["level"]);


       // Cek username sudah ada atau belum
       $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
       
       // Jika username nya sudah ada didalam database
       if( mysqli_fetch_assoc($result) ) {
           echo "<script>
                       alert('Username yang diketik sudah terdaftar!');
                 </script>";
           return false;
       }

       //  Cek konfirmasi password
       if ( $password !== $confirmPassword ) {
           echo "<script>
                       alert('Konfirmasi password Anda tidak sesuai!');
                 </script>";
           //return false untuk memberhentikan program      
           return false;
       }
       // return 1;

       // Enkripsi password
       // $password = md5($password);
       // Link: https://md5.gromweb.com/?md5=ac43724f16e9241d990427ab7c8f4228

       $password = password_hash($password, PASSWORD_DEFAULT);
       // var_dump($password); die;

       // Tambahkan user baru ke dalam database
       mysqli_query($conn, "INSERT INTO users VALUES(0, '$name' ,'$username', '$password', '$level')");
       return mysqli_affected_rows($conn);
       
   }

?>