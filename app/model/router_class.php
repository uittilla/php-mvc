<?php
/**
 * Router
 *
 * Maps the route and calls the required class and action
 * Revamp of old way inspired by my (PERL) way of doing it
 * Kudos to C Colbourn for that
 * @author M Ibbotson
 * @package WEBCMS
*/
class Router
{
	/**
	 * registry object
	 * @name $registry
	 */
	private $registry;
	/**
	 * Path to the controller
	 * @name $path
	 */
	private $path;
	
	/**
	 * File to load
	 * @name $file
	 */
	public $file;
	/**
	 * Class to load
	 * @name $controller
	 */
	public $controller;

	/**
	 * Create Router object
	 * @access public
	 * @return void
	 */
	public function __construct($registry, $controller_path) {
		$this->registry   = $registry;                                        # use by all Registry
		$this->path       = $controller_path;                                 # controller path
		$this->controller = $registry->controller;                            # controller set in config
		$this->class      = join('', array($this->controller,'Controller'));  # build the class name
	}

	/**
	 * Load the controller
	 * Ensure the controller exists, and is callable.
	 * Call the controller if true. Throw a 404 if not
	 * @access public
	 * @return void
	 */
	public function route() {
		$this->file = join("", array($this->path, $this->controller, ".php"));

	    if (is_readable($this->file) === false) {                             # does the file exists ?
	        header("Location: /error/bad/" . $this->controller);              # redirect 404 (errors exist as I put it there)
			exit;                                                             # quit out of here
		}

	    include_once($this->file);                                            # we get here so include the file
        $controller = new $this->class($this->registry);                      # instantiate it (Base class constructor)
        
        if(is_callable(array($controller, 'index')) === false ) {             # index is abstract so should be ALWAYS present
        	header("Location: /error/bad/" . $this->controller);              # redirect 404 (errors exist as I put it there)
        	exit;                                                             # quit out of here
        } 
 
        $controller->index();
	}
}
?>