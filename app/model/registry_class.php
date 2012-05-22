<?php
/**
 * Registry 
 * 
 * Store application variables in the registry
 * @author M Ibbotson
 * @package WEBCMS
*/
class Registry 
{
	/**
	 * @name $vars array
	 * @access private
	 */
	 private $vars = array();
	
	 /**
	 * Set undefined vars
	 * @param string $index
	 * @param mixed $value
	 * @return void
	 */
	 public function __set($index, $value) {
		$this->vars[$index] = $value;
	 }
	
	 /**
	 * Get variables
	 * @param mixed $index
	 * @return mixed
	 */
	 public function __get($index) {
		return $this->vars[$index];
	 }

	 /**
	 * Magik isset on register vars
	 * @param mixed $index
	 * @return bool
	 */	 
	 public function __isset($index) {
	 	return isset($this->vars[$index]);
	 }
	 
	 /**
	 * Magik unset on register vars
	 * @param mixed $index
	 * @return void
	 */	 
	 public function __unset($index) {
        unset($this->vars[$index]);
     }
}
?>