<?php

include '../tools/connection.php';


if (isset($_POST['update'])) {

    $userId = $_POST['userId'];
    $userKode = $_POST['userKode'];
    $userNama = $_POST['userNama'];
    $userPassword = $_POST['userPassword'];

    $query = $conn->query("UPDATE ta_user SET user_id = '$userId', user_kode = '$userKode', user_nama = '$userNama', user_password = '$userPassword' WHERE user_id = '$userId'");

    if ($query == True) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location='userView.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
