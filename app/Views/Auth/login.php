<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- css login -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/login.css">
    <link rel="icon" type="/image/png" href="/image/telyu.png" />

    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center py-5 text-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url() ?>/image/telyu.png" class="img-fluid" alt="<?= base_url() ?>/image/telyu.png">
                        <form class="mt-5 user" action="<?= site_url('/') ?>" method="POST">
                            <?= csrf_field() ?>
                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Username" class="form-control rounded-pill" id="Username" aria-describedby="username" name="username" autofocus autocomplete='off'>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" class="form-control rounded-pill" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>