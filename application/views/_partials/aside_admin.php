<?php 
    $urlNow = $this->uri->segment(1); 
    $urlNext = $this->uri->segment(2);
    $joinUrl = $urlNow.'/'.$urlNext; 
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main" style="background: #BBD2E4;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?=base_url('dashboard')?>" target="_blank">
            <span class="ms-1 font-weight-bold">SI-ASSET</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= $urlNow == 'dashboard' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                    <i class="fa-solid fa-house icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Master</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $urlNow == 'karyawan' ? 'active' : '' ?>" href="<?= base_url('karyawan') ?>">
                    <i class="fa-solid fa-users icon icon-shape icon-xs shadow border-radius-md bg-white me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Data Pengguna Asset</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $urlNow == 'lokasi' ? 'active' : '' ?>" href="<?= base_url('lokasi') ?>">
                    <i class="fa-solid fa-map-location-dot icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Lokasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $urlNow == 'komputer' ? 'active' : '' ?>" href="<?= base_url('komputer') ?>">
                    <i class="fa-solid fa-laptop icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Perangkat PC/Laptop</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $urlNow == 'radio' ? 'active' : '' ?>"  href="<?= base_url('radio') ?>">
                    <i class="fa-solid fa-walkie-talkie icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Perangkat Radio</span>
                </a>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $urlNow == 'phone' ? 'active' : '' ?>" href="<?= base_url('phone') ?>">
                    <i class="fa-solid fa-square-phone-flip icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Perangkat Phone</span>
                </a>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Alokasi Asset</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $joinUrl == 'trx/komputer' ? 'active' : '' ?>" href="<?= base_url('trx/komputer') ?>">
                    <i class="fa-solid fa-laptop icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Perangkat PC/Laptop</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $joinUrl == 'trx/radio' ? 'active' : '' ?>" href="<?= base_url('trx/radio') ?>">
                    <i class="fa-solid fa-walkie-talkie icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Perangkat Radio</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $joinUrl == 'trx/phone' ? 'active' : '' ?>" href="<?= base_url('trx/phone') ?>">
                    <i class="fa-solid fa-square-phone-flip icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Perangkat Phone</span>
                </a>
            </li>
            <?php if($this->session->userdata('level') == 1): ?>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Management User</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $urlNow == 'pengguna' ? 'active' : '' ?>" href="<?= base_url('pengguna') ?>">
                    <i class="fa-solid fa-users icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
                    <span class="nav-link-text ms-1">Akses Pengguna</span>
                </a>
            </li>
            <?php endif ?>
        </ul>
    </div>
</aside>