<?php

include '../tools/connection.php';


if (isset($_POST['update'])) {

    $subkriId = $_POST['subkriId'];
    $subkriKode = $_POST['subkriKode'];
    $kriKode = $_POST['kriKode'];
    $subkriKeterangan = $_POST['subkriKeterangan'];
    $subkriBobot = $_POST['subkriBobot'];

    // echo $subkriId . '<br>' . $subkriKode . '<br>' . $kriKode . '<br>' . $subkriKeterangan . '<br>' . $subkriBobot;

    $query = $conn->query("UPDATE ta_subkriteria SET subkriteria_id='$subkriId', subkriteria_kode = '$subkriKode', kriteria_kode = '$kriKode', subkriteria_keterangan = '$subkriKeterangan', subkriteria_bobot = '$subkriBobot' WHERE subkriteria_id='$subkriId'");

    if ($query == True) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location='subkriteriaView.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
