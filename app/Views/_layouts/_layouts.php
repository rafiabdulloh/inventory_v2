<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agrioduct</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/adminLTE/css/adminlte.min.css">
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=<?= base_url('css/style.css')?>>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= $this->include('_layouts/_partials/navbar') ?>
        <?= $this->include('_layouts/_partials/sidebar') ?>
        <div class="content-wrapper" style="padding-right:20px; padding-left:20px">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <?= $this->include('_layouts/_partials/footer') ?>
    <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <script src="<?= base_url('plugins/jquery/jquery.min.js')?>"></script>
    <script src="<?= base_url('plugins/jquery-ui/jquery-ui.min.js')?>"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="<?= base_url('/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('/plugins/chart.js/Chart.min.js')?>"></script>
    <script src="<?= base_url('/plugins/sparklines/sparkline.js')?>"></script>
    <script src="<?= base_url('/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
    <script src="<?= base_url('/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
    <script src="<?= base_url('/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
    <script src="<?= base_url('/plugins/moment/moment.min.js')?>"></script>
    <script src="<?= base_url('/plugins/daterangepicker/daterangepicker.js')?>"></script>
    <script src="<?= base_url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
    <script src="<?= base_url('/plugins/summernote/summernote-bs4.min.js')?>"></script>
    <script src="<?= base_url('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
    <script src="<?= base_url('/adminLTE/js/adminlte.js')?>"></script>
    <?= $this->renderSection('script') ?>
    <script src="<?= base_url('/adminLTE/js/demo.js')?>"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?= base_url('js/inventory.home.js')?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('js/font-icon.js')?>"></script>
</body>
</html>