<?php

class UserController {
		
		static $daemon_user = "mtmdaemon";
		static $daemon_pass = "MTMmelovendotoo123123";
		
    static function checkUser($username) {
    	$db = DbController::getInstance()->dbManager;
	    $actualUser = DbController::getInstance()->dbManager->sap_users("TIP = ?", $username)->fetch();
	    if(!$actualUser)
	    	return false;
	    	
	    return true;
    }
    
    static function checkLegitUser($tip, $dni) {
		$row = 1;
		$dni=strtoupper($dni);
		if (($handle = fopen("./tip/VOLCAT.CSV", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				// [0] = TIP; [2] = DNI
				if($tip == $data[0] && $dni == strtoupper($data[2]))
					return "OK";
	
			}
			
			
			fclose($handle);
			return "No es troba cap afiliat amb aquestes dades";
		} else {
			return "Error obrint el fitxer de validació";
		}
	}
    
    static function addUser($user) {
	    $result = DbController::getInstance()->dbManager->sap_users->insert($user);
	    if(!$result)
	    	return NULL;
	    $result = UserController::generateNewToken($result);
	    return $result;
    }
    
    static function generateNewToken($user) {
	    
	    $ts = strftime("%s");
	    
	    $newToken = md5($user["email"]."-".$ts);
	    
	    $user["token"]=$newToken;   
	    $user["tokenExpire"]=UserController::getNewTokenExpireTime();
	    date_default_timezone_set('UTC');
	    $user["lastLogin"]=date("Y-m-d H:i:s",time());
	    
	    $user->update();
	    
	    return $user;
    }
    
    static function getNewTokenExpireTime() {
     	date_default_timezone_set('UTC');
	    $dateTime = new DateTime();
	    $dateTime->add(date_interval_create_from_date_string('30 minutes'));
	   
	    return date("Y-m-d H:i:s ",$dateTime->getTimestamp());
    }
    
    static function updateTokenExpireTime($user) {
	    $user["tokenExpire"]=UserController::getNewTokenExpireTime();
	    $user["lastLogin"]=date("Y-m-d H:i:s ",time());
	    $user->update();
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

    static function checkLogin($password, $TIP) {
    	
	    $user = DbController::getInstance()->dbManager->sap_users("password = ? AND TIP = ?", $password, $TIP)->fetch();
	    if($user == NULL) {
	    	return NULL;
	    } else {
	    	//UserController::updateTokenExpireTime($user);
	    	$user["lastLogin"]=date("Y-m-d H:i:s ",time());
	    	$user->update();
			return $user;   
	    }
    }
    
    static function checkLoginApp($password, $TIP, $appPlatform, $appToken) {
    
    	$user = self::checkLogin($password, $TIP);
    	
    	if(!isset($user["appPlatform"]) || $user["appPlatform"] == NULL) {
	    	$user["appPlatform"] = $appPlatform;
	    	$user["appToken"] = $appToken;
	    	$user->update();
	    	return $user;
    	} else {
	    	if($user["appToken"] != $appToken)
	    		return NULL;
	    	else {
	    		//UserController::updateTokenExpireTime($user);
	    		$user["lastLogin"]=date("Y-m-d H:i:s ",time());
	    		$user->update();
	    		return $user;
	    	}
    	}
    	
    
	    $user = DbController::getInstance()->dbManager->sap_users("password = ? AND TIP = ? AND appPlatform = ? AND appToken = ?", $password, $TIP, $appPlatform, $appToken)->fetch();
	    if($user == NULL) {
	    	return NULL;
	    } else {
	    	
			return $user;   
	    }
    }
    
    static function llistarUsuaris() {
    	$db = DbController::getInstance()->dbManager->usuaris();
    	//var_dump($db);
    	$userlist = array();
    	foreach ($db as $usuaris) {
    		$userData['nom_usuari']= $usuaris['nom_usuari'];
    		$userData['tipus_usuari']= $usuaris['tipus_usuari'];
	    	array_push($userlist,$userData);
	    	
    	}
    	return $userlist;
    }
    static function delUser($TIP) {
    	$user = DbController::getInstance()->dbManager->sap_users("TIP = ?", $TIP)->fetch();
    	$user->delete();
    }
    
    static function modUser($TIP,$isEnabled,$isAdmin) {
        $user = DbController::getInstance()->dbManager->sap_users("TIP = ?", $TIP)->fetch();
        if ($isEnabled==1 && $user["enabled"]==0) {
	       	$user["enabled"]=1;
	    }
	    else if($isEnabled==1 && $user["enabled"]==1){
	  	  $user["enabled"]=0;
	    }
	    if ($isAdmin==1 && $user["isAdmin"]==0) {
	       	$user["isAdmin"]=1;
	    }
	    else if ($isAdmin==1 && $user["isAdmin"]==1) {
	  	  $user["isAdmin"]=0;
	    }
	    $user->update();
    }

}

?>