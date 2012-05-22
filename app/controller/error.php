<?php
/**
 * Error controller
 * 
 * Throw 404 error and name the controller in question
 * @author M Ibbotson
 * @package WEBCMS
 */
class errorController extends Controller 
{
   /**
    * Throw a 404 error 
    * @return: void
    * @access: public
   */
	public function index() {
		
	  $this->tpl->assign('file', $this->register->bad);	
	  $this->tpl->display();
	}
}
?> 