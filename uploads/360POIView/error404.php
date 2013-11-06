
<? 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$gets= $_SERVER['REDIRECT_QUERY_STRING'];
$getvars= explode("=",$gets);
$POIname=$getvars[1];
//$POIname = isset($_GET['idpoi']) ? $_GET['idpoi'] : null ;
//$dir_path = str_replace( $_SERVER['DOCUMENT_ROOT'], "", dirname(realpath(__FILE__)) ) . DIRECTORY_SEPARATOR; 
$carpeta_final = $POIname."/";  
$HTMLs = glob($carpeta_final."*.html"); 
//rename($HTMLs[0],realpath(dirname(__FILE__)).'index.html');                   
rename($HTMLs[0], $carpeta_final ."index.html");
?>
<script>window.location.reload();</script>