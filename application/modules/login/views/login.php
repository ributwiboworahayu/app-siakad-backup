<!doctype html>
<?php $url=base_url() ?>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>LOGIN FORM POLTEK-KAMPAR</title>
    <link rel="shortcut icon" href="<?=$url?>\assets\favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=$url?>\assets\favicon.ico" type="image/x-icon">
    <link href='<?=$url?>assets/login/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="<?=$url?>assets/login/css/style.css">
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <!-- <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script> -->
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body >
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0 m-card0">
            <div class="row d-flex">
                <div class="col-lg-6" id="box-logo">
                    <div class="card1 pb-5">
                        <div class="row"> <img src="<?=$url?>assets/login/img/logo.png" class="logo"> </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="<?=$url?>assets/login/img/visi.png" class="image"> </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h1 class="text-title">POLITEKNIK KAMPAR</h1>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div> <small class="or text-center"></small>
                            <div class="line"></div>
                        </div>
                        <?= form_open(base_url().'login/auth_chek', array('class' =>"frm-login")); ?>
                        <div class="row px-3" style="margin-bottom: 25px;"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email Address</h6>
                            </label> 
                            <input class="" type="email" name="email" placeholder="Enter a valid email address">
                            <small class="error-1" style="color: red"></small> 
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                            </label> 
                            <input type="password" name="password" class="error-password" placeholder="Enter password"> 
                            <small class="error-2" style="color: red"></small> 
                        </div>
                        <!-- <div class="row">
                           <div class="col-sm-6"> 
                               <input type="text" name="kode_captcha" value="" placeholder="Enter Captcha">
                               <small class="error-3" style="color: red"></small> 
                           </div>
                           <div class="col-sm-6"> 
                               <?=$cap_img?>
                           </div>
                        </div> -->
                       
                        <div class="row mb-3 px-3"> 
                            <button  class="btn btn-blue text-center go" id="log"> Login</button> 
                        </div>
                         <?= form_close(); ?>
                        <!-- <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger ">Register</a></small> </div> -->
                        <div class="alert alert-info" style="text-align: center;display: none;" id="msg-alert">
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4" style="background-color: #228B22;">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src="<?=$url?>assets/login/js/notif.js"></script>
    <script>
        $(document).ready(function() {
          $('#log').html('<i class="fa fa-sign-in" id="icon-oi"></i> Login');
            ajaxcsrf();
           $('.go').on('click', function(event) {
               event.preventDefault();
               const form=$('.frm-login').serialize();
              
               $('#log').html('<i class="fa fa-spinner fa-spin" id="icon-oi"></i> Checking..');
               $('#log').attr('disabled', 'disabled');
               $.ajax({
                   url: '<?=base_url()?>login/auth_chek',
                   type: 'POST',
                   dataType: 'JSON',
                   data: form,
                    success : function(res) {
                       if (res.response ==403) {
                        $('.error-1').text(res.email);
                        $('.error-2').text(res.password);
                        $('.error-3').text(res.captcha);
                        $('#log').html('<i class="fa fa-sign-in" id="icon-oi"></i> Login');
                        $('#log').attr('disabled', false);
                       }else if(res.response == 404){
                        // login_false(res.pesan);
                        $('#msg-alert').removeClass('alert-info').addClass('alert-danger').html('<label >Login Gagal Cek Akun Anda</label>');
                        $('#msg-alert').css('display', 'block');
                        $('#log').html('<i class="fa fa-sign-in" id="icon-oi"></i> Login');
                        $('#log').attr('disabled', false);
                        setInterval(function(){ $('#msg-alert').hide(); }, 5000);
                       }else if (res.response==200) {
                        // login_true(res.pesan);
                        $('#msg-alert').removeClass('alert-info').addClass('alert-success').html('<label >Login berhasil Please Wait Sedang redirect</label>');
                        $('#msg-alert').css('display', 'block');
                        $('#log').html('<i class="fa fa-external-link" id="icon-oi"></i> Redirect..');
                        setInterval(function(){ window.location.href = "welcome/role"; }, 3000);
                       }else{
                        alert('server error');
                       }
                   }
               })
               
               
           });
        });
         function ajaxcsrf() {
          var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
          var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
          var csrf = {};
          csrf[csrfname] = csrfhash;
          $.ajaxSetup({
            "data": csrf
          });
        }
    </script>
</body>
</html>