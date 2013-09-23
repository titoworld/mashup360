<!DOCTYPE html>
<!-- prova !-->
<? include("pages/header.php") ?>
<body>
<header class="widthPage"><img src="http://images.farrepuche.com/logo.png" id="logo" alt="logo"/>
	<nav>
	<ul id="topNavMenu">
		<li id="adminSection"><span class="topMenuOption">&nbsp;Administració&nbsp;&nbsp;|</span></li>
		<li id="suggestSite"><span class="topMenuOption">&nbsp;Suggerir lloc&nbsp;&nbsp;|</span></li>
		<li id="suggestError"><span class="topMenuOption">&nbsp;Informar sobre un error</span></li>
	</ul>
</nav>
<div id="socialButtons"><img class="littleButton" src="<? echo IMAGE_DOMAIN; ?>fb_logo.png" alt="logoFacebook" /><img class="littleButton" src="<? echo IMAGE_DOMAIN; ?>tw_logo.png" alt="logotwitter"/></div>
</header>
<div id="content">
	<div id="POIs">
		 <?  include("pages/POIs.php");  ?>  
	</div>
	 <div id="viewer360"></div>
	<div id="section">
		  <?  include("pages/googlemap.php");  ?>   
	</div>
</div>
</body>
</html>