<?php defined('SYSPATH') or die ('No direct script access.');

class Analytics_Controller extends Main_Controller {
    
  function __construct()
  {
    parent::__construct();
  }
  
  //functions are new pages
  public function index()
  {
    //Website template is added to new view/analytics/main.php
    $this->template->content = new View('analytics/main');
  }
  
  //call back function, places nav_button in nav_main_menu
  public function nav_button()
  {
    //dont know why this is formated differently- from plugin tutorial
    $view =View::factory('analytics/analytics_view')->render(TRUE);
  }

 public function test(){
    $view = View::factory('analytics/test');
    $view->heading = "MenuTest";
    $this->template->content = $view;
    //$this->template->content = new View('analytics/test');
}
}
