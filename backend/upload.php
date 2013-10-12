<?php

// Define a destination
$idPOI=$_GET["POI"];
//mkdir("../uploads/360POIView/".$idPOI,0777);
$targetFolder = '../uploads/test/'; // Relative to the root


if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = dirname(__FILE__) . '/' . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];
	$fileTypes = array('zip'); // File extensions
	$fileParts = pathinfo($_FILES['file']['name']);
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$zip_manager = new Zip_manager();
		$fitxer_zip = $targetFolder.$_FILES['file']['name']; 
		$explode_carpeta = explode(".zip", $fitxer_zip);  
		$carpeta_final = $targetFolder.$idPOI."/";  
		$listado = $zip_manager->listar($fitxer_zip); 
		//print_r($listado);
		$resultado = $zip_manager->extraer($fitxer_zip, $carpeta_final); 
		if (!$resultado){
		echo "Error: no s'ha pogut extreure el fitxer";
		}
		else{
			echo '1';
			$HTMLs = glob($carpeta_final."*.html");
			rename($HTMLs[0], $carpeta_final . "index.html");
			unlink($fitxer_zip);
		}

		
	} else {
		echo "Tipus d'arxiu invàlid.";
	}
}

class Zip_manager{
	function listar($var){
		$entries = array();
		$zip = zip_open($var);
		if (!is_resource($zip)){
			die ("No s'ha pogut llegir el fitxer.");
			}
		else{
			while ($entry = zip_read($zip)){
				$entries[] = zip_entry_name($entry);
			}
		}
	zip_close($zip);
	return $entries;
	}

	function extraer($var, $destino){
		$zip = new ZipArchive;
		if ($zip->open($var) === TRUE) {
			$zip->extractTo($destino);
			$zip->close();
			return true;
		} else {
			return false;
		}
	}
}


?>