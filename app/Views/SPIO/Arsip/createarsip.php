<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">Input Arsip</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="<?= site_url('Arsip/Add') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="nip" value="<?= session('nip') ?>">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="JudulArsip">Judul Arsip<span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= ($validation->hasError('judul_arsip')) ? 'is-invalid' : '' ?>" id="JudulArsip" name="judul_arsip" value="<?= old('judul_arsip') ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul_arsip'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputArsip">Input Arsip<span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file <?= ($validation->hasError('file_arsip')) ? 'is-invalid' : '' ?>" id="InputArsip" name="file_arsip" accept=".pdf,.docx">
                                <small id="InputArsip" class="form-text text-muted">Silahkan menginputkan file dengan extensi pdf atau docx.</small>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('file_arsip'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="JenisArsip">Jenis Arsip<span class="text-danger">*</span></label>
                            <select class="form-control <?= ($validation->hasError('jenis_arsip')) ? 'is-invalid' : '' ?>" id="JenisArsip" name="jenis_arsip">
                                <option value="MoU">MoU</option>
                                <option value="MoA">MoA</option>
                                <option value="IA">IA</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_arsip'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="TanggalKerjasama">Tanggal Kerjasama<span class="text-danger">*</span></label>
                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_kerjasama')) ? 'is-invalid' : '' ?>" id="TanggalKerjasama" name="tanggal_kerjasama" value="<?= old('tanggal_kerjasama') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_kerjasama'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Tanggalkadaluarsa">Tanggal kadaluarsa<span class="text-danger">*</span></label>
                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_kadaluarsa')) ? 'is-invalid' : '' ?>" id="Tanggalkadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_kadaluarsa'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ckeditor">Catatan</label>
                            <textarea class="form-control" id="ckeditor" name="catatan"><?= old('catatan') ?></textarea>
                            <script>
                                CKEDITOR.replace('catatan');
                            </script>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>