<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">Input Draft</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="<?= site_url('Draft/Add') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="nip" value="<?= session('nip') ?>">
                        <div class="form-group">
                            <label for="JudulDraft">Judul Draft<span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= ($validation->hasError('judul_Draft')) ? 'is-invalid' : '' ?>" id="JudulDraft" name="judul_Draft" value="<?= old('judul_Draft') ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul_Draft'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputDraft">Input Draft<span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file <?= ($validation->hasError('file_Draft')) ? 'is-invalid' : '' ?>" id="InputDraft" name="file_Draft" accept=".pdf,.docx">
                            <small id="InputDraft" class="form-text text-muted">Silahkan menginputkan file dengan extensi pdf atau docx. <a href="<?= base_url('/template_draft') ?>/Template draft.docx" class="text-primary" download>Template Draft</a></small>
                            <div class="invalid-feedback">
                                <?= $validation->getError('file_Draft'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="JenisDraft">Jenis Draft<span class="text-danger">*</span></label>
                            <select class="form-control <?= ($validation->hasError('jenis_Draft')) ? 'is-invalid' : '' ?>" id="JenisDraft" name="jenis_Draft">
                                <option value="MoU">MoU</option>
                                <option value="MoA">MoA</option>
                                <option value="IA">IA</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_Draft'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Pemeriksa">Pemeriksa<span class="text-danger">*</span></label>
                            <select class="form-control <?= ($validation->hasError('pemeriksa')) ? 'is-invalid' : '' ?>" id="Pemeriksa" name="pemeriksa[]" multiple="multiple">
                                <?php foreach ($draft as $data) : ?>
                                    <option value="<?= $data['nip'] ?>"><?= $data['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('pemeriksa'); ?>
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

<?= $this->section('plugin'); ?>

<script src="<?= base_url() ?>/js/select2/petugas.js"></script>

<?= $this->endSection(); ?>