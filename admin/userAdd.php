<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $userKode = $_POST['userKode'];
    $userNama = $_POST['userNama'];
    $userPassword = $_POST['userPassword'];

    $query = $conn->query("INSERT INTO ta_user(user_kode,user_nama,user_password)VALUES('$userKode','$userNama','$userPassword')");
    if ($query == True) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location='userView.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
