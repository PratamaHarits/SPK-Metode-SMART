<?php

include '../tools/connection.php';

$userId = $_GET['id'];
$query = $conn->query("DELETE FROM ta_user WHERE user_id='$userId'");
if ($query == True) {
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location='userView.php'
       </script>";
} else {
    die('MySQL error : ' . mysqli_errno($conn));
}
