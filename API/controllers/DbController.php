<?php
class DbController {

    var $conn;
    var $dbManager;
    //Singleton methods
    private static $__instance = NULL;
    
    

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    static public function getInstance() {
        if (self::$__instance == NULL) {
            self::$__instance = new DbController;
        
            $host = DB_HOST;
            $db = DB_NAME;
            $user = DB_USERNAME;
            $pass = DB_PW;
            //Init the connection just one time
            self::$__instance->conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        
        	self::$__instance->dbManager = new NotORM(self::$__instance->conn);
        	self::$__instance->dbManager->debug = function($q, $p) {
	        	error_log($q." - ".implode(" - ", $p));
	        };
        }
        return self::$__instance;
    }

    
    public function query($query) {
	    return $this->conn->query($query);
    }
   
   
}

?>