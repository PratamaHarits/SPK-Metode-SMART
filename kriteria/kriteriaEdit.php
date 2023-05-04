<?php

include '../tools/connection.php';


if (isset($_POST['update'])) {

    $kriId = $_POST['kriId'];
    $kriKode = $_POST['kriKode'];
    $kriNama = $_POST['kriNama'];
    $kriKategori = $_POST['kriKategori'];
    $kriBobot = $_POST['kriBobot'];

    $query = $conn->query("UPDATE ta_kriteria SET kriteria_id='$kriId', kriteria_kode = '$kriKode', kriteria_nama = '$kriNama', kriteria_kategori = '$kriKategori', kriteria_bobot = '$kriBobot' WHERE kriteria_id='$kriId'");

    if ($query == True) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location='kriteriaView.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
