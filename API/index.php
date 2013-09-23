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