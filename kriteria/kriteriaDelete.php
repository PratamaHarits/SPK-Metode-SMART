<?php

include '../tools/connection.php';

$kriId = $_GET['id'];

$query = $conn->query("DELETE FROM ta_kriteria WHERE kriteria_id='$kriId'");

if ($query == True) {
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location='kriteriaView.php'
       </script>";
} else {
    die('MySQL error : ' . mysqli_errno($conn));
}
