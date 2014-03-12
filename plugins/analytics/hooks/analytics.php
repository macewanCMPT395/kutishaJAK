<?php defined ('SYSPATH') or die ('No direct script access.');

class analytics {

    public function __construct()
    {
        // Hook into routing
        Event::add('system.pre_controller', array($this, 'analytic'));
        }


    public function analytic()
    {
   //Hook into the nav_main_top event and call the analytics controller
    // And the method analytics_page within the analytics controller
    Event::add('ushahidi_action.nav_main_top', array('Analytics_Controller', 'analytics_page'));
    }

}

// instatiation of hook

new analytics;
