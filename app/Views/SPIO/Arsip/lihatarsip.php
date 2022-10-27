<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">x</button>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                </div>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul Arsip</th>
                            <th>Jenis</th>
                            <th>Tanggal Input Arsip</th>
                            <th>Tanggal Kerjasama</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($arsip as $data) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td class="text-center"><?= $data['jenis'] ?></td>
                                <td class="text-center"><?= $data['created_at'] ?></td>
                                <td class="text-center"><?= $data['tgl_kerjasama'] ?></td>
                                <td class="text-center"><?= $data['tgl_kadaluarsa'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($data['selisih'] > 0) {
                                        echo 'Berlaku (sisa ' . $data['selisih'] . ' hari)';
                                    } else {
                                        echo 'Kadaluarsa';
                                    } ?>
                                </td>
                                <td><a href="<?= base_url('/file/arsip/') ?>/<?= $data['file_arsip'] ?>" class="text-primary" download><i class="fas fa-download"></i></a>
                                    <a href="<?= site_url('Arsip/Delete/') . $data['id'] ?>" class="text-danger" onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                    <a href="" class="text-info" data-toggle="modal" data-target="#modalinfo" data-id="<?php echo $data['id']; ?>" data-catatan="<?php echo $data['catatan']; ?>" data-judul="Info Arsip" data-pembuat="Pembuat Arsip : <?php echo $data['nama']; ?>"><i class="fas fa-info-circle"></i></a>
                                    <a href="<?= site_url('Arsip/History/Input/') . $data['id'] ?>" class="text-success" onclick="return confirm('Apakah anda ingin memasukkan data ini kedalam history ?')"><i class="fas fa-check"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('plugin'); ?>
<!-- Page level plugins -->
<script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/vendor/SearchBuilder/dataTables.searchBuilder.min.js"></script>
<script src="<?= base_url() ?>/vendor/SearchBuilder/searchBuilder.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/vendor/DateTime/dataTables.dateTime.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/js/demo/Arsip/lihat-arsip-spio.js"></script>

<!-- Modal Catatan -->
<script src="<?= base_url() ?>/js/modal/catatan.js"></script>

<?= $this->endSection(); ?>