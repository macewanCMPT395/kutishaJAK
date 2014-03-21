<?php defined ('SYSPATH') or die ('No direct script access.');

class analytics {
   
   public function __construct()
    {
        // Hook into routing
        Event::add('system.pre_controller', array($this, 'analytic'));
    }
   
   public function analytic()
    {
        //Callback function - Nav_button function in the analytics Controller 
        Event::add('ushahidi_action.nav_main_top', array('Analytics_Controller', 'nav_button'));
    }
}
// instatiation of hook
new analytics;
