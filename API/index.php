<?
//error_reporting(E_ALL);
//ini_set('display_errors','1');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
require 'Slim/Slim.php';
require 'NotORM/NotORM.php';
require_once "config.php";
require_once "controllers/DbController.php";
require_once "controllers/UserController.php";
require_once "controllers/POIController.php";
//connexió amb la base de dades
$pdo = new PDO('mysql:host=mysql.farrepuche.com;port=3306;dbname=mashup360', 'tfc_mashup', 'mashup360', array( PDO::ATTR_PERSISTENT => false));
$db = new NotORM($pdo);
$db->debug = function($q, $p) {
        error_log($q);
    };

\Slim::registerAutoloader();
$app = new \Slim();


$app->get('/login/:tip/:pass', function($tip, $pass) use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	
    $user = UserController::checkLogin($pass, $tip);
    
    if($user) {
    	$responseData["TIP"]=$user["TIP"];
    	$responseData["token"]=$user["token"];
	    echo wsResponse("user", $responseData);
    } else {
	    echo wsError(_("Entrada incorrecta"));
    }    

});

//Login [ usuari, TIP i PASSWORD(sha512) ]
$app->post("/login", function() use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    
    //$pass = hash('sha512',$post["loginpass"]);
    
    $fieldCheck = array("loginpass", "TIP");
    
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    
    $user = NULL;
    
    if(isset($post["appToken"]) && isset($post["appPlatform"]) ) {
	    $user = UserController::checkLoginApp($post["loginpass"], $post ["TIP"], $post["appPlatform"], $post["appToken"]);
    } else {
	    $user = UserController::checkLogin($post["loginpass"], $post ["TIP"]);
    }
    
    if($user) {
    	$responseData["TIP"]=$user["TIP"];
    	$responseData["token"]=$user["token"];
	    echo wsResponse("user", $responseData);
    } else {
	    echo wsError(_("Usuari incorrecte o en ús en una altra aplicació"));
    }    
});

//Registre [ usuari, TIP i PASSWORD ]
$app->post("/user/:platform/:appToken", function ($platform, $appToken) use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    createUser($post, $platform, $appToken);
});

//Registre [ usuari, TIP i PASSWORD ]
$app->post("/user", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    createUser($post);
});

function createUser($post, $platform = NULL, $appToken = NULL) {
	$fieldCheck = array("registerpass", "TIP","mail","dni");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    if(!UserController::checkUser($post["TIP"])) {
    
    	$legit = UserController::checkLegitUser($post["TIP"], $post["dni"]);
    	if($legit != "OK") {
	    	echo wsError(_($legit));
	    	return;
    	}
    	 $user["password"]=hash('sha512',$post["registerpass"]);
    	 $user["email"]=$post["mail"];
    	 $user["TIP"]=$post["TIP"];
    	 
    	 if($platform != NULL)
    	 	$user["appPlatform"]=$platform;
    	 if($appToken != NULL)
    	 	$user["appToken"]=$appToken;
    	 
    	 $result = UserController::addUser($user);
    	 if(!$result) {
	    	 echo wsError(_("Error creating user"));
	    	 return;
    	 }
    	 $responseData["TIP"]=$result["TIP"];
    	 $responseData["token"]=$result["token"]; 
    	 echo wsResponse("user", $responseData);
    } else {
	   echo wsError(_('User exists'));
    }
}


//Enviar formulari x mail
$app->post("/contacta", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("username", "TIP", "Telefon","Missatge");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
	}
	$emaildelusuarioqueloenvia="notificacioAPP@sap-ugt.cat";
	$mailList = array("joanamimbrera@gmail.com", "s.martinez@sap-ugt.cat","j.colmenero@sap-ugt.cat", "j.guardiola@sap-ugt.cat");
	foreach($mailList as $mail) {
		if(!mail($mail, 'Formulari SAP-UGT(APP)', "Nom: " . $post['username']."\nTIP: ".$post['TIP']."\nTelèfon: "
		.$post['Telefon']."\nMissatge: ".$post['Missatge'],"FROM: ".$emaildelusuarioqueloenvia."\r\n". 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8')) {
			$allSended=0;
			break;
		}
		else {
			$allSended=1;
		}	
	}
	if ($allSended==0){
		echo wsResponse("send", "ko");
	}
	else {
		echo wsResponse("send", "ok");
	}


});
//Llistar usuaris (ID)
$app->get("/llistar_usuaris", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
	$result = UserController::llistarUsuaris();
	 if(!$result) {
	    	 echo wsError(_("Error listing users"));
	    	 return;
    	 }
    foreach($result as $llista) {
    $responseData[] = $llista;
    }
     echo wsResponse("userList", $responseData);

});
//buscar usuari per username
$app->post("/search_user", function() use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
    $user = $db->sap_users("username = ?", $post["username"])->fetch();
    if(!$user)
    	echo wsResponse("username", NULL);
    else {
    	echo wsResponse("username", $user["username"],"isAdmin", $user["isAdmin"]);
    }
});
//buscar usuari per TIP
$app->post("/search_TIP", function() use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
    $user = $db->sap_users("TIP = ?", $post["TIP"])->fetch();
    if(!$user)
    	echo wsResponse("TIP", NULL);
    else {
    	echo wsResponse("TIP", $user["TIP"]);
    }
});
//Borrar usuaris [ usuari, TIP]
$app->post("/del_users", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("TIP");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    if(!UserController::delUser($post["TIP"])) {
	    	 echo wsError(_("Error deleting user"));
	    	 return;
    	 }
});
//Modificar usuaris [ usuari, passw,TIP, enabled, isAdmin]
$app->post("/update_user", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $result = UserController::modUser($post["TIP"],$post["isEnabled"],$post["isAdmin"]);
    if(!$result) {
	    	 echo wsError(_("Error modifying users"));
	    	 return;
     }
});
//llistar POIS 
$app->get("/llista_POIs", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
	$result = POIController::listPOI();
	 if(!$result) {
	    	 echo wsError(_("Error llistant els POI"));
	    	 return;
    	 }
    foreach($result as $llista) {
    $responseData[] = $llista;
    }
     echo wsResponse("llistaPOI", $responseData);
});


