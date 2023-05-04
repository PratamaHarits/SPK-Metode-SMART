<?php
//login
session_start();

if (!isset($_SESSION["login_admin"])) {
    header("location: ../login/adminLogin.php");
    exit();
}
?>

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
        <?php include '../blade/navAdmin.php' ?>
        <!-- body -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 shadow py-3">
                    <!-- judul -->
                    <p class="text-center fw-bold">Halaman Admin</p>
                    <hr>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">

                            <p>###</p>

                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
</div>

<?php include '../blade/footer.php' ?>