<?php
/*
PekeUpload
Copyright (c) 2013 Pedro Molina
*/

// Define a destination

$targetFolder = '../uploads/360POIView/'; // Relative to the root


if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = dirname(__FILE__) . '/' . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];
	$fileTypes = array('zip'); // File extensions
	$fileParts = pathinfo($_FILES['file']['name']);
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$zip_manager = new Zip_manager();
		$archivo_zip = $targetFolder.$_FILES['file']['name']; 
		$explode_carpeta = explode(".zip", $archivo_zip);  
		$carpeta_final = $explode_carpeta[0];  
		$listado = $zip_manager->listar($archivo_zip); 
		//print_r($listado);
		$resultado = $zip_manager->extraer($archivo_zip, $carpeta_final); 
		if (!$resultado){
		echo "Error: no se ha podido extraer el archivo";
		}
		else{
			echo '1';
		}

		
	} else {
		echo 'Invalid file type.';
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