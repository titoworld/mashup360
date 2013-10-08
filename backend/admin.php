<? session_start();
	if(!$_SESSION['userHash'])
		{
		header("Location: index.php");
		}
	else if(!$_GET["section"]){
	$userHash=  $_SESSION['login_hash'];
	session_destroy();
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

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
