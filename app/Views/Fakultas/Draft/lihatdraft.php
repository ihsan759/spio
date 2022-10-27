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
            <?php if (session()->getFlashdata('warning')) : ?>
                <div class="alert alert-warning alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">x</button>
                        <?= session()->getFlashdata('warning') ?>
                    </div>
                </div>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul Draft</th>
                            <th>Tanggal Input Arsip</th>
                            <th>Pemeriksa</th>
                            <th>Jenis</th>
                            <th>File Dekan</th>
                            <th>Catatan Pemeriksa</th>
                            <th>Status Pemeriksa</th>
                            <th>Status Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($draft as $data) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td class="text-center"><?= $data['created_at'] ?></td>
                                <td class="text-center">
                                    <?php $sum = 0;
                                    foreach ($pemeriksa as $row) :
                                        if ($data['id_pemeriksa'] == $row['id_pemeriksa']) : ?>
                                            <?php if ($row['status_pemeriksa'] != 'Approved') {
                                                echo $row['roles'];
                                            } else {
                                                echo 'SPIO';
                                            }
                                            ?>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="text-center"><?= $data['jenis'] ?></td>
                                <td>
                                    <?php foreach ($pemeriksa as $row) :
                                        if ($data['id_pemeriksa'] == $row['id_pemeriksa'] && $row['file'] != null) : ?>
                                            <a href="<?= base_url('/file/draft/Pemeriksa') ?>/<?= $row['file'] ?>" class="text-primary" download><?= $row['file'] ?></a>
                                    <?php
                                        endif;
                                    endforeach; ?>
                                </td>
                                <td class="text-center">
                                    <?php foreach ($pemeriksa as $row) :
                                        if ($data['id_pemeriksa'] == $row['id_pemeriksa'] && $row['catatan_pemeriksa'] != null) : ?>
                                            <a href="" class="text-info" data-toggle="modal" data-target="#modalcatatan" data-catatan="<?= $row['catatan_pemeriksa']; ?>" data-judul="Catatan Pemeriksa"><?= $row['roles'] ?></a><br>
                                    <?php
                                        endif;
                                    endforeach; ?>
                                </td>
                                <td class="text-center">
                                    <?php foreach ($pemeriksa as $row) :
                                        if ($data['id_pemeriksa'] == $row['id_pemeriksa']) : ?>
                                            <?php if ($row['status_pemeriksa'] != 'Approved') {
                                                echo $row['status_pemeriksa'];
                                            } else {
                                                echo $data['status'];
                                            }
                                            ?>
                                    <?php
                                        endif;
                                    endforeach; ?>

                                </td>
                                <td class="text-center"><?= $data['status'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('/file/draft/') ?>/<?= $data['file_draft'] ?>" class="text-primary" download><i class="fas fa-download"></i></a>
                                    <?php if ($data['status'] != 'Approved' && $data['status'] != 'Rejected') { ?>
                                        <a href="" class="text-info" data-toggle="modal" data-target="#modaledit" data-id="<?php echo $data['id']; ?>"><i class="fas fa-pen"></i></a>
                                        <a href="<?= site_url('Draft/Delete/') . $data['id'] ?>" class="text-danger" onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                    <?php } ?>
                                    <?php if ($data['status'] == 'Approved' || $data['status'] == 'Rejected') { ?>
                                        <a href="<?= site_url('Draft/History/Input/') . $data['id'] ?>" class="text-success" onclick="return confirm('Apakah anda ingin memasukkan data ini kedalam history ?')"><i class="fas fa-check"></i></a>
                                    <?php } ?>
                                    <a href="" class="text-info" data-toggle="modal" data-target="#modalinfo" data-id="<?php echo $data['id']; ?>" data-catatan="<?php echo $data['catatan']; ?>" data-judul="Info Draft" data-pembuat="Pembuat Draft : <?php echo $data['nama']; ?>"><i class="fas fa-info-circle"></i></a>
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
<script src="<?= base_url() ?>/js/demo/Draft/lihat-draft-fakultas.js"></script>

<!-- Modal Catatan -->
<script src="<?= base_url() ?>/js/modal/catatan.js"></script>
<script src="<?= base_url() ?>/js/modal/catatan_pemeriksa.js"></script>
<script src="<?= base_url() ?>/js/modal/update.js"></script>

<?= $this->endSection(); ?>