<?
session_start();
if ($_POST['userHash']){
	echo "OK";
		$_SESSION['userHash'] = $_POST['userHash'];
}
else {
	 header( 'Location: index.php' ) ;
}

?>