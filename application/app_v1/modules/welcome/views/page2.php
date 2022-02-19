<!DOCTYPE html>
<html lang="en">
<?php $url=base_url()?>
<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="#">
  <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
  <meta name="author" content="#">
  <!-- Favicon icon -->
  <link rel="icon" href="<?=$url?>\assets\assets\images\favicon.ico" type="image/x-icon">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
  <!-- Required Fremwork -->
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\bower_components\bootstrap\css\bootstrap.min.css">
  <!-- themify-icons line icon -->
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\icon\themify-icons\themify-icons.css">
  <!-- ico font -->
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\icon\icofont\css\icofont.css">
  <!-- feather Awesome -->
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\icon\feather\css\feather.css">
  <!-- Syntax highlighter Prism css -->
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\pages\prism\prism.css">
  <!-- Style.css -->
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\css\style.css">
  <link rel="stylesheet" href="<?=$url?>\assets\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\css\jquery.mCustomScrollbar.css">
  <link rel="stylesheet" type="text/css" href="<?=$url?>\assets\assets\css\pcoded-horizontal.min.css">
  <script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery\js\jquery.min.js"></script>
</head>
<!-- Menu horizontal icon fixed -->

<body class="horizontal-icon-fixed">
    <!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="preloader3 loader-block">
                <div class="circ1 loader-info"></div>
                <div class="circ2 loader-success"></div>
                <div class="circ3 loader-danger"></div>
                <div class="circ4 loader-warning"></div>
            </div>
            
        </div>
    </div>
</div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">

        <div class="pcoded-container">
            <!-- Menu header start -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
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
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        <span class="badge bg-c-pink">5</span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="<?=$url?>\assets\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">John Doe</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="<?=$url?>\assets\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Joseph William</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="<?=$url?>\assets\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Sara Soudein</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?=$url?>\assets\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><?= $this->session->userdata('user'); ?></span>
                                        (<small><?= $this->session->userdata('role_st'); ?></small>)
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <?php
                                        $email=$this->session->userdata('email');
                                        $cek_role=$this->db->get_where('user_trakses', array('email' =>$email )); ?>
                                        <?php if ($cek_role->num_rows()==1){ ?>

                                        <?php }else{ ?>
                                         <li>
                                            <a href="<?=base_url()?>welcome/tukar_role">
                                                <i class="feather icon-lock"></i> Ganti Role
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <li>
                                        <a href="<?=base_url()?>login/logout">
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
        <!-- Menu header end -->
        <div class="pcoded-main-container">
            <nav class="pcoded-navbar">
                <div class="pcoded-inner-navbar">
                    <ul class="pcoded-item pcoded-left-item">

                     <?=menu_a($this->session->userdata('id_jabatan'))?>
                 </ul>
             </div>
         </nav>
         <!-- Sidebar chat start -->
         <div id="sidebar" class="users p-chat-user showChat">
            <div class="had-container">
                <div class="card card_main p-fixed users-main">
                    <div class="user-box">
                        <div class="chat-inner-header">
                            <div class="back_chatBox">
                                <div class="right-icon-control">
                                    <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                    <div class="form-icon">
                                        <i class="icofont icofont-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-friend-list">
                            <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius img-radius" src="<?=$url?>\assets\assets\images\avatar-3.jpg" alt="Generic placeholder image ">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Josephin Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="<?=$url?>\assets\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Lary Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="<?=$url?>\assets\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alice</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="<?=$url?>\assets\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alia</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="<?=$url?>\assets\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Suzen</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar inner chat start-->
        <div class="showChat_inner">
            <div class="media chat-inner-header">
                <a class="back_chatBox">
                    <i class="feather icon-chevron-left"></i> Josephin Doe
                </a>
            </div>
            <div class="media chat-messages">
                <a class="media-left photo-table" href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="<?=$url?>\assets\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                </a>
                <div class="media-body chat-menu-content">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
            </div>
            <div class="media chat-messages">
                <div class="media-body chat-menu-reply">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
                <div class="media-right photo-table">
                    <a href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="<?=$url?>\assets\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                    </a>
                </div>
            </div>
            <div class="chat-reply-box p-b-20">
                <div class="right-icon-control">
                    <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                    <div class="form-icon">
                        <i class="feather icon-navigation"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar inner chat end-->
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- Main-body start -->
                    <div class="main-body">
                        <div class="page-wrapper">


                            <!-- Page body start -->
                            <div class="page-body">

                                <div class="row">
                                  <div class="col-xl-6 col-md-12">
                                    <div class="card user-card-full">
                                        <div class="row m-l-0 m-r-0">
                                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                                <div class="card-block text-center text-white">
                                                    <div class="m-b-25">
                                                        <img src="<?=$url?>\assets\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                                    </div>
                                                    <h6 class="f-w-600"><?= $this->session->userdata('user'); ?></h6>
                                                    <p><?= $this->session->userdata('role_st'); ?></p>
                                                    <i class="feather icon-edit m-t-10 f-16"></i>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                             <div class="card-block">
                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Akun Information </h6>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="m-b-10 f-w-600">Nama User</p>
                                                        <h6 class="text-muted f-w-400"><?= $this->session->userdata('user'); ?> </h6>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="m-b-10 f-w-600">E-mail</p>
                                                        <h6 class="text-muted f-w-400"><?= $this->session->userdata('email'); ?></h6>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="m-b-10 f-w-600">Role</p>
                                                        <h6 class="text-muted f-w-400"><?= $this->session->userdata('role_st'); ?></h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <div class="card table-card">
                                    <div class="card-header bg-warning" style="padding: 10px 20px">
                                     <i class="ti-announcement f-50"></i>&emsp; <label class="f-40" >Informasi</label>

                                 </div>
                                 <div class="card-block">
                                    <h6 class="text-muted m-t-20">&emsp;Jika ada kendala pada penggunaan sistem silahkan hubungi admin atau team ICT</h6>
                                    <h6 class="text-muted m-t-20">
                                        &emsp;Mahdiawan Nurkholifah<br>
                                        &emsp;<strong>No HP : 082283517567</strong>
                                        <br>
                                        <br>
                                        &emsp;Aldi <br>
                                        &emsp;<strong>No HP : -------</strong>
                                    </h6>
                                    <h6 class="text-muted m-t-20">
                                        &emsp; Atau Bisa datang langsung ke bagian ICT POLTEK-KAMPAR
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->session->userdata('id_jabatan')=='8'): ?>
                     <?= $this->load->view($page); ?>
                <?php endif ?>

            </div>
            <!-- Page body end -->
        </div>
    </div>
    <!-- Main-body end -->


</div>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\popper.js\js\popper.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\bootstrap\js\bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?=$url?>\assets\bower_components\modernizr\js\modernizr.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\modernizr\js\css-scrollbars.js"></script>

<!-- Syntax highlighter prism js -->
<script type="text/javascript" src="<?=$url?>\assets\assets\pages\prism\custom-prism.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="<?=$url?>\assets\bower_components\i18next\js\i18next.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="<?=$url?>\assets\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>

<script src="<?=$url?>\assets\assets\js\pcoded.min.js"></script>
<script src="<?=$url?>\assets\assets\js\menu\menu-hori-fixed.js"></script>
<script src="<?=$url?>\assets\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?=$url?>\assets\assets\js\script.js"></script>
<!-- <script type="text/javascript" src="<?=$url?>\assets\js-apps\js-desktop-notif.js"></script> -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
