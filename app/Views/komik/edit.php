<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Komik</h2>

            <form action="/komik/update/<?php echo $komik['id']; ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="slug" value="<?php echo $komik['slug']; ?>">
                <div class="row mb-3">
                    <label for="judul"
                           class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control <?php echo ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>"
                               name="judul" id="judul"
                               value="<?php echo (old('judul')) ? old('judul') : $komik['judul']; ?>">
                        <div class="invalid-feedback">
                            <?php echo $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="penulis" id="penulis"
                               value="<?php echo (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="penerbit" id="penerbit"
                               value="<?php echo (old('penerbit')) ? old('penerbit') : $komik['penerbit']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sampul" id="sampul"
                               value="<?php echo (old('sampul')) ? old('sampul') : $komik['sampul']; ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>

        </div>
    </div>
</div>

<?php echo $this->endSection('content'); ?>
