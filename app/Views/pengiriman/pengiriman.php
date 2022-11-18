<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
    <table class="table-bordered table-hover" id="myTable">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tujuan</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php $no=1; krsort($pengiriman); foreach($pengiriman as $dist):
                $a = $dist['status'];
                switch($a){
                    case 0: $a = "<span class='btn pending'>Pending...</span>";break;
                    case 1: $a = "<span class='btn act-success'>Success</span>";break;
                    case 2: $a = "<span class='btn act-cancel'>Canceled</span>";break;
                    case 3: $a = "<span class='btn act bg-secondary'>Lead Up</span>";break;
                }
                    ?>
                <tr>
                    <td><?= $no?></td>
                    <td style="text-transform:capitalize"><?= $dist['alias']?></td>
                    <td><?= $dist['qty']?></td>
                    <td><?= $dist['satuan']?></td>
                    <td style="text-transform:capitalize"><?= $dist['tujuan']?></td>
                    <td><?= $dist['deskripsi']?></td>
                    <td><?= $a ?></td>
                    <td><?= $dist['date_created']?></td>
                    <td>
                    <?php if($accessibility == "admin"){ ?>
                        <span>
                            <?php $b = $dist['status'];
                                if($b == 0){
                                    echo "<a href='#' id='status-kirim'
                                            data-id='".$dist['id']."'
                                            class='btn bg-orange act'>Kirim</a>";
                                }
                                if($b == 3){
                                    echo "<a href='#' id='status-success'
                                            data-id='".$dist['id']."'
                                            class='btn btn-primary act'>Selesai</a>";
                                }
                                if($b == 1 or $b == 2){
                                    echo "<span class='gv-act'>Telah diberi tindakan</span>";
                                }

                            ?>
                        <span>
                            <?php $b = $dist['status'];
                                if($b == 0){
                                    echo "<a href='#' id='status-canceled' data-url='/batal/". $dist['id']."/".$dist['alias']."/".$dist['qty']."'
                                        data-qty='".$dist['qty']."'
                                        data-id='".$dist['id']."'
                                        data-alias='".$dist['alias']."'
                                        class='btn btn-danger act-cancel'>Batalkan</a>";
                                }
                                ?>
                        </span>
                        <?php }else{?>
                            <span>
                            <?php $b = $dist['status'];
                                if($b != 1 && $b != 2){
                                    echo "<span class='act-user-wait'>Menunggu Tindakan</span>";
                                }else{
                                    echo "<span class='act-user'>Telah Diberi Tindakan</span>";
                                }
                                ?>
                        </span>
                        <?php }?>
                    </td>
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