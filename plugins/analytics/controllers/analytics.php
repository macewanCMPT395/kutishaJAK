<?php defined ('SYSPATH') or die('No direct script access.');

class Analytics_Controller extends Main_Controller
{
  public function index()
  {
    $this->template->content = new View('analytics/main');
  }

  public function nav_button()
  {
    $view = View::factory('analytics/analytics_view')->render(true);
  }
}