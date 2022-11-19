<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
    <?php if(session()->getFlashdata('error')){ ?>
        <div class="flasf-inv alert" style="margin-bottom:10px; color:#DC3545" id="usex" alert="alert()">    
            <?= session()->getFlashdata('error')?>
        </div>
    <?php } ?>
    <?php if($accessibility == "admin"){ ?>
    <bottom class="btn btn-primary" style="margin-bottom:10px;display:inline-grid ;" data-toggle="modal" data-target="#tambah-user">
        <i class="ion ion-plus" style="margin-right:5px"><span style="margin-left:5px">Tambah User</span></i>
    </bottom>
    <?php }?>
    <table class="table-bordered table-hover" id="myTable">
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>aksibilitas</th>
            <?php if($accessibility == "admin"){?>
                    <th>Action</th>
                    <?php }?>
        </thead>
        <tbody>
            <?php $no=1; foreach($user as $u):?>
            <tr>
                <td><?= $no?></td>
                <td style="text-transform:capitalize"><?= $u['name']?></td>
                <td style="text-transform:capitalize"><?= $u['accessibility']?></td>
                <?php if($accessibility == "admin"){?>
                        <td style="text-align:center">
                        <span>
                            <a href="#" style="color:#e61a1a" id="delete-user" data-id="<?= $u['id']?>">
                                <i class="ion-trash-a btn btn-danger" style="width:40px"></i>
                            </a>
                            <a data-toggle="modal" data-target="#edit-user" href="edit/user/<?= $u['id']?>" class="edit"
                                data-id="<?= $u['id']?>"
                                data-name="<?= $u['name']?>"
                                data-username="<?= $u['username']?>"
                                data-password="<?= $u['password']?>"
                                data-accessibility="<?= $u['accessibility']?>">
                                <i class="ion-edit btn btn-primary" style="width:40px"></i>
                            </a>
                        </span>
                        </td>
                        <?php }?>
                <?php $no++; endforeach?>
            </tr>
        </tbody>
    </table>
        <?= $this->include('dashboard/_partials/form/form') ?>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>