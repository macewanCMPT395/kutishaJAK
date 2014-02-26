<?php defined ('SYSPATH') or die ('No direct script access.');

class analytics {

    public function __construct()
    {
        // Hook into routing
        Event::add('system.pre_controller', array($this, 'analytic'));
        }


    public function analytic()
    {
   //Hook into the main_sidebar event and call the analytics controller
    // And the method analytics_page within the hello controller
    Event::add('ushahidi_action.nav_main_tops', array($this, 'analytics_page'));
    }

    public function analytics_page()
    {

//      grabs the view and display
        view::factory('analytics/analytics_view')->render(TRUE);
   }
}

// instatiation of hook

new analytics;
