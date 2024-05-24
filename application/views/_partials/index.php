<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <?php $this->load->view('_partials/styles'); ?>
    <style>
        body{
            background: linear-gradient(89deg, #BBD2E4, #C3D6E7);
        }
    </style>
</head>

<body class="">
    
    <main class="main-content  mt-0">
        <?php $this->load->view($pages); ?>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <?php $this->load->view('_partials/footer'); ?>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <?php $this->load->view('_partials/javascript'); ?>
</body>

</html>