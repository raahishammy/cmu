<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public function __construct(){

        parent::__construct();

    }

    /**
     * Requests are not made to methods directly, the request will be for
     * an "object". This simply maps the object and method to the correct
     * Controller method
     *
     * @access public
     * @param string $object_called
     * @param array $arguments The arguments passed to the controller method
     */
    public function _remap($object_called, $arguments = [])
    {
      // Remap
      $controller_method = $object_called.'_'.$this->input->method();

      // Does this method exist? If not, try executing an index method
	    if (!method_exists($this, $controller_method)) {
		    $controller_method = "index_" . $this->input->method();
		    array_unshift($arguments, $object_called);
	    }

      // Call the controller method and passed arguments
      if (method_exists($this, $controller_method))
      {
        return call_user_func_array(array($this, $controller_method), $arguments);
      }
      show_404();
    }
}

require_once APPPATH.'core/MY_Admin_Controller.php';
require_once APPPATH.'core/MY_Public_Controller.php';