<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
        <!-- <div class="btn btn-inline-primary tmpl insert-stock" id="insert-stock">+ Stok</div> -->
    <button class="operasi btn btn-primary" id="btn">
        Operasional
    </button>
        <ul class="primary list-unstyled ul" style="display:none"id="toggle">
            <li class="item has-primary"  data-toggle="modal" data-target="#penerimaan">
                <button type="button" class="btn">
                    <i class="ion ion-plus" style="margin-right:5px"></i>
                    Penerimaan
                </button>
            </li>
            <li class="item has-primary"  data-toggle="modal" data-target="#tambah-stok">
                <button type="button" class="btn">
                    <i class="ion ion-plus" style="margin-right:5px"></i>
                    Stok
                </button>
            </li>
            <li class="item has-primary"  data-toggle="modal" data-target="#tambah-barang">
                <button type="button" class="btn">
                    <i class="ion ion-plus" style="margin-right:5px"></i>
                    Barang
                </button>
            </li>
            <li class="item has-primary"  data-toggle="modal" data-target="#kirim" data-qty="">
                <button class="btn">
                    <i class="ion ion-plus" style="margin-right:5px"></i>
                    Pengiriman
                </button>
            </li>
        </ul>
        <!-- <div style="display:block;overflow-y:auto"> -->
    <table class="table-bordered table table-hover" id="myTable">
	    <thead>
            <th>No</th>
            <th>Name</th>
            <th>Stok barang</th>
            <?php if($accessibility == "admin"){ ?>
            <th style="text-align:center ;width:100px">Action</th>
                <?php }?>
	    </thead>
	    <tbody>
            <?php $no=1; foreach($stokBarang as $brg): foreach($barang as $a);?>
        <tr>
	    	<td><?= $no ?></td>
	    	<td style="text-transform:capitalize"><?= $brg['alias']?></td>
	    	<td><?= $brg['qty']?> Kg</td>
            <?php if($accessibility == "admin"){ ?>
	    	<td style="text-align:center">
                <a href="/delete/stock/<?= $brg['id']?>" style="color:#e61a1a">
                    <i class="ion-trash-a btn btn-danger" style="width:40px"></i>
                </a>
                <a data-toggle="modal" data-target="#edit-stok" href="edit/stok/<?= $brg['id']?>" class="edit" data-id="<?= $brg['id']?>" data-alias="<?= $brg['alias']?>" data-stok="<?= $brg['qty']?>">
                    <i class="ion-edit btn btn-primary" style="width:40px"></i>
                </a>
            </td>
            <?php }?>
        </tr>
            <?php $no++; endforeach; ?>
	    </tbody>
    </table>
    <?= $this->include('dashboard/_partials/form/form') ?>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>