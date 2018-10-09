<?php

    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'address_book_pweb')
        or die(mysqli_error($mysqli));

    $update = false;
    $nrp = '';
    $nama = '';
    $notelpon = '';
    $alamat = '';

    if(isset($_POST['tambah'])){
        $nrp = $_POST['NRP'];
        $nama = $_POST['Nama'];
        $notelpon = $_POST['NoTelpon'];
        $alamat = $_POST['Alamat'];

        $_SESSION['message'] = "Data telah dimasukkan";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");

        $mysqli->query("INSERT INTO address_book (NRP, Nama, NoTelpon, Alamat)
            VALUES('$nrp', '$nama', '$notelpon', '$alamat')") or die($mysqli->error);
    }

    if(isset($_GET['hapus'])){
        $nrp = $_GET['hapus'];
        $mysqli->query("DELETE FROM address_book WHERE NRP=$nrp") or die($mysqli->error());
    
        $_SESSION['message'] = "Data telah dihapus";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");
    }

    if(isset($_GET['ubah'])){
        $nrp = $_GET['ubah'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM address_book WHERE NRP=$nrp") or die($mysqli->error());
        if(count($result)==1){
            $row = $result->fetch_array();
            $nama = $row['Nama'];
            $notelpon = $row['NoTelpon'];
            $alamat = $row['Alamat'];
        }
    }

    if(isset($_POST['update'])){
        $nrp = $_POST['NRP'];
        $name = $_POST['Nama'];
        $notelpon = $_POST['NoTelpon'];
        $alamat = $_POST['Alamat'];

        $mysqli->query("UPDATE address_book SET Nama='$nama', NoTelpon='$notelpon',
            Alamat='$alamat' WHERE NRP=$nrp") or die($mysqli->error());

        $_SESSION['message'] = "Data telah diubah";
        $_SESSION['msg_type'] = "warning";

        header('location: index.php');
    }
?>