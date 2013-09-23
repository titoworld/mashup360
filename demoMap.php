<!doctype html>
<head>
<meta http-equiv=X-UA-Compatible content=IE=EmulateIE7 />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<link rel="shortcut icon" href="favicon.ico">

<title>makeMarker() & sidebar</title>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<style>


#map{width:512px; height:512px; margin:10px;}
#sidebar{float:left; margin:10px;}

.sb_blue button {text-align: left; 
  cursor:pointer;
  background-color: #99b3cc; 
  font-family: Verdana; 
  margin: 1px;}
.sb_blue button:focus {background-color: #eee;}
.sb_blue button:hover {background-color: #fff;}


</style>
<? include("pages/header.php") ?>

</head>

<body>
<div id="sidebar" class="sb_blue"></div>
<div id="map"></div>
<script src='<? echo SCRIPT_DOMAIN ?>demoMap.js'></script>


