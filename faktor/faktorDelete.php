<?php

include '../tools/connection.php';

$altKode = $_GET['id'];

$query = $conn->query("DELETE FROM tb_nilai WHERE alternatif_kode='$altKode'");

if ($query == True) {
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location='faktorView.php'
       </script>";
} else {
    die('Gagal! : ' . mysqli_errno($conn));
}
