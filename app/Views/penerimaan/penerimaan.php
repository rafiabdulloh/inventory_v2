<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
        <bottom class="btn btn-primary" style="margin-bottom:10px;display:inline-grid ;" data-target="#penerimaan" data-toggle="modal">
            <i class="ion ion-plus" style="margin-right:5px"><span style="margin-left:5px">Tambah Penerimaan</span></i>
        </bottom>
        <table class="table-bordered table-hover" id="myTable" style="color:black">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Barang dari</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; krsort($penerimaan); foreach($penerimaan as $pen):
                $s = $pen['status'];
                    switch($s){
                        case 0: $s = "<span class='pending-st'>Pending...</span>";break;
                        case 1: $s = "<span class=' act-success'>Success</span>";break;
                        case 2: $s = "<span class=' danger act-cancel'>Canceled</span>";break;
                        // default: $s = "Kamu inputin data apa?";
                    };?>
                <tr>
                    <td><?= $no?></td>
                    <td style="text-transform:capitalize"><?= $pen['alias']?></td>
                    <td><?= $pen['qty']?></td>
                    <td><?= $pen['satuan']?></td>
                    <td><?= $pen['from']?></td>
                    <td>Rp.<?php 
                        $rp = $pen['harga'];
                        $number = number_format($rp , 2, ',', '.');
                        echo $number;
                        ?>
                    </td>
                    <td><?= $s?></td>
                    <td><?= $pen['date_created']?></td>
                    <td>
                        <?php if($accessibility == "admin" OR "superadmin"){ ?>
                        <span>
                            <?php $s = $pen['status'];
                            if($s !=1 && $s !=2){
                                echo "<a href='#' id='pen-success' class='btn btn-primary act' data-id='".$pen['id']."'>Accept</a>" ;
                                // echo "hai";
                            }else{
                                echo "<span class='gv-act'>Telah Diberi Tindakan</span>";
                            }
                            ?>
                        </span>
                        <span>
                            <?php $s = $pen['status'];
                            if($s !=1 && $s !=2){
                                echo "<a href='#' id='cancel-pen' data-id='".$pen['id']."' class='btn btn-danger act-cancel'>Cancel</a>" ;
                                // echo "hai";
                            }
                            ?>
                        </span>
                        <?php }else{?>
                                <span>
                                <?php $b = $pen['status'];
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