<?php

/**
 * All calls redirected via this file (mod_rewrite apache .htaccess)
 * @author M Ibbotson
 * @package mvc 
 */
 error_reporting(E_ALL);
 session_start();
 
 /** 
  * define the site path and model, view, controller dir 
  */
 define ('__SITE_PATH',      realpath(dirname(__FILE__)));
 define ('APP_PATH',         str_replace("docroot","",__SITE_PATH)."app/");
 define ('MODEL_PATH',       APP_PATH . 'model/');
 define ('TEMPLATE_PATH',    APP_PATH . 'view/');
 define ('CONTROLLER_PATH',  APP_PATH . 'controller/');

  /** 
  * PHP magic method __autoload. Loads model classes + main controller classes 
  */
 function __autoload($class_name) {
    $filename = strtolower($class_name) . '_class.php';
    if (file_exists(MODEL_PATH . $filename)) { 
    	include_once (MODEL_PATH . $filename);
    } elseif(file_exists(CONTROLLER_PATH . $filename)) {
    	include_once (CONTROLLER_PATH . $filename);
    }    
 }

 /**
  *  Bootsrap
  */
 class main {
 	
 	public function __construct() {
 		 
		 /** 
		 * @name $registry a new registry object 
		 */
		 $registry = new registry(); 
		
		 if(!empty($_POST)){                                                               # Handle post vars
		 	foreach($_POST as $k=>$v) { $registry->$k = $v; }                              # Push them to the registry
		 }
		 
		 $registry->template   = new XTemplate("index.tpl", TEMPLATE_PATH, '');            # Default template file for /
		 $registry->controller = 'index';                                                  # Default controller file for /
		 
		 /** Create the template object */
		 if(!empty($_GET['rt'])) {                                                         # .htaccess pushes everything to here
			 $url_bits = explode("/", $_GET['rt']);                                        # /controller/ exists so map it
			 $tpl      = join("", strtolower($url_bits[0]), ".tpl");                       # Overwrite default template
			 	
			 $registry->template   = new XTemplate($tpl, TEMPLATE_PATH, '');
			 $registry->controller = strtolower($url_bits[0]);                             # Controller would be the first param 
			 
			 /** load additional params to registry awesome stuff */
			 for($i=1, $cnt = count($url_bits); $i<$cnt; $i++) {                           # Nice URL's /var/value/ map to registry 
			    if($i % 2 == 0) { $registry->$url_bits[$i-1] = $url_bits[$i];}  
			 }
			 			 	
		 } 
		 
		 /** get db instance **/
		 $registry->db = db::getInstance('dbuk');                                          # DB instance
		 
		 /** load the router */
		 $registry->router = new router($registry, CONTROLLER_PATH);                       # Load the router.
		 
		 /** load the controller */
		 $registry->router->route();                                                       # Call the router 
 	}
}

new main();
  
?>
