<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="<?= base_url(); ?>/img/logo.png" />

    <title>Reset Password</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweet Alert 2 Library-->
    <link href="<?= base_url(); ?>/css/sweetalert2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-dark">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter Your Email..." required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="token" class="form-control form-control-user" id="inputToken" aria-describedby="tokenHelp" placeholder="Enter Your Reset Token..." required maxlength="12">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="inputPassword" placeholder="Enter New Password..." required maxlength="12">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="confirmPassword" class="form-control form-control-user" id="inputConfirmPassword" placeholder="Confirm New Password..." required maxlength="12">
                                        </div>

                                        <div class="mb-3">
                                            <input type="submit" name="btnResetPass" class="btn btn-primary btn-user btn-block" value="Reset Password">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/home">Already Reset Password ? Login Here !!!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

    <script src="<?= base_url(); ?>/js/sweetalert2.all.min.js"></script>

    <script>
        <?php if (session()->get('reset_password_message')) : ?>
            Swal.fire(
                'Password Berhasil di Reset',
                '<?= session()->getFlashdata('reset_password_message'); ?>',
                'success'
            )
        <?php endif; ?>

        <?php if (session()->get('reset_password_error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Password Gagal di Reset',
                text: '<?= session()->getFlashdata('reset_password_error'); ?>',
                footer: 'Gagal Membuat Reset Password, Coba Lagi !!!'
            })
        <?php endif; ?>
    </script>

</body>

</html>