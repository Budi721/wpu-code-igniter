<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Daftar Komik</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <?php $i = 1;?>
                <?php foreach ($komik as $k): ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><img src="/img/<?php echo $k['sampul']; ?>" alt="" class="sampul"></td>
                    <td><?php echo $k['judul']; ?></td>
                    <td><a href="/komik/<?php echo $k['slug']; ?>" class="btn btn-success">Detail</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $this->endSection('content'); ?>
