<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
    <div class="container box col-12" style="margin-bottom:0px; padding-top:15px">
        Hubungi Admin jika ada masalah dalam aplikasi.</br><hr>
        <div style="padding-bottom:15px; padding-left:5px; padding-right:5px; text-align-last: justify; width: 300px;display:table-cell">
            <a href="https://wa.me/0895360803078" target="blank">
                <img src="<?= base_url('image/whatsapp-icon.png')?>" width="50px" height="50px">
            </a>
            <a href="https://www.facebook.com/moch.rafi.967" target="blank">
                <img src="<?= base_url('image/facebook-icon.png')?>" width="50px" height="50px">
            </a>
            <a href="https://www.instagram.com/rafi_abdul02" target="blank">
                <img src="<?= base_url('image/instagram-icon.png')?>" width="50px" height="50px">
            </a>
            <a href="mailto: rafiabdulloh123@gmail.com?subject = Feedback&body" target="blank">
                <img src="<?= base_url('image/email-icon.png')?>" width="50px" height="50px">
            </a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>