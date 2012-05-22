<?php
/**
 * Index controller
 * @package ...
 * @author M Ibbotson
 */
class indexController extends Controller 
{	
   /** 
    *  No constructor here so call parents
    */
   public function index() {

   	 $this->tpl->parse('main.body.default');
	 $this->tpl->display();
   }
}
?>
