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
	    	array_push($typelist,$userData);
    	}
    	return $typelist;
    }
      


    static function listArticlesWord($word) {
	   	$db = DbController::getInstance()->dbManager->articles;
	   //	$table = $db->articles;
	   	$user = $db->where("descripcio LIKE ?", "%".$word."%")->order("id_article + 0 ASC");
    	$typelist = array();
    	foreach ($user as $types) {
    		$userData['id']= $types['id'];
    		$userData['id_article']= $types['id_article'];
    		$userData['tipus']= $types['tipus'];
    		$userData['descripcio']= $types['descripcio'];
    		$userData['id_tipus_codi']= $types['id_tipus_codi'];
    		$userData['id_llibre']= $types['id_llibre'];
    		$userData['id_titol']= $types['id_titol'];
    		$userData['id_capitol']= $types['id_capitol'];
    		$userData['id_section']= $types['id_section'];
    		array_push($typelist,$userData);
    	}
    	
    	return $typelist;
    }
    
     static function newBook($book) {
     	$db = DbController::getInstance()->dbManager->llibres_codis();
    	$typelist = array();
    	foreach ($db as $types) {
    		if ($book['id_llibre']==$types['id_llibre'] && $book['id_tipus_codi']==$types['id_tipus_codi']){
    			$result['exist']="already_exist";
    			return $result;
    		}  		
    	}
     	$result = DbController::getInstance()->dbManager->llibres_codis->insert($book);
	    if(!$result)
	    	return NULL;
	    return $result;
     }
     //-----
      static function newTitle($title) {
     	$db = DbController::getInstance()->dbManager->titol_codis();
    	$typelist = array();
    	foreach ($db as $types) {
    		if ($title['id_llibre']==$types['id_llibre'] && $title['id_tipus_codi']==$types['id_tipus_codi'] &&  $title['id_titol']==$types['id_titol']){
    			$result['exist']="already_exist";
    			return $result;
    		}  		
    	}
     	$result = DbController::getInstance()->dbManager->titol_codis->insert($title);
	    if(!$result)
	    	return NULL;
	    return $result;
     }
     //------
       static function newCapitol($capitol) {
     	$db = DbController::getInstance()->dbManager->capitol_codis();
    	$typelist = array();
    	foreach ($db as $types) {
    		if ($capitol['id_llibre']==$types['id_llibre'] && $capitol['id_tipus_codi']==$types['id_tipus_codi'] &&  $capitol['id_titol']==$types['id_titol']&& $capitol['id_capitol']==$types['id_capitol']){
    			$result['exist']="already_exist";
    			return $result;
    		}  		
    	}
     	$result = DbController::getInstance()->dbManager->capitol_codis->insert($capitol);
	    if(!$result)
	    	return NULL;
	    return $result;
     }
     //--------
       static function newSection($section) {
        $db = DbController::getInstance()->dbManager->seccio_codis();
    	$typelist = array();
    	foreach ($db as $types) {
    		if ($section['id_llibre']==$types['id_llibre'] && $section['id_tipus_codi']==$types['id_tipus_codi'] &&  $section['id_titol']==$types['id_titol']&& $section['id_capitol']==$types['id_capitol']&&$section['id_seccio']==$types['id_seccio']){
    			$result['exist']="already_exist";
    			return $result;
    		}  		
    	}
     	$result = DbController::getInstance()->dbManager->seccio_codis->insert($section);
	    if(!$result)
	    	return NULL;
	    return $result;
     }
     //--------
       static function newArticle($article) {
       		 $db = DbController::getInstance()->dbManager->articles();
           	foreach ($db as $types) {
	    		if ( $article['id_tipus_codi']==$types['id_tipus_codi'] &&  $article['id_article']==$types['id_article']){
	    			$result['exist']="already_exist";
	    			return $result;
	    		}
	    	}  	
     	$result = DbController::getInstance()->dbManager->articles->insert($article);
	    if(!$result)
	    	return NULL;
	    return $result;
     }
     //------
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
     static function delCapitol($capitol,$titol,$llibre,$codi) {
     	$user = DbController::getInstance()->dbManager->capitol_codis("id_capitol = ? AND id_titol = ? AND id_llibre = ? AND id_tipus_codi= ?",$capitol, $titol,$llibre,$codi)->fetch();
     	$child_seccio= DbController::getInstance()->dbManager->seccio_codis("id_capitol = ? AND id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$capitol, $titol,$llibre,$codi)->fetch();
     	$child_articles= DbController::getInstance()->dbManager->articles("id_capitol = ?  AND id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$capitol, $titol,$llibre,$codi)->fetch();
     	if ($child_seccio||$child_articles) {
	     	$user['havechild']="have_child";
	     	return $user;
     	}     	
     	if(!$user)
	    	return NULL;
    	$user->delete(); 
    	return $user;	
     }  
        static function delSection($section,$capitol,$titol,$llibre,$codi) {
     	$user = DbController::getInstance()->dbManager->seccio_codis("id_seccio = ?",$section)->fetch();
     	$child_articles= DbController::getInstance()->dbManager->articles("id_section = ? AND id_capitol = ? AND id_titol = ? AND id_llibre = ? AND id_tipus_codi = ?",$section,$capitol,$titol,$llibre,$codi)->fetch();
     	if ($child_articles) {
	     	$user['havechild']="have_child";
	     	return $user;
     	}    
     	if(!$user)
	    	return NULL;
    	$user->delete();
    	return $user; 	
     }    
        static function delArticle($articleid) {
     	$user = DbController::getInstance()->dbManager->articles("id_article = ?",$articleid)->fetch();
     	if(!$user)
	    	return NULL;
    	$user->delete();
    	return $user; 	
     }  
}
?>