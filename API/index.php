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
$pdo = new PDO('mysql:host='.DB_HOST.';port=3306;dbname='.DB_NAME, DB_USERNAME, DB_PW, array( PDO::ATTR_PERSISTENT => false));
$db = new NotORM($pdo);
$db->debug = function($q, $p) {
        error_log($q);
    };

\Slim::registerAutoloader();
$app = new \Slim();

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
//afegir POI
$app->post("/afegir_POI", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
	$post = $app->request()->post();
	 $fieldCheck = array("POI_id", "POI_name","POI_email","POI_360url");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }

	$POI['POI_id']= $post['POI_id'];
	$POI['POI_name']= $post['POI_name'];
	$POI['POI_description']= $post['POI_description'];
	$POI['POI_telefon']= $post['POI_telefon'];
	$POI['POI_email']= $post['POI_email'];
	$POI['POI_postal']= $post['POI_postal'];
	$POI['POI_ciutat']= $post['POI_ciutat'];
	$POI['POI_codi_postal']= $post['POI_codi_postal'];
	$POI['POI_web']= $post['POI_web'];
	$POI['POI_latitude']= $post['POI_latitude'];
	$POI['POI_longitude']= $post['POI_longitude'];
	$POI['POI_360url']= $post['POI_360url'];
	$POI['POI_mini_logo']= $post['POI_mini_logo'];
	$result = POIController::addPOI($POI);
	 if(!$result) {
	    	 echo wsError(_("Error afegint el POI"));
	    	 return;
    	 }
    foreach($result as $llista) {
    $responseData[] = $llista;
    }
     echo wsResponse("Afegint_POI", $responseData);
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
//getPublicKey
	$app->post("/getPublicKey", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $result = UserController::generateToken();
     	 if(!$result) {
	    	 echo wsError(_("Error generating token"));
	    	 return;
    	 }
    	 $responseData["hash"]=$result["token"];
    	 echo wsResponse("publicKey", $responseData);
    
});
//login
	$app->post("/login", function () use($app, $db) {
	$app->response()->header("Content-Type", "application/json");
    $post = $app->request()->post();
    $fieldCheck = array("usuari", "contrasenya");
    foreach($fieldCheck as $check) {
	     if(!isset($post[$check])) {
		     echo wsError(_($check." not provided"));
		     return;
		 }
    }
     $username=$post["usuari"];
     $password=$post["contrasenya"];
     $result = UserController::login($username, $password);
     	 if(!$result) {
	    	 echo wsError(_("Error login in"));
	    	 return;
    	 }
    	 $responseData["hash"]=$result["token"];
    	 echo wsResponse("login", $responseData);
    
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