<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $subkriKode = $_POST['subkriKode'];
    $kriKode = $_POST['kriKode'];
    $subkriBobot = $_POST['subkriBobot'];
    $subkriKeterangan = $_POST['subkriKeterangan'];

    // echo $subkriKode . '<br>' . $kriKode . '<br>' . $subkriBobot . '<br>' . $subkriKeterangan;
    if ($kriKode == 'Pilih Kriteria...' || $subkriBobot == 'Choose...') {
        echo "<script>
                alert('Kriteria atau Sub-Kriteria bobot belum dipilih !!!');
                window.location='SubKriteriaView.php'
                </script>";
    } else {

        $query = $conn->query("INSERT INTO ta_subkriteria(subkriteria_kode,kriteria_kode,subkriteria_bobot,subkriteria_keterangan)VALUES('$subkriKode','$kriKode', '$subkriBobot','$subkriKeterangan')");

        if ($query == True) {
            echo "<script>
                        alert('Data Berhasil Disimpan');
                        window.location='SubKriteriaView.php'
                        </script>";
        } else {
            die('MySQL error : ' . mysqli_errno($conn));
        }
    }
}
