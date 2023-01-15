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
    $id = $_GET["id_kriteria"];

    // var_dump($id); die;

    // Jika berhasil menghapus data dari id
    if( ( hapus_data_kriteria($id) > 0 ) ) {

        // Akan ada baris atau record yang terpengaruhi
        echo "<script>
                    alert('Data berhasil dihapus');
                    document.location.href = 'kriteria.php';
              </script>";
    } else {
        //jika tidak berhasil menghapus data dari id
        echo "<script>
                    alert('Data gagal dihapus');
                    document.location.href = 'kriteria.php';
              </script>";
    }

?>