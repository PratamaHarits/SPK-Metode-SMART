<?php include '../blade/header.php' ?>

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
                    <p class="text-center fw-bold">Rekomendasi Penerima Bantuan Sembako</p>
                    <hr>
                    <!-- gambar -->
                    <div class="gambar bg-light bg-gradient">
                        <div class="text-center">
                            <img src="../img/bantuanImage.png" class="rounded" alt="...">
                        </div>
                    </div>
                    <hr>
                    <!-- pengantar -->
                    <p>Simple Multi Attribute Rating Technique (SMART) merupakan teknik pengambilan keputusan multikriteria.
                        SMART didasarkan pada teori yang menggambarkan seberapa penting ia dibandingkan dengan kriteria lain. Pembobotan ini digunakan untuk menilai alternatif agar diperoleh alternatif terbaik</p>

                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php include '../blade/footer.php' ?>