<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap Stylesheet -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="all">

<!-- jquery-ui Stylesheets -->
<link rel="stylesheet" href="assets/jui/css/jquery-ui.css" media="screen">
<link rel="stylesheet" href="assets/jui/jquery-ui.custom.css" media="screen">
<link rel="stylesheet" href="assets/jui/timepicker/jquery-ui-timepicker.css" media="screen">

<!-- Uniform Stylesheet -->
<link rel="stylesheet" href="plugins/uniform/css/uniform.default.css" media="screen">

<!-- Plugin Stylsheets first to ease overrides -->

<!-- iButton -->
<link rel="stylesheet" href="plugins/ibutton/jquery.ibutton.css" media="screen">

<!-- Circular Stat -->
<link rel="stylesheet" href="custom-plugins/circular-stat/circular-stat.css">

<!-- Fullcalendar -->
<link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.css" media="screen">
<link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">

<!-- End Plugin Stylesheets -->

<!-- Main Layout Stylesheet -->
<link rel="stylesheet" href="assets/css/fonts/icomoon/style.css" media="screen">
<link rel="stylesheet" href="assets/css/main-style.css" media="screen">
<link rel="stylesheet" href="plugins/msgbox/jquery.msgbox.css" media="screen">
<link rel="stylesheet" href="assets/css/reveal.css">
<link rel="stylesheet" href="assets/css/bjqs.css">
<link rel="stylesheet" href="assets/css/colorPicker.css">
<link rel="stylesheet" href="assets/css/minicolors.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>GALF :: Administración Backend</title>
<script src="js/parse.js"></script>
</head>

<body data-show-sidebar-toggle-button="false" data-fixed-sidebar="false">
    <div id="wrapper">


                    <div id="sidebar-separator"></div>       



        <header id="header" class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
					<div class="brand-wrap pull-left">
						<div class="brand-img">
							<a class="brand" href="#">
								<img src="assets/images/logo.png" alt="" style="heigh: 40%;">
							</a>
						</div>
					</div>
                    <div id="header-right" class="clearfix">
						<div id="nav-toggle" data-toggle="collapse" data-target="#navigation" class="collapsed">
							<i class="icon-caret-down"></i>
						</div>
						<div id="header-search">
							<span id="search-toggle" data-toggle="dropdown">
								<i class="icon-search"></i>
							</span>
						</div>
                        <div id="header-functions" class="pull-right">
                            <div id="logout-ribbon">
                            	<a href="index.php"><i class="icon-off"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div id="content-wrap">
        	<div id="content" class="sidebar-minimized">
            	<div id="content-outer">
                	<div id="content-inner">
                    	<aside id="sidebar">
                        	<nav id="navigation" class="collapse">
                            	<ul>
                                	<li id="usuariosLi" class="active">
                                    	<span title="General">
                                            <a id="usuariosLink" href="admin.php?section=users">
                                    		<i class="icon-users"></i>
											<span class="nav-title">Usuarios</span></a>
                                        </span>
                                    	<ul class="inner-nav" id="usuarios">
                                        </ul>
                                    </li>
                                	<li id="camposLi">
                                    	<span title="Table">
                                            <a id="camposLink" href="admin.php?section=campos">
                                    		<i class="icon-globe"></i>
											<span class="nav-title">Campos</span></a>
                                        </span>
                                    	<ul class="inner-nav" id="campos">
                                        </ul>
                                    </li>
                                	
                                </ul>
                            </nav>
                        </aside>