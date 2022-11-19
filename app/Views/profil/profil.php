<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>
<?= $this->include('dashboard/_partials/breadcrumb/breadcrumb') ?>

<section class="content">
    <div style="text-align: -webkit-center">
        <img src="<?= base_url('image/user.png')?>" style="margin-bottom:30px" width="200px" height="200px">
        <div class="card card-border col-6">
        <span style="text-align:start">Name:</span>
            <div>
            <span style="position:relative; top:5px"><span style="float:left"><?= $nameUser?></span></span>
                <i id="e-name" class="ion-edit btn btn-user" style="width:40px; float:right"></i>
                    <!-- </br> -->
                    <form action="/edit/name/<?= session()->get('id')?>" method="post" style="display:none" id="name-user">
                    <div class="form-group">
                        <input placeholder="Masukan Nama Baru" class="form-control" autocomplete="off" type="text" name="name" required style="text-transform:capitalize">
                    </div>
                    <div style="float:right; margin-bottom:5px">
                        <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-border col-6" style=" display:inline-table">
        <span style="float: left; margin: 8px;">Password</span>
        <i id="e-pass" class="ion-edit btn btn-user" style="width:40px; float:right"></i>
            <div>
                <form action="/edit/password/<?= session()->get('id')?>" method="post" style="display:none" id="pass-user">
                    <div class="input-group">
                    <input name="password" type="password" id="pw" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                      <span id="eye" onclick="change_icon()" class="mata input-group-text">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path fill-rule="evenodd"
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                      </span>
                    </div>
                </div>
                    <div style="float:right; margin-bottom:5px; margin-top:10px">
                        <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
	        </div>
            </div>
        </div>
    </div>
</section>
</section>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
$(document).ready(function(){
    $("#e-pass").click(function(){
     $("#pass-user").fadeToggle("slow");
    })
})
$(document).ready(function(){
  $("#e-name").click(function(){
    $("#name-user").fadeToggle("slow");
  })
})
</script>

<?= $this->include('dashboard/script') ?>

<?= $this->endSection() ?>