//get POI PANORAMIC IMAGE URL
$app->get('/cerca_POI_URL/:POI', function($POI) use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $result = $db->POIs("POI_id = ?", $POI)->fetch();
    if(!$result)
    	echo wsResponse("POI_URL", NULL);
    else {
    	echo wsResponse("POI_URL",  utf8_encode($result["POI_360url"]));
    }
});

$app->post("/search_TIP", function() use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
    $user = $db->sap_users("TIP = ?", $post["TIP"])->fetch();
    if(!$user)
    	echo wsResponse("TIP", NULL);
    else {
    	echo wsResponse("TIP", $user["TIP"]);
    }
});



//buscar article per paraula
$app->post("/search_word", function() use ($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
	$result= PenalController::listArticlesWord($post["paraula"]);
    if(!$result)
    	echo wsResponse("articles", NULL);
    else {
    	echo wsResponse("articles",  $result);
    }
});
//afegir llibre/disposició
	$app->post("/add_book", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("book", "id_tipus", "id_book");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    	 $user["descripcio"]=$post["book"];
    	 $user["id_llibre"]=$post["id_book"];
    	 $user["id_tipus_codi"]=$post["id_tipus"];
    	 $result = PenalController::newBook($user);
    	 if(!$result) {
	    	 echo wsError(_("Error creating book"));
	    	 return;
    	 }
    	 if (!$result["id_llibre"]) {
    		 $responseData["id"]=$result["exist"];
    		  echo wsResponse("id", $responseData);
    		  return;
    	 }
    	 $responseData["id"]=$result["id_llibre"];
    	 echo wsResponse("id", $responseData);
    

});
//afegir titol
$app->post("/add_title", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("title","id_tipus","id_llibre","id_title");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    	 $user["descripcio"]=$post["title"];
    	 $user["id_titol"]=$post["id_title"];
    	 $user["id_tipus_codi"]=$post["id_tipus"];
    	 $user["id_llibre"]=$post["id_llibre"];
    	 $result = PenalController::newTitle($user);
    	 if(!$result) {
	    	 echo wsError(_("Error creating title"));
	    	 return;
    	 }
    	 if (!$result["id_titol"]) {
    		 $responseData["id"]=$result["exist"];
    		  echo wsResponse("id", $responseData);
    		  return;
    	 }
    	 $responseData["id"]=$result["id_titol"];
    	 echo wsResponse("id", $responseData);

});
//afegir capitol
$app->post("/add_capitol", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("capitol","id_tipus","id_llibre","id_titol");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    if(!PenalController::newBook($post["capitol"])) {
    	 $user["descripcio"]=$post["capitol"];
    	 $user["id_capitol"]=$post["id_capitol"];
    	 $user["id_tipus_codi"]=$post["id_tipus"];
    	 $user["id_llibre"]=$post["id_llibre"];
    	 $user["id_titol"]=$post["id_titol"];
    	 $result = PenalController::newCapitol($user);
    	 if(!$result) {
	    	 echo wsError(_("Error creating capitol"));
	    	 return;
    	 }
    	 if (!$result["id_capitol"]) {
    		 $responseData["id"]=$result["exist"];
    		  echo wsResponse("id", $responseData);
    		  return;
    	 }
    	 $responseData["id"]=$result["id_capitol"];
    	 echo wsResponse("id", $responseData);
    } else {
	   echo wsError(_('capitol exists'));
    }

});
//afegir seccio
$app->post("/add_section", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("section","id_tipus","id_llibre","id_titol","id_capitol","id_section");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    if(!PenalController::newBook($post["section"])) {
    	 $user["descripcio"]=$post["section"];
    	 $user["id_tipus_codi"]=$post["id_tipus"];
    	 $user["id_seccio"]=$post["id_section"];
    	 $user["id_llibre"]=$post["id_llibre"];
    	 $user["id_titol"]=$post["id_titol"];
    	  $user["id_capitol"]=$post["id_capitol"];
    	 $result = PenalController::newSection($user);
    	 if(!$result) {
	    	 echo wsError(_("Error creating section"));
	    	 return;
    	 }
    	 if (!$result["id_seccio"]) {
    		 $responseData["id"]=$result["exist"];
    		  echo wsResponse("id", $responseData);
    		  return;
    	 }
    	 $responseData["id"]=$result["id_seccio"];
    	 echo wsResponse("id", $responseData);
    } else {
	   echo wsError(_('section exists'));
    }

});
//afegir article
$app->post("/add_article", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("article","id_tipus","id_llibre","id_titol","id_capitol","id_section","id_article");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    if(!PenalController::newArticle($post["article"])) {
    	 $user["descripcio"]=$post["article"];
    	 $user["id_article"] = $post["id_article"];
    	 $user["id_tipus_codi"]=$post["id_tipus"];
    	 $user["id_llibre"]=$post["id_llibre"];
    	 $user["id_titol"]=$post["id_titol"];
    	 $user["id_capitol"]=$post["id_capitol"];
    	 $user["id_section"]=$post["id_section"];
    	 $result = PenalController::newArticle($user);
    	 if(!$result) {
	    	 echo wsError(_("Error creating article"));
	    	 return;
    	 }
    	 if ($result['exist']=="already_exist") {
    		 $responseData["id"]=$result["exist"];
    		  echo wsResponse("id", $responseData);
    		  return;
    	 }
    	 $responseData["id"]=$result["id_article"];
    	 echo wsResponse("id", $responseData);
    } else {
	   echo wsError(_('article exists'));
    }

});

