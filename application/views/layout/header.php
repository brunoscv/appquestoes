<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>Gestor | Clipdata</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <!-- link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css' -->
        <link href="<?php echo base_url(); ?>assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/raty/jquery.raty.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Theme Styles -->
        <link href="<?php echo base_url(); ?>assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
        </script>
        
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.rules.js"></script>

        
       <style type="text/css">
       .td-actions{text-align: right;}
       </style>
    </head>
    <body class="page-header-fixed compact-menu page-horizontal-bar">
        <div class="overlay"></div>
         <form class="search-form" action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner container">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="<?php echo base_url(); ?>" class="logo-text"><span>Atualização Eletrobras</span></a>
                    </div><!-- Logo Box -->
                    <div class="search-button">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <!--
                            <ul class="nav navbar-nav navbar-left">
                                <li>		
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                                </li>
                                <li>
                                    <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a>
                                </li>
                                <li>		
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                                </li>
                            </ul>
                            -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- 
                                <li>	
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                                </li>
                                
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right">4</span></a>
                                    <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                        <li><p class="drop-title">You have 4 new  messages !</p></li>
                                        <li class="dropdown-menu-list slimscroll messages">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar2.png" alt=""></div>
                                                        <p class="msg-name">Sandra Smith</p>
                                                        <p class="msg-text">Hey ! I'm working on your project</p>
                                                        <p class="msg-time">3 minutes ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar4.png" alt=""></div>
                                                        <p class="msg-name">Amily Lee</p>
                                                        <p class="msg-text">Hi David !</p>
                                                        <p class="msg-time">8 minutes ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar3.png" alt=""></div>
                                                        <p class="msg-name">Christopher Palmer</p>
                                                        <p class="msg-text">See you soon !</p>
                                                        <p class="msg-time">56 minutes ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar5.png" alt=""></div>
                                                        <p class="msg-name">Nick Doe</p>
                                                        <p class="msg-text">Nice to meet you</p>
                                                        <p class="msg-time">2 hours ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar2.png" alt=""></div>
                                                        <p class="msg-name">Sandra Smith</p>
                                                        <p class="msg-text">Hey ! I'm working on your project</p>
                                                        <p class="msg-time">5 hours ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar4.png" alt=""></div>
                                                        <p class="msg-name">Amily Lee</p>
                                                        <p class="msg-text">Hi David !</p>
                                                        <p class="msg-time">9 hours ago</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                                    </ul>
                                </li>
                            	-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?php echo $userdata['nome']; ?><i class="fa fa-angle-down"></i></span>
                                        <!-- -<img class="img-circle avatar" src="assets/images/avatar1.png" width="40" height="40" alt=""> -->
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <!-- <li role="presentation"><a href="javascript:;"><i class="fa fa-user"></i>Editar Perfil</a></li> -->
                                        <li role="presentation"><a href="<?php echo site_url("dashboard/alterarSenha");?>"><i class="fa fa-calendar"></i>Alterar Senha</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <!-- <li role="presentation"><a href="javascript:;"><i class="fa fa-lock"></i>Lock screen</a></li> -->
                                        <li role="presentation"><a href="<?php echo site_url("auth/logout"); ?>"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->
            <div class="page-sidebar sidebar horizontal-bar">
                <div class="page-sidebar-inner">
                    <?php echo recursiveMenuNav($menuOrdenado,'class="menu accordion-menu"');$menuOrdenado=FALSE; ?>
                </div><!-- Page Sidebar Inner -->
            </div><!-- Page Sidebar -->
            <div class="page-inner">