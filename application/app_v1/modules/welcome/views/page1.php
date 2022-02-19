
<!DOCTYPE html>
<html lang="en">
<?php $url=base_url()?>
<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?=$url?>\assets\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\css\style.css">
    <style type="text/css">

        .flex-container {
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: row;
      }

      .flex-container > div {

 /* width: 450px;
 height: 200px;*/
 margin: 10px;
 text-align: center;
 line-height: 75px;
 font-size: 30px;
}
.flex-container > div.mbl {
    background-color: white;
  width: 100%;
 height: 100px;
 margin: 10px;
 text-align: center;
 line-height: 75px;
 font-size: 30px;
}
.hexagon {
  position: relative;
  width: 300px; 
  height: 173.21px;
  background-color: #808080;
  margin: 86.60px 0;
  box-shadow: 0 0 20px rgba(0,0,0,0.6);
  border-left: solid 5px #c0c0c0;
  border-right: solid 5px #c0c0c0;
}

.hexagon:before,
.hexagon:after {
  content: "";
  position: absolute;
  z-index: 1;
  width: 212.13px;
  height: 212.13px;
  -webkit-transform: scaleY(0.5774) rotate(-45deg);
  -ms-transform: scaleY(0.5774) rotate(-45deg);
  transform: scaleY(0.5774) rotate(-45deg);
  background-color: inherit;
  left: 38.9340px;
  box-shadow: 0 0 20px rgba(0,0,0,0.6);
}

.hexagon:before {
  top: -106.0660px;
  border-top: solid 7.0711px #c0c0c0;
  border-right: solid 7.0711px #c0c0c0;
}

.hexagon:after {
  bottom: -106.0660px;
  border-bottom: solid 7.0711px #c0c0c0;
  border-left: solid 7.0711px #c0c0c0;
}

/*cover up extra shadows*/
.hexagon span {
  display: block;
  position: absolute;
  top:2.8867513459481287px;
  left: 0;
  width:290px;
  height:167.4316px;
  z-index: 2;
  background: inherit;
}
#mobile{
    display: none;
}
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
}

.img-fluid-role{
    height: 100px;
}
#desk{
    display: none;
}
#mobile{
    display: inline;
}
}
</style>

</head>
<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded load-height">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header auth-header" header-theme="theme1">
                <div class="navbar-wrapper">

                    <div class="navbar-logo" logo-theme="theme1">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="index-1.htm">
                            <img class="img-fluid" src="<?=$url?>\assets\assets\images\logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?=$url?>\assets\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><?=$this->session->userdata('user')?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="auth-normal-sign-in.htm">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Menu header end -->
        <section class="login-block with-header">


            <div class="container-fluid">

                <div class="flex-container" id="desk">
                     <?php foreach ($role as $rl) {?>    
                  <div>
                      <div class="hexagon" style="cursor: pointer;" onclick="getrole('<?=$rl->id_level?>');">
                        <span>
                            <img class="img-fluid img-radius" src="<?=base_url()?>assets/user.png" alt="round-img" style="margin: -27px;"><h4><?=$rl->level?></h4>
                        </span>
                    </div>
                </div>

                <?php }?>

                </div>
                <div class="flex-container" id="mobile">
                    <?php foreach ($role as $rl) {?>    
                    <div class="mbl" onclick="getrole('<?=$rl->id_level?>');" style="cursor: pointer;">
                       <?=$rl->level?>
                    </div>
                      <?php }?>
                    
                </div>

      </div>

  </section>
</div>


<div class="footer bg-inverse">
    <p class="text-center">Copyright &copy; 2017 FLAT UI ADMIN , All rights reserved.</p>
</div>

<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\popper.js\js\popper.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\bootstrap\js\bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?=$url?>\assets\bower_components\modernizr\js\modernizr.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\modernizr\js\css-scrollbars.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="<?=$url?>\assets\bower_components\i18next\js\i18next.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?=$url?>\assets\assets\js\script.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
  function getrole(id) {
     window.location.href='<?=base_url()?>welcome/role/'+id;
  }
</script>
</body>

</html>
