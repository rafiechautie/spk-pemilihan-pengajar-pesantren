<?php 

    // Menjalankan session
    session_start();

    // Jika tidak ada session login
    if( !isset($_SESSION["login"]) ) {
        // Maka keluarkan user ke halaman login
        header("Location: ../login.php");
        exit;
    }

    require '../functions.php';

    // Menangkap nomor id
    $id = $_GET["id"];

    // Jika berhasil menghapus data dari id
    if( ( hapus_data_user($id) > 0 ) ) {

        // Akan ada baris atau record yang terpengaruhi
        echo "<script>
                    alert('Data berhasil dihapus');
                    document.location.href = 'users.php';
              </script>";
    } else {
        //jika tidak berhasil menghapus data dari id
        echo "<script>
                    alert('Data gagal dihapus');
                    document.location.href = 'users.php';
              </script>";
    }

?>