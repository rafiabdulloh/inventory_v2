<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
        <?php if($accessibility == "admin"){ ?>
        <bottom class="btn btn-primary" style="margin-bottom:10px;display:inline-grid ;" data-target="#tambah-lokasi" data-toggle="modal">
            <i class="ion ion-plus" style="margin-right:5px"><span style="margin-left:5px">Tambah Lokasi</span></i>
        </bottom>
        <?php }?>
        <div style="overflow:auto">
    <table class="table-bordered table-hover" id="myTable" style="color:black">
        <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <?php if($accessibility == "admin" OR $accessibility == "superadmin"){?>
                    <th>Action</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($lokasi as $loc):?>
                <tr style="text-transform:capitalize">
                    <td><?= $no?></td>
                    <td><?= $loc['nama']?></td>
                    <td><?= $loc['alamat']?></td>
                    <?php if($accessibility == "admin" OR $accessibility == "superadmin"){?>
                    <td style="text-align:center">
                    <span>
                        <a href="#" style="color:#e61a1a" id="delete-lokasi" data-id="<?= $loc['id']?>">
                            <i class="ion-trash-a btn btn-danger" style="width:40px"></i>
                        </a>
                        <a data-toggle="modal" data-target="#edit-lokasi" href="edit/lokasi/<?= $loc['id']?>" class="edit" data-url="edit/lokasi/<?= $loc['id']?>" data-id="<?= $loc['id']?>" data-nama="<?= $loc['nama']?>" data-alamat="<?= $loc['alamat']?>">
                            <i class="ion-edit btn btn-primary" style="width:40px"></i>
                        </a>
                    </span>
                    </td>
                    <?php }?>
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