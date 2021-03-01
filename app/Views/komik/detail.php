<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mt-2">Detail Komik</h2>

                <div class="card mb-3" style="max-width: 310px;">
                    <div class="row-md-8">
                        <div class="col-md-4">
                            <img src="/img/<?php echo $komik['sampul']; ?>" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $komik['judul']; ?></h5>
                                <p class="card-text">Penulis : <?php echo $komik['penulis']; ?></p>
                                <p class="card-text"><small class="text-muted">
                                        Penerbit : <?php echo $komik['penerbit'] ?></small></p>

                                <a href="/komik/edit/<?php echo $komik['slug']; ?>" class="btn btn-warning">Edit</a>

                                <form action="/komik/<?php echo $komik['id']; ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin?')"
                                    >Hapus
                                    </button>
                                </form>
                                <div>
                                    <a href="/komik" class="btn btn-primary mt-3">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->endSection('content'); ?>