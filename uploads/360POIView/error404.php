
<html>
	<head>
		<? include("../../pages/header.php") ?>
		<title>Error 404.</title>
	</head>
	<body>
		<? 
		    $POIname = isset($_GET['idpoi']) ? $_GET['idpoi'] : null ;
			//$dir_path = str_replace( $_SERVER['DOCUMENT_ROOT'], "", dirname(realpath(__FILE__)) ) . DIRECTORY_SEPARATOR; 
			$carpeta_final = $POIname."/";  
			$HTMLs = glob($carpeta_final."*.html");	
			rename($HTMLs[0], $carpeta_final ."index.html");
		?>
	<script>window.location.href = "index.html";</script>
	<div style="width:400px;margin:auto;"><img src="<? echo IMAGE_DOMAIN ?>404.jpg" alt="error" />
	<div id="textLink" style="text-align:center;"><span id="textIndex" ><a style="color:black;text-decoration: none" href="index.php">Tornar al Index</a></span></div></div>
	</body>
</html>