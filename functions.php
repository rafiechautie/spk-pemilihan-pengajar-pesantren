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

    function tambah_alternatif($data) {
        global $conn;

        $nama_alternatif = htmlspecialchars(strtolower($data["nama_alternatif"]));
        $jenis_kelamin = htmlspecialchars(strtolower($data["jenis_kelamin"]));
        $no_hp = htmlspecialchars(strtolower($data["no_hp"]));
        $pendidikan_terakhir = htmlspecialchars(strtolower($data["pendidikan_terakhir"]));
        $keahlian = htmlspecialchars(strtolower($data["keahlian"]));
        $tugas = htmlspecialchars(strtolower($data["tugas"]));
        $asal = htmlspecialchars(strtolower($data["asal"]));


        // Menambahkan data mahasiswa kemudian tambahkan seluruh data nya menjadi data mahasiswa yang baru
        $query = "INSERT INTO alternatif VALUES (0, '$nama_alternatif', '$jenis_kelamin', '$no_hp', '$pendidikan_terakhir', '$keahlian', '$tugas', '$asal')";
        mysqli_query($conn, $query);

        // Mengembalikan data ketika ada data yang berhasil ditambahkan
        return mysqli_affected_rows($conn);
    }

    function tambah_penilaian($data) {
        global $conn;

        $id_alternatif = (int) $_POST['id_alternatif'];
        // var_dump($id_alternatif); die;
        $absensi_kehadiran = substr($_POST['absensi_kehadiran'], 1, 1);
        $kecapakan_sosial = substr($_POST['kecakapan_sosial'], 1, 1);
        $kecapakan_kepribadian = substr($_POST['kecakapan_kepribadian'], 1, 1);
        $kecapakan_pedagogis = substr($_POST['kecakapan_pedagogis'], 1, 1);
        $sikap_inklusif = substr($_POST ['sikap_inklusif'], 1, 1);

        //apakah ada username yang sama dengan data username yang diinput oleh user
        $result = mysqli_query($conn, "SELECT * FROM penilaian INNER JOIN alternatif ON penilaian.id_alternatif=alternatif.id_alternatif WHERE alternatif.id_alternatif = '$id_alternatif'");

        // var_dump($result); die;

        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
                        alert('Data Alternatif yang diketik sudah terdaftar!');
                  </script>";
            return false;
        }

        mysqli_query($conn, "INSERT INTO penilaian VALUES(0, '$id_alternatif' ,'$absensi_kehadiran', '$kecapakan_sosial', '$kecapakan_kepribadian', '$kecapakan_pedagogis', '$sikap_inklusif')");
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

    function update_data_alternatif($data) {
        global $conn;
        
        // Menangkap value table mahasiswa dengan variabel
        $id = $data["id_alternatif"];

        // var_dump($id); die;
        
        $nama_alternatif = htmlspecialchars(strtolower($data["nama_alternatif"]));
        $jenis_kelamin = htmlspecialchars(strtolower($data["jenis_kelamin"]));
        $no_hp = htmlspecialchars(strtolower($data["no_hp"]));
        $pendidikan_terakhir = htmlspecialchars(strtolower($data["pendidikan_terakhir"]));
        $keahlian = htmlspecialchars(strtolower($data["keahlian"]));
        $tugas = htmlspecialchars(strtolower($data["tugas"]));
        $asal = htmlspecialchars(strtolower($data["asal"]));


        // Mengubah data mahasiswa set semuanya kemudian ubah semua data nya menjadi data yang baru
        $query = "UPDATE alternatif SET nama_alternatif = '$nama_alternatif',
                                        jenis_kelamin = '$jenis_kelamin',
                                        no_hp = '$no_hp',
                                        pendidikan_terakhir = '$pendidikan_terakhir',
                                        keahlian = '$keahlian',
                                        tugas = '$tugas',
                                        asal = '$asal'
                                    WHERE id_alternatif = '$id'";
        mysqli_query($conn, $query);

        // Mengembalikan data ketika ada data yang berhasil diubah
        return mysqli_affected_rows($conn);
    }

    function hapus_data_user($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM users WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function hapus_data_alternatif($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif = $id");
        return mysqli_affected_rows($conn);
    }

    function hapus_data_kriteria($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria = $id");
        return mysqli_affected_rows($conn);
    }

    function hapus_data_penilaian($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM penilaian WHERE id_penilaian = $id");
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

    function cari_alternatif($keyword) {

        // Mencari mahasiswa yang namanya tersedia
        $query = "SELECT * FROM alternatif WHERE nama_alternatif LIKE '%$keyword%' OR
                                                jenis_kelamin LIKE '%$keyword%' OR
                                                no_hp LIKE '%$keyword%' OR
                                                pendidikan_terakhir LIKE '%$keyword%' OR
                                                keahlian LIKE '%$keyword%' OR
                                                tugas LIKE '%$keyword%' OR
                                                asal LIKE '%$keyword%' ";

        // Memanggil fungsi yang sudah dibuat didalam fungsi baru
        return query($query);
    }

    function cari_penilaian($keyword) {

        // Mencari mahasiswa yang namanya tersedia
        $query = "SELECT * FROM alternatif INNER JOIN penilaian ON alternatif.id_alternatif=penilaian.id_alternatif                           WHERE nama_alternatif LIKE '%$keyword%'";

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