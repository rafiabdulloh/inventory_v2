<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>

<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
    <div class="container-fluid">
        <?= $this->include('dashboard/_partials/small-box/small-box') ?>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>