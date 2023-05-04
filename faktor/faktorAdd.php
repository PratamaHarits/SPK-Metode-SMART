<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {

    $altKode = $_POST['altKode'];
    $kriKode = $_POST['kriKode'];
    $nilaiFaktor = $_POST['nilaiFaktor'];

    // echo $altKode . '<br>' . $kriKode . '<br>' . $nilaiFaktor;
    // var_dump($altKode);
    // var_dump($kriKode);
    // var_dump($nilaiFaktor);

    // cek jika alternatif belum dipilih
    if ($altKode == 'Pilih Alternatif...') {
        echo "<script>
        alert('Alternatif Belum Dipilih');
        window.location='faktorview.php'
        </script>";
    } else {
        //insert data
        $inputBanyak = count($kriKode);
        for ($x = 0; $x < $inputBanyak; $x++) {

            $query = $conn->query("INSERT INTO tb_nilai(alternatif_kode, kriteria_kode, nilai_faktor) VALUES('$altKode','$kriKode[$x]','$nilaiFaktor[$x]')");

            if ($query == True) {
                echo "<script>
                        alert('Data Berhasil Disimpan');
                        window.location='faktorView.php'
                        </script>";
            } else {
                die('Gagal! : ' . mysqli_errno($conn));
            }
        }
    }
}