//Modificar article
$app->post("/update_article", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $result = PenalController::updateArticle($post["tipusCodi"],$post["id_article"],$post["article"]);
    if(!$result) {
	    	 echo wsError(_("Error modifying article"));
	    	 return;
     }
     $responseData["article"]=$result["id_article"];
     echo wsResponse("modified", $responseData);

});

//eliminar llibre
$app->post("/del_book", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("bookID", "codiID");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    $result=PenalController::delBook($post["bookID"],$post["codiID"]);
    if(!$result) {
	    	 echo wsError(_("Error deleting book"));
	    	 return;
    	 }
    if ($result['havechild']=="have_child") {
     	$responseData["bookID"]=$result["havechild"];
     	echo wsResponse("deleted", $responseData);
     	return;
    }
    $responseData["bookID"]=$result["id_llibre"];
     echo wsResponse("deleted", $responseData);
});
//eliminar titol
$app->post("/del_title", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("titleID", "bookID", "codiID");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    $result=PenalController::delTitle($post["titleID"],$post["bookID"],$post["codiID"]);
    if(!$result) {
	    	 echo wsError(_("Error deleting title"));
	    	 return;
    	 }
     if ($result['havechild']=="have_child") {
     	$responseData["titleID"]=$result["havechild"];
     	echo wsResponse("deleted", $responseData);
     	return;
    }

     $responseData["titleID"]=$result["id_titol"];
     echo wsResponse("deleted", $responseData);

});
//eliminar capitol
$app->post("/del_capitol", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("capitolID","titleID", "bookID", "codiID");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    $result=PenalController::delCapitol($post["capitolID"],$post["titleID"],$post["bookID"],$post["codiID"]);
    if(!$result) {
	    	 echo wsError(_("Error deleting capitol"));
	    	 return;
    	 }
    if ($result['havechild']=="have_child") {
     	$responseData["capitolID"]=$result["havechild"];
     	echo wsResponse("deleted", $responseData);
     	return;
    }
     $responseData["capitolID"]=$result["id_capitol"];
     echo wsResponse("deleted", $responseData);

});
//eliminar seccio
$app->post("/del_section", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("sectionID","capitolID","titleID", "bookID", "codiID");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    $result=PenalController::delSection($post["sectionID"],$post["capitolID"],$post["titleID"],$post["bookID"],$post["codiID"]);
    if(!$result) {
	    	 echo wsError(_("Error deleting section"));
	    	 return;
    	 }
   if ($result['havechild']=="have_child") {
     	$responseData["sectionID"]=$result["havechild"];
     	echo wsResponse("deleted", $responseData);
     	return;
    }

    $responseData["sectionID"]=$result["id_seccio"];
     echo wsResponse("deleted", $responseData);
});
//eliminar article
$app->post("/del_article", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("articleID");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
    if(!PenalController::delArticle($post["articleID"])) {
	    	 echo wsError(_("Error deleting article"));
	    	 return;
    	 }
    $responseData["articleID"]=$result["id_article"];
     echo wsResponse("deleted", $responseData);
});
//arranca l'aplicacio
$app->run();

//resposta en JSON de l'objecte que es demana
function wsResponse($key, $object) {
	$response =  array("status" => "success",
						$key => $object
							);
	return json_encode($response);
}
function wsError($errorMessage) {
	$errorResponse = array("status" => "error",
						   "error" => array("message" => $errorMessage)
							);
	return json_encode($errorResponse);
}

?>