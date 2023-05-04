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
                    <p class="text-center fw-bold">Data Sub-Kriteria</p>
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
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Kode Sub-Kriteria</th>
                                        <th>Sub-Kriteria</th>
                                        <th>Bobot Sub-Kriteria</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // ambil semua data dari ta_subkriteria dimana  kriteria_kode ta_subkriteria = kriteria_kode ta_kriteria
                                    $data = $conn->query("SELECT * FROM ta_subkriteria INNER JOIN ta_kriteria ON ta_subkriteria.kriteria_kode = ta_kriteria.kriteria_kode");
                                    $no = 1;
                                    while ($subKriteria = $data->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $subKriteria['kriteria_nama']; ?></td>
                                            <td><?= $subKriteria['subkriteria_kode'] ?></td>
                                            <td><?= $subKriteria['subkriteria_keterangan'] ?></td>
                                            <td><?= $subKriteria['subkriteria_bobot'] ?></td>
                                            <td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $subKriteria['subkriteria_id'] ?>">Edit</a> <a href="subkriteriaDelete.php?id=<?= $subKriteria['subkriteria_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Hapus data ini ?')">Delete</a></td>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Sub-Kriteria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form disini -->
                <form method="post" action="subkriteriaAdd.php">
                    <div class="row mb-3">
                        <label for="subkriKode" class="col-sm-3 col-form-label">Kode</label>
                        <div class="col-sm-9">
                            <!-- buat kode sub-kriteria -->
                            <?php
                            $data = $conn->query("SELECT * FROM ta_subkriteria ORDER BY subkriteria_id DESC LIMIT 1");
                            $total_row = mysqli_num_rows($data);
                            if ($total_row == 0) { ?>
                                <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= 'SK001' ?>" required>
                            <?php } ?>
                            <?php while ($subkriteria = $data->fetch_assoc()) { ?>
                                <?php
                                $row_terakhir = $subkriteria['subkriteria_id'];
                                if ($row_terakhir < 9) { ?>
                                    <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= 'SK00' . ((int)$subkriteria['subkriteria_id'] + 1); ?>" required>
                                <?php } elseif ($row_terakhir >= 9) { ?>
                                    <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= 'SK0' . ((int)$subkriteria['subkriteria_id'] + 1); ?>" required>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriKode" class="col-sm-3 col-form-label">Kriteria</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="kriKode">
                                <option selected>Pilih Kriteria...</option>
                                <?php
                                $data = $conn->query("SELECT * FROM ta_kriteria");
                                while ($kriteria = $data->fetch_assoc()) { ?>
                                    <option value="<?= $kriteria['kriteria_kode']; ?>"><?= $kriteria['kriteria_kode'] . ' - ' . $kriteria['kriteria_nama'] . ' (' . $kriteria['kriteria_kategori'] . ')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="subkriBobot" class="col-sm-3 col-form-label">Nilai</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="subkriBobot">
                                <option selected>Choose...</option>
                                <option value="20">20</option>
                                <option value="40">40</option>
                                <option value="60">60</option>
                                <option value="80">80</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="subkriKeterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="subkriKeterangan" name="subkriKeterangan" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Edit -->
<?php
$data = $conn->query("SELECT * FROM ta_subkriteria ORDER by subkriteria_id");
while ($subkriteria = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $subkriteria['subkriteria_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Sub-Kriteria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form disini -->
                    <form method="post" action="subkriteriaEdit.php">
                        <input type="hidden" class="form-control" id="subkriId" name="subkriId" value="<?= $subkriteria['subkriteria_id'] ?>">

                        <div class="row mb-3">
                            <label for="kriKode" class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= $subkriteria['subkriteria_kode'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kriKode" class="col-sm-3 col-form-label">Kriteria</label>
                            <div class="col-sm-9">
                                <select class="form-select d-inline" name="kriKode" id="kriKode">
                                    <?php
                                    $sql = $conn->query("SELECT * FROM ta_kriteria ORDER BY kriteria_kode");
                                    while ($kriteria = mysqli_fetch_array($sql)) { ?>
                                        <option value="<?= $kriteria['kriteria_kode']; ?>" <?php if ($kriteria['kriteria_kode'] == $subkriteria['kriteria_kode']) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $kriteria['kriteria_kode'] . ' - ' . $kriteria['kriteria_nama'] . ' (' . $kriteria['kriteria_kategori'] . ')'; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subkriKeterangan" class="col-sm-3 col-form-label">Sub-Kriteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="subkriKeterangan" name="subkriKeterangan" value="<?= $subkriteria['subkriteria_keterangan'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subkriBobot" class="col-sm-3 col-form-label">Bobot</label>
                            <div class="col-sm-9">
                                <select class="form-select d-inline" name="subkriBobot">
                                    <option value="20" <?php if ($subkriteria['subkriteria_bobot'] == '20') {
                                                            echo "selected";
                                                        } ?>>20</option>
                                    <option value="40" <?php if ($subkriteria['subkriteria_bobot'] == '40') {
                                                            echo "selected";
                                                        } ?>>40</option>
                                    <option value="60" <?php if ($subkriteria['subkriteria_bobot'] == '60') {
                                                            echo "selected";
                                                        } ?>>60</option>
                                    <option value="80" <?php if ($subkriteria['subkriteria_bobot'] == '80') {
                                                            echo "selected";
                                                        } ?>>80</option>
                                </select>
                            </div>
                        </div>

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