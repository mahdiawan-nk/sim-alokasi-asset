<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <?php $this->load->view('_partials/styles'); ?>
    <style>
        .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
            background-image: linear-gradient(310deg, #BAD0E5 0%, #BAD0E5 100%);
        }

        .bg-gradient-primary {
            background-image: linear-gradient(310deg, #BAD0E5 0%, #C9DBE9 100%);
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php $this->load->view('_partials/aside_admin'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <?php $this->load->view('_partials/navbar_admin'); ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <?php $this->load->view($pages); ?>
            <?php $this->load->view('_partials/footer'); ?>
            <!-- <footer class="footer pt-3">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>

                    </div>
                </div>
            </footer> -->
        </div>
    </main>

    <!--   Core JS Files   -->
    <?php $this->load->view('_partials/javascript'); ?>
    <?php $this->load->view('_partials/js_admin'); ?>
</body>

</html>