 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">WEBGIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <p class="text-lg text-white"><?=$session->get("nm_pengguna")?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <?php if ($session->get('level')=='Admin'): ?>
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=url('kecamatan')?>" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kecamatan</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=url('Rumah-Sakit')?>" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rumah Sakit</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=url('Menu-Informasi')?>" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Informasi</p>
                </a>
              </li>
            </ul>
            
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=url('Menu-Mencari-Jarak')?>" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Mencari Jarak</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=url('test-1')?>" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Jarak</p>
                </a>
              </li>
            </ul>
            
          </li>
          <li class="nav-item">
            <a href="<?=url('logout')?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
              <p>
                Keluar
               
              </p>
            </a>
          </li>
          
         
          
           
             
             
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>