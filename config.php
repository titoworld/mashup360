<?
if ($_GET["MCSD"]=="false"){
	define("API_DOMAIN", "http://mashup.farrepuche.com/API/");
	define("BACKEND_DOMAIN", "http://mashup.farrepuche.com/backend/");
	define("MAIN_DOMAIN","http://mashup.farrepuche.com/");
	define("STYLE_DOMAIN","http://mashup.farrepuche.com/css/");
	define("SCRIPT_DOMAIN","http://mashup.farrepuche.com/script/");
	define("IMAGE_DOMAIN","http://mashup.farrepuche.com/img/");
	define("PLUGINS_DOMAIN","http://mashup.farrepuche.com/plugins/");
	define("UPLOADS_DOMAIN","http://mashup.farrepuche.com/uploads/");
}
else if ($_GET["MCSD"]!="false" && $_GET["MCSD"]!="local"){
	define("API_DOMAIN", "http://api-handler.farrepuche.com/API/");
	define("BACKEND_DOMAIN", "http://backend-admin.farrepuche.com/backend/");
	define("MAIN_DOMAIN","http://mashup.farrepuche.com/");
	define("STYLE_DOMAIN","http://css3.farrepuche.com/css/");
	define("SCRIPT_DOMAIN","http://javascript.farrepuche.com/script/");
	define("IMAGE_DOMAIN","http://img.farrepuche.com/img/");
	define("PLUGINS_DOMAIN","http://plugs.farrepuche.com/plugins/");
	define("UPLOADS_DOMAIN","http://upload.farrepuche.com/uploads/");
}
else if ($_GET["MCSD"]=="local"){
	define("API_DOMAIN", "http://localhost:8888/API/");
	define("BACKEND_DOMAIN", "http://localhost:8888/backend/");
	define("MAIN_DOMAIN","http://localhost:8888/");
	define("STYLE_DOMAIN","http://localhost:8888/css/");
	define("SCRIPT_DOMAIN","http://localhost:8888/script/");
	define("IMAGE_DOMAIN","http://localhost:8888/img/");
	define("PLUGINS_DOMAIN","http://localhost:8888/plugins/");
	define("UPLOADS_DOMAIN","http://localhost:8888/uploads/");
}

?>
<head>
<meta charset="utf-8">
<script>
	window.GOOGLE_API_KEY="AIzaSyAj6PY93aqNwpR9sxqlJUnjy7Xb6EZeP2Y";
	window.API_DOMAIN="<? echo API_DOMAIN; ?>";
	window.BACKEND_DOMAIN="<? echo BACKEND_DOMAIN ?>";
	window.MAIN_DOMAIN="<? echo MAIN_DOMAIN; ?>";
	window.STYLE_DOMAIN="<? echo STYLE_DOMAIN; ?>" ;
	window.SCRIPT_DOMAIN="<? echo SCRIPT_DOMAIN; ?>";
	window.IMAGE_DOMAIN="<? echo IMAGE_DOMAIN; ?>";
	window.PLUGINS_DOMAIN="<? echo PLUGINS_DOMAIN; ?>";
	window.UPLOADS_DOMAIN="<? echo UPLOADS_DOMAIN; ?>";
</script>