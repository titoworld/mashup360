<? 
$hash = $_SESSION['userHash'];
include("../config.php");
 ?>
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

<!-- iButton -->
<link rel="stylesheet" href="plugins/ibutton/jquery.ibutton.css" media="screen">
<!-- End Plugin Stylesheets -->

<!-- Main Layout Stylesheet -->
<link rel="stylesheet" href="assets/css/fonts/icomoon/style.css" media="screen">
<link rel="stylesheet" href="assets/css/main-style.css" media="screen">
<link rel="stylesheet" href="plugins/msgbox/jquery.msgbox.css" media="screen">
<link rel="stylesheet" href="assets/css/reveal.css">
<link rel="stylesheet" href="assets/css/bjqs.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Mashup360 :: Administración Backend</title>

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
                                
                                	<li id="camposLi" class="active">
                                    	<span title="Table">
                                            <a id="camposLink" href="">
                                    		<i class="icon-globe"></i>
											<span class="nav-title">POIs</span></a>
                                        </span>
                                    	<ul class="inner-nav" id="campos">
                                        </ul>
                                    </li>
                                		<li id="usuariosLi">
                                    	<span title="General">
                                            <a id="usuariosLink" href="">
                                    		<i class="icon-users"></i>
											<span class="nav-title">Usuaris</span></a>
                                        </span>
                                    	<ul class="inner-nav" id="usuarios">
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </aside>