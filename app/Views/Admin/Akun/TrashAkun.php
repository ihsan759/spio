<?= $this->extend('Admin/layout/template'); ?>

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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Username</th>
                            <th>Jobdesk</th>
                            <th>Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($akun as $data) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $data['nip'] ?></td>
                                <td class="text-center"><?= $data['nama'] ?></td>
                                <td class="text-center"><?= $data['jenis_kelamin'] ?></td>
                                <td class="text-center"><?= $data['username'] ?></td>
                                <td class="text-center"><?= $data['jobdesk'] ?></td>
                                <td class="text-center"><?= $data['fakultas'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('/Admin/Back/') ?>/<?= $data['nip'] ?>" class="text-danger" onclick="return confirm('Apakah anda ingin membatalkan penghapusan data ?')"><i class="fas fa-arrow-left"></i></a>
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
<script src="<?= base_url() ?>/js/demo/Admin/datatables-demo.js"></script>
<?= $this->endSection(); ?>