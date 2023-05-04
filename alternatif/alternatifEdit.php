<?php

include '../tools/connection.php';


if (isset($_POST['update'])) {

    $altId = $_POST['altId'];
    $altKode = $_POST['altKode'];
    $altNama = $_POST['altNama'];

    $query = $conn->query("UPDATE ta_alternatif SET alternatif_id='$altId', alternatif_kode = '$altKode', alternatif_nama = '$altNama' WHERE alternatif_id='$altId'");

    if ($query == True) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location='alternatifView.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
