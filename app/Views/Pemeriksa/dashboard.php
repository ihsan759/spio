<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

    <div class="row justify-content-center">

        <!-- Draft New -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1">
                                Draft New</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $new ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Draft New -->

        <!-- Draft Return  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-warning text-uppercase mb-1">
                                Draft Return</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $return ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Draft Return -->

        <!-- Draft Accept  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">
                                Draft Approved</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $approved ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Draft Accept -->

        <!-- Draft Reject -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-danger text-uppercase mb-1">
                                Draft Rejected</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rejected ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Draft Reject -->

    </div>

    <!-- Chart -->
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- End Chart -->

</div>

<?= $this->endSection(); ?>

<?= $this->section('plugin'); ?>

<!-- Page level plugins -->
<script src="<?= base_url() ?>/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script>
    const data = {
        labels: [
            'Draft New',
            'Draft Return',
            'Draft Approved',
            'Draft Rejected'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [<?= $new ?>, <?= $return ?>, <?= $approved ?>, <?= $rejected ?>],
            backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(114, 215, 102)',
                'rgb(255, 99, 132)'
            ],
            hoverOffset: 4
        }]
    };
    const config = {
        type: 'pie',
        data: data,
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

<?= $this->endSection(); ?>