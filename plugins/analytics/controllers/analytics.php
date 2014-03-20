<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This is the controller for the main site.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
class Analytics_Controller extends Main_Controller {
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $template->content = new View('analytics/main');
  }
  /*
  public function analytics_page()
  {
    // view::factory('analytics/analytics_view')->render(TRUE);
    $view = View::factory('analytics/analytics_view');
    $view->ip_address = $_SERVER['REMOTE_ADDR'];
    $view->render(TRUE);
  }
  */
} // End Main
