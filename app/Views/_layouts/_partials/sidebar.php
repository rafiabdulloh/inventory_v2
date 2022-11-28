<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link" style="position:absolute; text-align:-webkit-center">
        <img src="<?= base_url('image/home-icon.png')?>" alt="AdminLTE Logo" class="brand-image elevation-3 home" style="width: 25px;
    position: relative;
    top: 3px;
    left: 5px;
    opacity: .8" >
        <span class="brand-text">AGRIODUCT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar bg-gray-dark">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('image/user.png')?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="infod">
                <div class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="width:177px; margin-left:10px">
                    <div class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                           <?= $nameUser?>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/profil" class="nav-link">
                                    <p>Profil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <a href="#" class="d-block">Alexander Pierce</a> -->
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="/stok/barang" class="nav-link">
                    <i class='fas' style="margin-right:10px">&#xf1b2;</i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/penerimaan" class="nav-link">
                    <i class='fas' style="margin-right:10px">&#xf07a;</i>
                        <p>Penerimaan</p>
                        <?php if($pending_pen !== 0){ ?>
                        <span class="badge badge-danger right">
                                <?= $pending_pen;?>
                        </span>
                        <?php }?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengiriman" class="nav-link">
                    <i class='fas' style="margin-right:7px">&#xf0d1;</i>
                        <p>Pengiriman</p>
                        <?php if($pending !== 0 OR $leadup !== 0){ ?>
                        <span class="badge badge-warning right">
                                <?php if($pending > 0 && $leadup == 0){
                                    echo $pending;
                                    }if($leadup > 0 && $pending == 0){
                                        echo $leadup;
                                    }if($pending !== 0 && $leadup !== 0){
                                        echo $pending + $leadup;
                                    } ?>
                        </span>
                        <?php }?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/selesai" class="nav-link">
                    <i class='fas' style="margin-right:10px">&#xf0ae;</i>
                        <p>Catatan Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/barang/masuk" class="nav-link">
                        <i class="fas fa-cubes" style="margin-right:10px"></i>                                
                        <p>Barang Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/barang/keluar" class="nav-link">
                        <i class="fas fa-cubes" style="margin-right:10px"></i>
                        <p>Barang Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>