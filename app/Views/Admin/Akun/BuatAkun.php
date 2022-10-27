<?= $this->extend('Admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">Membuat Akun</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-7">
      <div class="card shadow">
        <div class="card-body">
          <form method="POST" action="<?= site_url('Admin/Store') ?>">
            <?= csrf_field() ?>
            <div class="form-group">
              <label for="nip">NIP<span class="text-danger">*</span></label>
              <input type="text" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : '' ?>" id="nip" name="nip" value="<?= old('nip') ?>" autofocus>
              <div class="invalid-feedback">
                <?= $validation->getError('nip'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="nama">Nama<span class="text-danger">*</span></label>
              <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="jk">Jenis Kelamin<span class="text-danger">*</span></label>
              <select class="form-control <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>" id="jk" name="jk">
                <option selected></option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('jk'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Username<span class="text-danger">*</span></label>
              <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password<span class="text-danger">*</span></label>
              <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" value="<?= old('password') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('password'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="jobdesk">Jobdesk<span class="text-danger">*</span></label>
              <select class="form-control <?= ($validation->hasError('jobdesk')) ? 'is-invalid' : '' ?>" id="jk" name="jobdesk">
                <option selected></option>
                <option value="SPIO">SPIO</option>
                <option value="Dekan">Dekan</option>
                <option value="Administrasi">Administrasi</option>
                <option value="Pemeriksa">Pemeriksa</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('jobdesk'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="fakultas">Fakultas <small>(Wajib isi untuk Administrasi dan Dekan)</small></label>
              <select class="form-control <?= ($validation->hasError('fakultas')) ? 'is-invalid' : '' ?>" id="jk" name="fakultas">
                <option selected></option>
                <option value="Fakultas Teknik Elektro">Fakultas Teknik Elektro</option>
                <option value="Fakultas Rekayasa Industri">Fakultas Rekayasa Industri</option>
                <option value="Fakultas Informatika">Fakultas Informatika</option>
                <option value="Fakultas Ekonomi dan Bisnis">Fakultas Ekonomi dan Bisnis</option>
                <option value="Fakultas Komunikasi dan Bisnis">Fakultas Komunikasi dan Bisnis</option>
                <option value="Fakultas Industri Kreatif">Fakultas Industri Kreatif</option>
                <option value="Fakultas Ilmu Terapan">Fakultas Ilmu Terapan</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('fakultas'); ?>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>