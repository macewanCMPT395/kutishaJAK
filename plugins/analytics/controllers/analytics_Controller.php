<?php defined('SYSPATH') or die ('No direct script access.');

class analytics_Controller extends Controller {
    
    public function analytics_page()
    {
      //  view::factory('analytics/analytics_view')->render(TRUE);
        $view = View::factory('analytics/analytics_view');
        $view->ip_address = $_SERVER['REMOTE_ADDR'];
        $view->render(TRUE);
        
    }
}
