<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <!-- count of value -->
                <h3><?= count($penerimaan)?></h3> 
<!-- penerimaan -->
                <!-- <p>New Orders</p> -->
                <p>Penerimaan</p>
            </div>
            <div class="icon">
                <i style='font-size:50px' class='fas'>&#xf07a;</i>
            </div>
            <a href="/penerimaan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <!-- count of value -->
                <h3><?= count($stok)?></h3>
                <!-- font persen -->
                <!-- <sup style="font-size: 20px">%</sup> -->
                <p>Stok Barang</p>
            </div>
            <div class="icon">
                <!-- icon stok barang -->
                <i style='font-size:50px' class='fas'>&#xf1b2;</i>
            </div>
            <a href="/stok/barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <!-- count of value -->
                <h3><?= count($pengiriman)?></h3>

                <p>Pengiriman</p>
            </div>
            <div class="icon">
                <!-- icon truck -->
                <i style='font-size:50px' class='fas'>&#xf0d1;</i>
            </div>
            <a href="/pengiriman" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <!-- count of value -->
                <h3><?= count($selesai)?></h3>

                <p>Selesai</p>
            </div>
            <div class="icon">
                <!-- icon list report -->
                <i style='font-size:50px' class='fas'>&#xf0ae;</i>
            </div>
            <a href="/selesai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <!-- count of value -->
                <h3><?= count($barang_masuk)?></h3>

                <p>Barang Masuk</p>
            </div>
            <div class="icon">
                <!-- icon list report -->
                <i class="fas fa-cubes" style="font-size:50px"></i>
            </div>
            <a href="/barang/masuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-dark">
            <div class="inner">
                <!-- count of value --> 
                <h3><?= count($barang_keluar)?></h3>

                <p>Barang Keluar</p>
            </div>
            <div class="icon">
                <!-- icon list report -->
                <i class="fas fa-cubes" style="font-size:50px"></i>
            </div>
            <a href="/barang/keluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <?php if($accessibility == "admin"){?>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <!-- count of value --> 
                <h3><?= count($user)?></h3>

                <p>Pengguna</p>
            </div>
            <div class="icon">
                <!-- icon list report -->
                <i class="far fa-user-circle" style="font-size:50px"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <?php }?>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">
                <!-- count of value --> 
                <h3><?= count($lokasi)?></h3>

                <p>Lokasi Penerima</p>
            </div>
            <div class="icon">
                <!-- icon list report -->
                <i class="fas fa-map-marker-alt" style="font-size:50px"></i>
            </div>
            <a href="/lokasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>