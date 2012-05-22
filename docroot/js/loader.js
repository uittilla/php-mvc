/*
 * Author : mark.ibbotson@manheim.co.uk (Ibbo)
 * Purpose: dynamically load javascript based upon current page
 * Version: 1.0
 * Date   : 120111 
 */

var MVC = MVC || {};

jQuery.loader = {
    
    path: window.location.pathname.split('/'),
    
    init: function () {

       var module = this.path[1]; 
       
       switch (module) 
        {
        	default:
               // load some script or other 
            break;
        }   
    }    
};
