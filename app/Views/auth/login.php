<?= $this->extend('auth/auth/_layout') ?>
<?= $this->section('content') ?>

<div class="hold-transition login-page bg-warning"">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <div>
          <!-- <img src="<?= base_url('image/login.jpg')?>" alt="icon-login" width="250px" height="250px"> -->
        </div>
        <div class="h1"><b>Agrioduct</b></div>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="/login/user" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" autofocus="true" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-alt"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" id="pw" placeholder="Password" required autocomplete="off">
            <div class="input-group-append">
              <!-- <div class="input-group-text"> -->
                <!-- <span class="fas fa-lock"></span> -->
                <span onclick="change()" class="input-group-text" id="eye">
                   <!-- eye icon bootstrap  -->
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                          <path fill-rule="evenodd"
                          d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                      </svg>
                  </span>
              <!-- </div> -->
            </div>
          </div>
            <div class="flash-prnt">
                <?php if(session()->getFlashdata('error')){ ?>
                    <div class="flasf-inv" style="margin-bottom:10px; color:#DC3545">    
                        <?= session()->getFlashdata('error')?>
                    </div>
                <?php } ?>
            </div>
          <div class="row">
            <!-- <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div> -->
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
        <!-- /.social-auth-links -->
          </hr>
        <!-- <p class="mb-1">
          <a href="/forgot-password">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="/register" class="text-center">Register a new membership</a>
        </p> -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<?php if (session()->getFlashdata('msg')) : ?>
  <?= session()->getFlashdata('msg') ?>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(function() {
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
    toastr.options.onclick = null;
    var error = $('.errors').html();
    if (error) {
      toastr.error(error)
      $('.errors').hide();
      $('a.resend').click(function() {

      })
    }
    var success = $('.success').html();
    if (success) {
      toastr.success(success);
      $('.success').hide();
    }
  });
  
  function change() {
    
    // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
    var x = document.getElementById('pw').type;
  
    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
    if (x == 'password') {
  
        //ubah form input password menjadi text
        document.getElementById('pw').type = 'text';
        
        //ubah icon mata terbuka menjadi tertutup
        document.getElementById('eye').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
    }
    else {
  
        //ubah form input password menjadi text
        document.getElementById('pw').type = 'password';
  
        //ubah icon mata terbuka menjadi tertutup
        document.getElementById('eye').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
    }
  };
</script>
<?= $this->endSection() ?>