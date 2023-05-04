<?php
include '../tools/connection.php';

if (isset($_POST['update'])) {

    $nilaiId = $_POST['nilaiId'];
    $altKode = $_POST['altKode'];
    $kriKode = $_POST['kriKode'];
    $nilaiFaktor = $_POST['nilaiFaktor'];

    $updateBanyak = count($nilaiId);

    for ($x = 0; $x < $updateBanyak; $x++) {

        $query = $conn->query("UPDATE tb_nilai SET nilai_id = '$nilaiId[$x]', alternatif_kode = '$altKode[$x]', kriteria_kode = '$kriKode[$x]', nilai_faktor = '$nilaiFaktor[$x]' WHERE nilai_id='$nilaiId[$x]'");

        if ($query == True) {
            echo "<script>
            alert('Data Berhasil Disimpan');
            window.location='faktorView.php'
            </script>";
        } else {
            die('MySQL error : ' . mysqli_errno($conn));
        }
    }
}
