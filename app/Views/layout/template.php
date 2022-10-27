<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/vendor/SearchBuilder/searchBuilder.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/vendor/DateTime/dataTables.dateTime.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="icon" type="/image/png" href="/image/telyu.png"/>

    <!-- ckeditor 4 -->
    <script src="<?= base_url('ckeditor/ckeditor.js'); ?>"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <img src="<?= base_url() ?>/image/telyu.png" class="rounded mx-auto d-block img-fluid mb-3 mt-3" alt="...">

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <?php if (session('jobdesk' != 'SPIO')) : ?>
                    <a class="nav-link">Hi, <?= session('nama') ?></a>
                <?php endif ?>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <?php if (session('jobdesk') == 'SPIO') { ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Nav Item - Draft Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDraft" aria-expanded="true" aria-controls="collapseDraft">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Draft</span>
                    </a>
                    <div id="collapseDraft" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Draft Menu:</h6>
                            <a class="collapse-item" href="<?= base_url('Draft/Create') ?>">Input Draft</a>
                            <a class="collapse-item" href="<?= base_url('Draft/Index') ?>">Lihat Draft</a>
                            <a class="collapse-item" href="<?= base_url('Draft/Trash') ?>">Trash</a>
                            <a class="collapse-item" href="<?= base_url('Draft/History') ?>">History Draft</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Arsip Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArsip" aria-expanded="true" aria-controls="collapseArsip">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Arsip</span>
                    </a>
                    <div id="collapseArsip" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Arsip Menu:</h6>
                            <a class="collapse-item" href="<?= base_url('Arsip/Create') ?>">Input Arsip</a>
                            <a class="collapse-item" href="<?= base_url('Arsip/Index') ?>">Lihat Arsip</a>
                            <a class="collapse-item" href="<?= base_url('Arsip/Trash') ?>">Trash</a>
                            <a class="collapse-item" href="<?= base_url('Arsip/History') ?>">History Arsip</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item Pemeriksa -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePemeriksa" aria-expanded="true" aria-controls="collapsePemeriksa">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pemeriksa</span>
                    </a>
                    <div id="collapsePemeriksa" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pemeriksa Menu:</h6>
                            <a class="collapse-item" href="<?= base_url('Pemeriksa/Index') ?>">Lihat Draft</a>
                            <a class="collapse-item" href="<?= base_url('Pemeriksa/History') ?>">History Draft</a>
                        </div>
                    </div>
                </li>

            <?php } elseif (session('jobdesk') == 'Pemeriksa' || session('jobdesk') == 'Dekan') { ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Nav Item - Draft Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDraft" aria-expanded="true" aria-controls="collapseDraft">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Draft</span>
                    </a>
                    <div id="collapseDraft" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Draft Menu:</h6>
                            <a class="collapse-item" href="<?= base_url('Pemeriksa/Index') ?>">Lihat Draft</a>
                            <a class="collapse-item" href="<?= base_url('Pemeriksa/History') ?>">History Draft</a>
                        </div>
                    </div>
                </li>
            <?php } elseif (session('jobdesk') == 'Administrasi') { ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Nav Item - Draft Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDraft" aria-expanded="true" aria-controls="collapseDraft">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Draft</span>
                    </a>
                    <div id="collapseDraft" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Draft Menu:</h6>
                            <a class="collapse-item" href="<?= base_url('Draft/Create') ?>">Input Draft</a>
                            <a class="collapse-item" href="<?= base_url('Draft/Index') ?>">Lihat Draft</a>
                            <a class="collapse-item" href="<?= base_url('Draft/Trash') ?>">Trash</a>
                            <a class="collapse-item" href="<?= base_url('Draft/History') ?>">History Draft</a>
                        </div>
                    </div>
                </li>

            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-gradient-danger topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-power-off"></i>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('content'); ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SPIO 2022 Direktorat Telkom University</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Section -->
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan tombol logout untuk keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade" id="modalinfo" tabindex="-1" role="dialog" aria-labelledby="modalinfoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinfoLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-break" id="pembuat"></p>
                    <hr>
                    <p class="text-break" id="catatan"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('Draft/Update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="InputDraft">Input Draft<span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" id="InputDraft" name="file_Draft" accept=".pdf,.docx">
                        </div>
                        <input type="hidden" name="id" id="id_update_draft">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- File Modal -->
    <div class="modal fade" id="modalfile" tabindex="-1" role="dialog" aria-labelledby="modalfileLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('Pemeriksa/Update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="no" id="no">
                        <input type="hidden" name="id_pemeriksa" id="id_pemeriksa">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="InputDraft">Input Draft<span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" id="InputDraft" name="file" accept=".pdf,.docx">
                            <small id="InputDraft" class="form-text text-muted">Silahkan menginputkan file dengan extensi pdf atau docx.</small>
                        </div>
                        <div class="form-group">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status_pemeriksa">
                                <option value="Approved">Approved</option>
                                <option value="Return">Return</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <?php if (session('jobdesk') != 'SPIO') : ?>
                            <div class="form-group">
                                <label for="ckeditor">Catatan</label>
                                <textarea class="form-control" id="ckeditor" name="catatanpemeriksa"></textarea>
                                <script>
                                    CKEDITOR.replace('catatanpemeriksa');
                                </script>
                            </div>
                        <?php endif ?>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Catatan Modal -->
    <div class="modal fade" id="modalcatatan" tabindex="-1" role="dialog" aria-labelledby="modalcatatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalcatatanLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-break" id="catatan_pemeriksa"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <?= $this->renderSection('plugin'); ?>

</body>

</html>