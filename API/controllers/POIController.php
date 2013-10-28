<?
class POIController{
  static function listPOI() {
	   	$db = DbController::getInstance()->dbManager->POIs->order("id + 0 ASC");
    	$typelist = array();
    	foreach ($db as $types) {
    		$userData['id']= $types['id'];
    		$userData['POI_id']= $types['POI_id'];
    		$userData['POI_name']= $types['POI_name'];
    		$userData['POI_description']= $types['POI_description'];
    		$userData['POI_telefon']= $types['POI_telefon'];
    		$userData['POI_email']= $types['POI_email'];
    		$userData['POI_postal']= $types['POI_postal'];
    		$userData['POI_ciutat']= $types['POI_ciutat'];
    		$userData['POI_codi_postal']= $types['POI_codi_postal'];
    		$userData['POI_web']= $types['POI_web'];
    		$userData['POI_latitude']= $types['POI_latitude'];
    		$userData['POI_longitude']= $types['POI_longitude'];
    		$userData['POI_360url']= $types['POI_360url'];
    		$userData['POI_360url2']= $types['POI_360url2'];
    		$userData['POI_mini_logo']= $types['POI_mini_logo'];
	    	array_push($typelist,$userData);
    	}
    	return $typelist;
    }
      


    
     static function addPOI($POI) {
     	$result = DbController::getInstance()->dbManager->POIs->insert($POI);
	    if(!$result)
	    	return NULL;
	    return $result;
     }
    
         
        static function updateArticle($tipusCodi,$article,$desc) {
        $user = DbController::getInstance()->dbManager->articles("id_article= ? AND id_tipus_codi= ?", $article, $tipusCodi)->fetch();
        if(!$user)
	    	return NULL;
	    $user["descripcio"]=$desc;
	    $user->update();
	    return $user;
     }
  static function delBook($bookid,$codi) {
     	$user = DbController::getInstance()->dbManager->llibres_codis("id_llibre = ? AND id_tipus_codi = ?",$bookid,$codi)->fetch();
     	$child_title = DbController::getInstance()->dbManager->titol_codis("id_llibre = ? AND id_tipus_codi = ?",$bookid,$codi)->fetch();
     	$child_capitol= DbController::getInstance()->dbManager->capitol_codis("id_llibre = ? AND id_tipus_codi = ?",$bookid,$codi)->fetch();
     	$child_seccio= DbController::getInstance()->dbManager->seccio_codis("id_llibre = ? AND id_tipus_codi = ?",$bookid,$codi)->fetch();
     	$child_articles= DbController::getInstance()->dbManager->articles("id_llibre = ? AND id_tipus_codi = ?",$bookid,$codi)->fetch();
     	if ($child_title||$child_capitol||$child_seccio||$child_articles) {
	     	$user['havechild']="have_child";
	     	return $user;
     	}
     	if(!$user)
	    	return NULL;
    	$user->delete(); 	
    	return $user;
     }      
     static function delTitle($title,$llibre,$codi) {
     	$user = DbController::getInstance()->dbManager->titol_codis("id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$title,$llibre,$codi)->fetch();
     	$child_capitol= DbController::getInstance()->dbManager->capitol_codis("id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$title,$llibre,$codi)->fetch();
     	$child_seccio= DbController::getInstance()->dbManager->seccio_codis("id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$title,$llibre,$codi)->fetch();
     	$child_articles= DbController::getInstance()->dbManager->articles("id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$title,$llibre,$codi)->fetch();
     	if ($child_capitol||$child_seccio||$child_articles) {
	     	$user['havechild']="have_child";
	     	return $user;
     	}

     	if(!$user)
	    	return NULL;
    	$user->delete(); 	
    	return $user;
     }     

  
}
?>