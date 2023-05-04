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
                    <p class="text-center fw-bold">Data Kriteria</p>
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
                                        <th>Kode Kriteria</th>
                                        <th>Kategori Kriteria</th>
                                        <th>Bobot Kriteria</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $conn->query("SELECT * FROM ta_kriteria");
                                    $no = 1;
                                    while ($kriteria = $data->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $kriteria['kriteria_nama'] ?></td>
                                            <td><?= $kriteria['kriteria_kode'] ?></td>
                                            <td><?= $kriteria['kriteria_kategori'] ?></td>
                                            <td><?= $kriteria['kriteria_bobot'] ?></td>
                                            <td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $kriteria['kriteria_id'] ?>">Edit</a> <a href="kriteriaDelete.php?id=<?= $kriteria['kriteria_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Hapus data ini ?')">Delete</a></td>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kriteria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form disini -->
                <form method="post" action="kriteriaAdd.php">
                    <div class="row mb-3">
                        <label for="kriKode" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <!-- buat kode kriteria -->
                            <?php
                            $data = $conn->query("SELECT * FROM ta_kriteria ORDER BY kriteria_id DESC LIMIT 1");
                            $total_row = mysqli_num_rows($data);
                            if ($total_row == 0) { ?>
                                <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= 'K001' ?>" required>
                            <?php } ?>

                            <?php while ($kriteria = $data->fetch_assoc()) { ?>
                                <?php
                                $row_terakhir = $kriteria['kriteria_id'];
                                if ($row_terakhir < 9) { ?>
                                    <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= 'K00' . ((int)$kriteria['kriteria_id'] + 1); ?>" required>
                                <?php } elseif ($row_terakhir >= 9) { ?>
                                    <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= 'K0' . ((int)$kriteria['kriteria_id'] + 1); ?>" required>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kriNama" name="kriNama" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriBobot" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="kriKategori">
                                <option selected>Choose...</option>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriBobot" class="col-sm-2 col-form-label">Bobot</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kriBobot" name="kriBobot" required>
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

<!-- Modal Edit -->
<?php
$data = $conn->query("SELECT * FROM ta_kriteria ORDER by kriteria_id");
while ($kriteria = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $kriteria['kriteria_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kriteria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form disini -->
                    <form method="post" action="kriteriaEdit.php">
                        <!-- input id -->
                        <input type="hidden" class="form-control" id="kriId" name="kriId" value="<?= $kriteria['kriteria_id'] ?>">
                        <div class="row mb-3">
                            <label for="kriKode" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= $kriteria['kriteria_kode'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriNama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kriNama" name="kriNama" required value="<?= $kriteria['kriteria_nama'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriNama" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-select d-inline" name="kriKategori">
                                    <option value="benefit" <?php if ($kriteria['kriteria_kategori'] == 'benefit') {
                                                                echo "selected";
                                                            } ?>>Benefit</option>
                                    <option value="cost" <?php if ($kriteria['kriteria_kategori'] == 'cost') {
                                                                echo "selected";
                                                            } ?>>Cost</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriBobot" class="col-sm-2 col-form-label">Bobot</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kriBobot" name="kriBobot" required value="<?= $kriteria['kriteria_bobot'] ?>">
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