<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
<div style="overflow:auto">
    <table class="table-bordered" id="myTable">
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php $no=1; krsort($laporan); foreach($laporan as $list):
                $a =$list['status'];
                switch($a){
                 case 0: $a = "<span style='background-color:green; color: white !important' class='btn'>Pending</span>";break;
                 case 1: $a = "<span class='act-success'>Success</span>";break;
                 case 2: $a = "<span class='act-cancel'>Canceled</span>";break;
                }
                ?>
            <tr>
                <td><?= $no?></td>
                <td style="text-transform:capitalize"><?= $list['alias']?></td>
                <td><?= $list['qty']?></td>
                <td><?= $list['satuan']?></td>
                <td style="text-transform:capitalize"><?= $list['tujuan']?></td>
                <td><?= $list['date_created']?></td>
                <td><?= $a?></td>
            </tr>
            <?php $no++; endforeach?>
        </tbody>
    </table>
</div>
        <?= $this->include('dashboard/_partials/form/form') ?>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>