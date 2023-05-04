<?php

include '../tools/connection.php';

$subkriId = $_GET['id'];

$query = $conn->query("DELETE FROM ta_subkriteria WHERE subkriteria_id='$subkriId'");

if ($query == True) {
    echo "<script>
                alert('Data Berhasil Dihapus');
                window.location='SubKriteriaView.php'
                </script>";
} else {
    die('MySQL error : ' . mysqli_errno($conn));
}
