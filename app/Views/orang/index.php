<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Daftar Orang</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan keyword pencarian..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <?php $i = 1 + (6 * ($currentPage - 1));?>
                <?php foreach ($orang as $k): ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $k['nama']; ?></td>
                    <td><?php echo $k['alamat']; ?></td>
                    <td><a class="btn btn-success">Detail</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $pager->links('orang', 'orang_pagination'); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection('content'); ?>
