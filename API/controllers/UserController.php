<?php

class UserController {
    //genera un token/hash amb el segon de temps actual i l'email de l'usuari i actualitza el expire time del token
    static function login($username,$password) {
     $user = DbController::getInstance()->dbManager->publicKey("id= ?", 1)->fetch();
        if(!$user)
	    	return NULL;
	$token = $user["token"];
    $user = DbController::getInstance()->dbManager->usuaris("nom_usuari= ?", $username)->fetch();
 
        if(!$user)
	    	return NULL;
	    $serverHash = md5($user["clau_acces"]."-".$token);
	    if ($serverHash !=$password){
		    return NULL;
	    }
	    date_default_timezone_set('Europe/Andorra');
	    $ts = strftime("%s");
	    $newToken = md5($user["email"]."-".$ts);
	    $user["token"]=$newToken;   
	    $expireDate=date("Y-m-d H:i:s",strtotime("+1 Hour"));
	    $user["tokenExpire"]=$expireDate;  
	    $user["lastLogin"]=date("Y-m-d H:i:s",time());
	    $user->update();
	    return $user;
    }
    static function generateToken(){
        date_default_timezone_set('Europe/Andorra');
	    $user = DbController::getInstance()->dbManager->publicKey("id= ?", 1)->fetch();
        if(!$user)
	    	return NULL;
	    $ts = strftime("%s");
	    $dateCryp= md5(date("Y-m-d H:i:s",time()));
	    $newToken = sha1($dateCryp."-".$ts);
	    $user["token"]=$newToken;  
	    $user->update();
	    return $user;

    }
    static function listUsers() {
	   	$db = DbController::getInstance()->dbManager->usuaris->order("id + 0 ASC");
    	$typelist = array();
    	foreach ($db as $types) {
    		$userData['nom_usuari']= $types['nom_usuari'];
    		$userData['email']= $types['email'];
    		$userData['tipus_usuari']= $types['tipus_usuari'];
    		$userData['lastLogin']= $types['lastLogin'];
	    	array_push($typelist,$userData);
    	}
    	return $typelist;
    }
    static function getNewTokenExpireTime() {
     	date_default_timezone_set('Europe/Andorra');
	    $dateTime = new DateTime();
	    $dateTime->add(date_interval_create_from_date_string('15 minutes'));
	    return date("Y-m-d H:i:s ",$dateTime->getTimestamp());
    }
    
    static function updateTokenExpireTime($user) {
	    $user["tokenExpire"]=UserController::getNewTokenExpireTime();
	    $user["lastLogin"]=date("Y-m-d H:i:s ",time());
	    $user->update();
    }
    static function giveMyHash($username){
    $user = DbController::getInstance()->dbManager->usuaris("nom_usuari= ?", $username)->fetch();
    if(!$user)
		return NULL;
	return $user;
    }

    static function checkToken($username, $token) {
    
    	if($username == UserController::$daemon_user && $token == UserController::$daemon_pass )
    		return TRUE;
    
    	$dataNow = date("Y-m-d H:i:s ",time());
    	
    	error_log("DATA NOW: ".$dataNow);
    
	    $user = DbController::getInstance()->dbManager->users("email = ? AND token = ? and tokenExpire > ?", $username, $token, $dataNow)->fetch();
	    
	    if(!$user)
	    	return NULL;
	    else {
	    	$user["tokenExpire"]=UserController::getNewTokenExpireTime();
	    	$user->update();
		    return $user;   
	    }
    }  
}

?>