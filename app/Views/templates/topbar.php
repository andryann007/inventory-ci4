<nav class="navbar navbar-expand navbar-light bg-secondary topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="copyright text-center my-auto">
    <span class="text-light">Today Date : <b><?= date("d-m-Y");?></b></span>
  </div>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-white">
          Halo, <b><?php echo session()->get('nama_lengkap'); ?> (<?php echo session()->get('tipe_akun'); ?>)</b>
        </span>
        <img class="img-profile rounded-circle" src="<?= base_url(); ?>/img/undraw_profile.svg" />
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?php echo site_url('/admin/logout');?>">
          <i class="fas fa-power-off a-sm fa-fw mr-2 text-dark"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>