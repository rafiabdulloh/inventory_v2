<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <!-- count of value -->
                <h3><?= count($penerimaan)?></h3> 
<!-- penerimaan -->
                <!-- <p>New Orders</p> -->
                <p class="blod">Penerimaan</p>
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

                <p>Catatan Laporan</p>
            </div>
            <div class="icon">
                <!-- icon list report -->
                <i class='fas' style="margin-right:10px">&#xf0ae;</i>
            </div>
            <a href="/selesai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
</div>