<?php defined('SYSPATH') or die ('No direct script access.');

class Analytics_Controller extends Main_Controller {
    
    //functions are new pages
    public function index()
    {
        //Website template is added to new view/analytics/main.php
        $this->template->content = new View('analytics/main');
    }

    //functions are new pages
    public function test()
    {
        $view = new View('analytics/test');
        $this->template->content = $view;
        //send in variables to the view
        $view->heading = "hello world";
    }

    //call back function, places nav_button in nav_main_menu
    public function nav_button()
    {
        //dont know why this is formated differently- from plugin tutorial
        $view =View::factory('analytics/analytics_view')->render(TRUE);
    }


function __construct()
	{
		parent::__construct();
	}
}