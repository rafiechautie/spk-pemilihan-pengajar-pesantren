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

    function tambah($data) {
        global $conn;

        $nrp = htmlspecialchars($data["nrp"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        // $gambar = htmlspecialchars($data["gambar"]);

        // Menjalanakn fungsi untuk upload gambar
        $gambar = upload();

        // Jika yang dikirimkan oleh fungsi upload itu adalah gagal
        if( !$gambar ) {
            return false;
        }

        // Menambahkan data mahasiswa kemudian tambahkan seluruh data nya menjadi data mahasiswa yang baru
        $query = "INSERT INTO mahasiswa VALUES ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')";
        mysqli_query($conn, $query);

        // Mengembalikan data ketika ada data yang berhasil ditambahkan
        return mysqli_affected_rows($conn);
    }

    // Membuat function ubah untuk menampung data post yang di inginkan
    function update_data_user($data) {
        global $conn;
        
        // Menangkap value table mahasiswa dengan variabel
        $id = $data["id"];
        
        $level = strtolower($data["level"]);
        
        // $gambar = htmlspecialchars($data["gambar"]);

        // Cek apakah user memilih gambar baru atau tidak, jika memilih gambar lama
        // if( $_FILES['gambar']['error'] === 4 ) {
        //     // Jika memilih gambar lama maka tetapkan pada gambar yang lama
        //     $gambar = $gambarLama;

        // Maka gambar itu akan diisi dengan upload atau jalankan fungsi upload gambar yang baru
        // } else {
        //     $gambar = upload();
        // }


        // Mengubah data mahasiswa set semuanya kemudian ubah semua data nya menjadi data yang baru
        $query = "UPDATE users SET tingkat = '$level' WHERE id = '$id'";
        mysqli_query($conn, $query);

        // Mengembalikan data ketika ada data yang berhasil diubah
        return mysqli_affected_rows($conn);
    }

    function hapus_data_user($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM users WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // Membuat function cari untuk mengetikkan keyword cari
    function cari($keyword) {

        // Mencari mahasiswa yang namanya tersedia
        $query = "SELECT * FROM users WHERE nama LIKE '%$keyword%' OR
                                                username LIKE '%$keyword%' OR
                                                tingkat LIKE '%$keyword%' ";

        // Memanggil fungsi yang sudah dibuat didalam fungsi baru
        return query($query);
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
        $name = htmlspecialchars(stripslashes($data["name"]));
        $username = htmlspecialchars(strtolower(stripslashes($data["username"])));
        $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
        $confirmPassword = htmlspecialchars(mysqli_real_escape_string($conn, $data["confirmPassword"]));
        $tingkat = strtolower($data["tingkat"]);


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
       mysqli_query($conn, "INSERT INTO users VALUES(0, '$name' ,'$username', '$password', '$tingkat')");
       return mysqli_affected_rows($conn);
       
   }

?>