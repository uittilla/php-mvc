<?php
/**
 * MVC controller
 * @author M Ibbotson
 * @package MVC
 * @version 2.0 
 * @copyright Ibbo
*/
abstract class Controller 
{
	
   /**
   * Create a list of files available to form a change set 
   * Base class constructor is called 
   * Child class omits a _constructor method to do this
   * @access private
   * @return void
   * @param mixed $_POST
   */ 
   public function __construct($register) {
	   $this->register = $register;
	   $this->tpl      = $register->template;
	   $this->db       = $register->db;
	}

    /**
     * LoadClass
     * 
     * Loads classes on the fly
	 * @return  object $obj
	 * @param string $type class name, 
	 * @param bool $obj true/ false, 
	 * @param mixed array $param
	 * @access  public
	*/
	public function loadClass($type, $obj, $param=null) {		
       // We can now use try / catch on these
  	   if (include_once (MODEL_PATH . $type . '_class.php')) {
  	   	
		  if ($obj)  {
		  	 return (!empty($param)) ? new $type($param) : new $type;
		  }
		  
	   } else {	   	
		     throw new Exception($type . ' not found');		
	   }
	}

	/**
	 * All controllers must contain an index method
	 * @abstract all controllers derived from Parent
	 */
	abstract function index();
}
?>
