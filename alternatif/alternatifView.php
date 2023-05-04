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
                    <p class="text-center fw-bold">Data Alternatif</p>
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
                                        <th>Kode Alternatif</th>
                                        <th>Nama Alternatif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $conn->query("SELECT * FROM ta_alternatif");
                                    $no = 1;
                                    while ($alternatif = $data->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $alternatif['alternatif_kode'] ?></td>
                                            <td><?= $alternatif['alternatif_nama'] ?></td>
                                            <td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $alternatif['alternatif_id'] ?>">Edit</a> <a href="alternatifDelete.php?id=<?= $alternatif['alternatif_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Hapus data ini ?')">Delete</a></td>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Alternatif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form disini -->
                <form method="post" action="alternatifAdd.php">
                    <div class="row mb-3">
                        <label for="altKode" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <!-- buat kode alternatif -->
                            <?php
                            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_id DESC LIMIT 1");
                            $total_row = mysqli_num_rows($data);
                            if ($total_row == 0) { ?>
                                <input type="text" class="form-control" id="altKode" name="altKode" value="<?= 'A001' ?>" required>
                            <?php } ?>

                            <?php while ($alternatif = $data->fetch_assoc()) { ?>
                                <?php
                                $row_terakhir = $alternatif['alternatif_id'];
                                if ($row_terakhir < 9) { ?>
                                    <input type="text" class="form-control" id="altKode" name="altKode" value="<?= 'A00' . ((int)$alternatif['alternatif_id'] + 1); ?>" required>
                                <?php } elseif ($row_terakhir >= 9) { ?>
                                    <input type="text" class="form-control" id="altKode" name="altKode" value="<?= 'A0' . ((int)$alternatif['alternatif_id'] + 1); ?>" required>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="altNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="altNama" name="altNama" required>
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
$data = $conn->query("SELECT * FROM ta_alternatif ORDER by alternatif_id");
while ($alternatif = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $alternatif['alternatif_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Alternatif</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form disini -->
                    <form method="post" action="alternatifEdit.php">
                        <!-- input id -->
                        <input type="hidden" class="form-control" id="altId" name="altId" value="<?= $alternatif['alternatif_id'] ?>">
                        <div class="row mb-3">
                            <label for="altKode" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="altKode" name="altKode" value="<?= $alternatif['alternatif_kode'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="altNama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="altNama" name="altNama" required value="<?= $alternatif['alternatif_nama'] ?>">
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