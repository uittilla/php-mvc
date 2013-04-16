<?php

class db{

	/*** Declare instance ***/
	private static $instance = NULL;
	
	/**
	* the constructor is set to private so
	* so nobody can create a new instance using new
	*/
	private function __construct() { /*** maybe set the db name here later ***/ }
	
	/**
	*
	* Return DB instance or create intitial connection
	* @return object (PDO)
	* @access public
	*/
	public static function getInstance($db) {
	    if (!self::$instance) {
	        try {
	        	$connection = new Mongo('localhost');
	        	self::$instance = $connection->selectDB($db);	            			
			} 
			catch (MongoConnectionException $e) {
			    trigger_error("Could not connect to database: ". $e->getMessage(), E_USER_ERROR);
			}
	    }
		
		return self::$instance;
	}
	/**
	* Like the constructor, we make __clone private
	* so nobody can clone the instance
	*/
	private function __clone(){	}
	
} /*** end of class ***/

?>
