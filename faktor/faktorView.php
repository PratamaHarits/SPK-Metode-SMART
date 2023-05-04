<?php
// koneksi
include '../tools/connection.php';
// header
include '../blade/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header bg-info">
            <?php include '../blade/namaProgram.php'; ?>
        </div>
        <!-- nav -->
        <?php include '../blade/nav.php' ?>
        <!-- body -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 shadow py-3">
                    <!-- judul -->
                    <p class="text-center fw-bold">Data Nilai Faktor</p>
                    <hr>
                    <!-- tabel disini -->
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <!-- button trigger modal tambah -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-1">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    Add
                                </button>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="table-info">
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">
                                            Nama Alternatif
                                        </th>
                                        <!-- jumlah data kriteria -->
                                        <?php
                                        $data = $conn->query("SELECT * FROM ta_kriteria");
                                        $kriteriaRows = mysqli_num_rows($data);
                                        ?>
                                        <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr class="table-info">
                                        <!-- nama kriteria -->
                                        <?php
                                        $data = $conn->query("SELECT * FROM ta_kriteria");
                                        while ($kriteria = $data->fetch_assoc()) { ?>
                                            <td><?= $kriteria['kriteria_nama']; ?></td>
                                        <?php } ?>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
                                    $no = 1;
                                    while ($alternatif = $data->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $alternatif['alternatif_nama'] ?></td>
                                            <!-- ambil nilai_faktor berdasarkan alternatif_kode dan kriteria_kode -->
                                            <?php
                                            $alt_kode = $alternatif['alternatif_kode'];
                                            $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alt_kode' ORDER BY kriteria_kode");
                                            while ($data_nilai = $sql->fetch_assoc()) { ?>
                                                <td><?= $data_nilai['nilai_faktor']; ?></td>
                                            <?php } ?>
                                            <!-- aksi -->
                                            <td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $alternatif['alternatif_kode'] ?>">Edit</a> <a href="faktorDelete.php?id=<?= $alternatif['alternatif_kode']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Hapus data ini ?')">Delete</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal ADD -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Nilai Faktor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Form disini -->
                <form method="post" action="faktorAdd.php">
                    <div class="row mb-3">
                        <label for="altKode" class="col-sm-3 col-form-label">Alternatif</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="altKode">
                                <option selected>Pilih Alternatif...</option>
                                <?php
                                $data = $conn->query("SELECT * FROM ta_alternatif");
                                while ($alternatif = $data->fetch_assoc()) { ?>
                                    <option value="<?= $alternatif['alternatif_kode']; ?>"><?= $alternatif['alternatif_nama'] . ' (' . $alternatif['alternatif_kode'] . ')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col text-center">Isi Nilai Faktor Dibawah Ini !!</label>
                    </div>

                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    while ($kriteria = $data->fetch_assoc()) { ?>
                        <div class="row mb-3">
                            <label for="nilaiFaktor" class="col-sm-3 col-form-label"><?= $kriteria['kriteria_kode'] . ' - ' . $kriteria['kriteria_nama']; ?></label>

                            <div class="col-sm-9">
                                <input type="hidden" name="kriKode[]" value="<?= $kriteria['kriteria_kode']; ?>">
                                <select class="form-select" name="nilaiFaktor[]">
                                    <option selected>Choose...</option>
                                    <?php
                                    $kri_kode = $kriteria['kriteria_kode'];
                                    $sql = $conn->query("SELECT * FROM ta_subkriteria WHERE kriteria_kode='$kri_kode' ORDER BY kriteria_kode");
                                    while ($subKriteria = $sql->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $subKriteria['subkriteria_bobot']; ?>"><?= $subKriteria['subkriteria_keterangan'] . ' (bobot : ' . $subKriteria['subkriteria_bobot'] . ')'; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php
$data = $conn->query("SELECT * FROM ta_alternatif ORDER by alternatif_kode");
while ($alternatif = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $alternatif['alternatif_kode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Nilai - <?= $alternatif['alternatif_nama']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form disini -->
                    <form method="post" action="faktorEdit.php">


                        <?php
                        $alt_kode = $alternatif['alternatif_kode'];
                        $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alt_kode'");
                        while ($data_nilai = $sql->fetch_assoc()) { ?>
                            <div class="row mb-3">
                                <input type="hidden" id="nilaiId" name="nilaiId[]" value="<?= $data_nilai['nilai_id']; ?>">
                                <input type="hidden" id="altKode" name="altKode[]" value="<?= $data_nilai['alternatif_kode']; ?>">
                                <input type="hidden" id="kriKode" name="kriKode[]" value="<?= $data_nilai['kriteria_kode']; ?>">

                                <?php
                                $kri_kode = $data_nilai['kriteria_kode'];
                                $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kri_kode'");
                                while ($data_kriteria = $sqli->fetch_assoc()) {
                                ?>
                                    <label for="kriNama" class="col-sm-3 col-form-label"><?= $data_kriteria['kriteria_kode'] . ' - ' . $data_kriteria['kriteria_nama']; ?></label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="nilaiFaktor[]">
                                            <?php
                                            $data_subkriteria = $conn->query("SELECT * FROM ta_subkriteria WHERE kriteria_kode='$kri_kode' ORDER BY kriteria_kode");
                                            while ($subKriteria = $data_subkriteria->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $subKriteria['subkriteria_bobot']; ?>" <?php if ($subKriteria['subkriteria_bobot'] == $data_nilai['nilai_faktor']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $subKriteria['subkriteria_keterangan'] . ' (bobot : ' . $subKriteria['subkriteria_bobot'] . ')'; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-outline-warning" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- footer -->
<?php include '../blade/footer.php' ?>