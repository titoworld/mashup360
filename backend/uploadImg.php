<?
$idPOI=$_GET["POI"];
mkdir("../uploads/POILogos/".$idPOI,0777);
$targetFolder = '../uploads/POILogos/'.$idPOI."/";  ; // Relative to the root
if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = dirname(__FILE__) . '/' . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['file']['name']);

	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$IMGfound = glob($targetFolder."*.*");
		$IMGs = $IMGfound[0];
		$extension= substr(strrchr($IMGs,'.'),1);
		$destination=$targetFolder.$idPOI.".".$extension;
		rename($IMGs, $destination);
		echo '1';
		
	} else {
		echo 'Tipus de fitxer invàlid';
	}
}
?>