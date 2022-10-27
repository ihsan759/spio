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
                            <th>Pembuat Draft</th>
                            <th>Tanggal Input Draft</th>
                            <th>Status</th>
                            <th>Tanggal Terakhir Ubah Status</th>
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
                                <td><?= $data['jobdesk'] ?></td>
                                <td class="text-center"><?= $data['created_at'] ?></td>
                                <td class="text-center"><?= $data['status_pemeriksa'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($data['tgl_ubah_status'] != null) {
                                        echo $data['tgl_ubah_status'];
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($data['status_pemeriksa'] != 'Approved' && $data['status_pemeriksa'] != 'Rejected') : ?>
                                        <a href="" class="text-info" data-toggle="modal" data-target="#modalfile" data-no="<?php echo $data['no']; ?>" data-idpemeriksa="<?php echo $data['id_pemeriksa']; ?>" data-id="<?php echo $data['id']; ?>"><i class="fas fa-pen"></i></a>
                                    <?php endif ?>
                                    <a href="<?= base_url('/file/draft/') ?>/<?= $data['file_draft'] ?>" class="text-primary" download><i class="fas fa-download"></i></a>
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
<script src="<?= base_url() ?>/js/demo/Draft/history-draft-pemeriksa.js"></script>

<!-- Modal Catatan -->
<script src="<?= base_url() ?>/js/modal/catatan.js"></script>
<script src="<?= base_url() ?>/js/modal/file.js"></script>

<?= $this->endSection(); ?>