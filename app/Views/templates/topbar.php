<nav class="navbar navbar-expand navbar-light bg-secondary topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="copyright text-center my-auto">
    <span class="text-light">Today Date : <b>
      <?php
        date_default_timezone_set('Asia/Jakarta');
        echo date("d F Y");
      ?> / 
      <?php 
        $today = time();
        date_default_timezone_set('Asia/Jakarta');
        echo date("H:i:s", $today);
      ?>
    </b></span>
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
        <button
          type="button"
          class="btn dropdown-item btn-sm"
          id="btnProfile"
          role="button"
          data-toggle="modal"
          data-target="#myProfileModal"
          data-id="<?= session()->get('id_user');?>"
          data-nama="<?= session()->get('nama_lengkap');?>"
          data-email="<?= session()->get('email');?>"
          data-username="<?= session()->get('username');?>"
          data-password="<?= session()->get('password');?>"
          data-alamat="<?= session()->get('alamat');?>"
          data-telp="<?= session()->get('telp');?>"
          data-tipe="<?= session()->get('tipe_akun');?>">

          <i class="fas fa-user a-sm fa-fw mr-2 text-dark"></i>
          My Profiles
        </button>

        <div class="dropdown-divider"></div>
        
        <a class="dropdown-item" 
        href="<?php if(session()->get('tipe_akun') == "Owner"){
          echo site_url('/owner/logout');
        } else if(session()->get('tipe_akun') == "Admin"){
          echo site_url('/admin/logout');
        } else {
          echo site_url('/user/logout');
        }?>">
          <i class="fas fa-power-off a-sm fa-fw mr-2 text-dark"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>

  <!-- My Profile Modal -->
  <div
    class="modal fade"
    id="myProfileModal"
    tabindex="-1"
    aria-labelledby="myProfileModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myProfileModallLabel">My Profiles</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <?php if(session()->get('tipe_akun') == "Owner") :?>
        <form action='/owner/change_password' method="post">

          <div class="modal-body">
            <input
              type="hidden"
              id="idUser"
              name="idUser"
              class="form-control"
            />
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaUser">Nama Lengkap</label>
                  <input
                    type="text"
                    name="namaUser"
                    id="namaUser"
                    class="form-control"
                    readonly
                  />
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="emailUser">Email</label>
                  <input
                    type="email"
                    name="emailUser"
                    id="emailUser"
                    class="form-control"
                    readonly
                  />
                </div>

                <div class="form-group">
                  <label for="passUser">Password</label>
                  <div class="input-group" id="passwordVisibility">
                    <input
                      type="password"
                      name="passUser"
                      id="passUser"
                      class="form-control"
                      required
                    />
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary toogle-password" type="button" id="tooglePassword">
                        <i class="fas fa-eye"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="telp">No. Telp</label>
                  <input
                    type="textarea"
                    name="telpUser"
                    id="telpUser"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="tipeAkun">Tipe Akun</label>
                  <input
                    type="textarea"
                    name="tipeAkunUser"
                    id="tipeAkunUser"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Lengkap</label>
              <input
                type="textarea"
                name="alamatUser"
                id="alamatUser"
                class="form-control"
                readonly
              />
            </div>
            
          </div>

          <div class="d--sm-flex modal-footer mb-4">
            <button type="submit" class="btn btn-warning" name="changePassword">
              <i class="fas fa-edit"></i> Change Password
            </button>
          </div>
        </form>
        <?php endif;?>
        
        <?php if(session()->get('tipe_akun') == "Admin") :?>
        <form action='/admin/change_password' method="post">

          <div class="modal-body">
            <input
              type="hidden"
              id="idUser"
              name="idUser"
              class="form-control"
            />

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaUser">Nama Lengkap</label>
                  <input
                    type="text"
                    name="namaUser"
                    id="namaUser"
                    class="form-control"
                    readonly
                  />
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="emailUser">Email</label>
                  <input
                    type="email"
                    name="emailUser"
                    id="emailUser"
                    class="form-control"
                    readonly
                  />
                </div>

                <div class="form-group">
                  <label for="passUser">Password</label>
                  <div class="input-group" id="passwordVisibility">
                    <input
                      type="password"
                      name="passUser"
                      id="passUser"
                      class="form-control"
                      required
                    />
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary toogle-password" type="button" id="tooglePassword">
                        <i class="fas fa-eye"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="telp">No. Telp</label>
                  <input
                    type="textarea"
                    name="telpUser"
                    id="telpUser"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="tipeAkun">Tipe Akun</label>
                  <input
                    type="textarea"
                    name="tipeAkunUser"
                    id="tipeAkunUser"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Lengkap</label>
              <input
                type="textarea"
                name="alamatUser"
                id="alamatUser"
                class="form-control"
                readonly
              />
            </div>
            
          </div>

          <div class="d--sm-flex modal-footer mb-4">
            <button type="submit" class="btn btn-warning" name="changePassword">
              <i class="fas fa-edit"></i> Change Password
            </button>
          </div>
        </form>
        <?php endif;?>

        <?php if(session()->get('tipe_akun') == "User") :?>
        <form action='/user/change_password' method="post">

          <div class="modal-body">
            <input
              type="hidden"
              id="idUser"
              name="idUser"
              class="form-control"
            />

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaUser">Nama Lengkap</label>
                  <input
                    type="text"
                    name="namaUser"
                    id="namaUser"
                    class="form-control"
                    readonly
                  />
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="emailUser">Email</label>
                  <input
                    type="email"
                    name="emailUser"
                    id="emailUser"
                    class="form-control"
                    readonly
                  />
                </div>

                <div class="form-group">
                  <label for="passUser">Password</label>
                  <div class="input-group" id="passwordVisibility">
                    <input
                      type="password"
                      name="passUser"
                      id="passUser"
                      class="form-control"
                      required
                    />
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary toogle-password" type="button" id="tooglePassword">
                        <i class="fas fa-eye"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="telp">No. Telp</label>
                  <input
                    type="textarea"
                    name="telpUser"
                    id="telpUser"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="tipeAkun">Tipe Akun</label>
                  <input
                    type="textarea"
                    name="tipeAkunUser"
                    id="tipeAkunUser"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Lengkap</label>
              <input
                type="textarea"
                name="alamatUser"
                id="alamatUser"
                class="form-control"
                readonly
              />
            </div>
            
          </div>

          <div class="d--sm-flex modal-footer mb-4">
            <button type="submit" class="btn btn-warning" name="changePassword">
              <i class="fas fa-edit"></i> Change Password
            </button>
          </div>
        </form>
        <?php endif;?>
      </div>
    </div>
  </div>