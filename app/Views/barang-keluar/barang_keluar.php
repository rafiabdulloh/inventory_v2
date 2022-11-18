<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
        <!-- <div class="btn btn-inline-primary tmpl insert-stock" id="insert-stock">+ Stok</div> -->
    <table class="table-bordered table-hover" id="myTable">
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tujuan</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
        </thead>
        <tbody>
            <?php $no=1; krsort($keluar);foreach($keluar as $dist):?>
            <tr>
                <td><?= $no?></td>
                <td style="text-transform:capitalize"><?= $dist['alias']?></td>
                <td><?= $dist['qty']?></td>
                <td><?= $dist['satuan']?></td>
                <td style="text-transform:capitalize"><?= $dist['tujuan']?></td>
                <td><?= $dist['deskripsi']?></td>
                <td><?= $dist['date_created']?></td>
            </tr>
            <?php $no++; endforeach?>
        </tbody>
       </table>
    <?= $this->include('dashboard/_partials/form/form') ?>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>