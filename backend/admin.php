<? session_start();
    include '../config.php';
    include 'POSTCLASS.php';
    date_default_timezone_set('Europe/Andorra');
    $post=new POST_PHP;
    $data=$post->posting('giveMyHash',array('usuari'=>$_GET['user']));
    $now=strtotime(date("Y-m-d H:i:s",time()));
    $expiration=strtotime($data->token->expire);
    if ($now > $expiration){
        echo '<META HTTP-EQUIV="Refresh" Content="1; URL=index.php">'; 
        die("Token has expire");
    }
	if($_SESSION['userHash']!=$data->token->hash)
		{
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=index.php">';
        die("Invalid Hash");
		}
	else if(!$_GET["section"]){
	$userHash=  $_SESSION['user_hash'];
	session_destroy();
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<script>window.usuari="<? echo $_GET['user']; ?>";</script>
  <?php 
    $section = "login";
    if(isset($_GET["section"])) {
        $section = $_GET["section"];
    }
    
    // HEADER
    
    switch($section) {
        case "login":
            echo "<link rel=\"stylesheet\" href=\"assets/css/login.css\" media=\"screen\">";
            include('index.php'); 
            break;
        case "POIS":
            include('inc/header.php');
            include("inc/".$_GET["section"].".php");
            include 'inc/POISBox.php';
            include 'inc/newPOI.php';
        break;
        default:
            include('inc/header.php');
            include("inc/".$_GET["section"].".php");
            break;
    }
        
    ?>   
  

<? include 'inc/footerScripts.php'; ?>

</body>

</html>
