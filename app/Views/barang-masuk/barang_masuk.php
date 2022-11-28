<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
        <!-- <div class="btn btn-inline-primary tmpl insert-stock" id="insert-stock">+ Stok</div> -->
        <div style="overflow:auto">
    <table class="table-bordered table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama barang</th>
                <th scope="col">Dibuat oleh</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Satuan</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Tanggal</th>
            </tr>
            </thead>
            <tbody>
                <?php $no=1; krsort($barang); foreach($barang as $a):?>
                <tr>
                    <td scope="row"><?= $no ?></td>
                    <td scope="row" style="text-transform:capitalize"><?= $a['alias']?></td>
                    <td scope="row" style="text-transform:capitalize"><?= $a['created_by']?></td>
                    <td scope="row"><?= $a['qty']-0?></td>
                    <td scope="row"><?= $a['satuan']?></td>
                    <td scope="row"><?= $a['deskripsi']?></td>
                    <td scope="row"><?= $a['date_created']?></td>
                </tr>
                <?php $no++; endforeach?>
              </tbody>
        </table>
        <div></div>
        </div>
    <?= $this->include('dashboard/_partials/form/form') ?>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>