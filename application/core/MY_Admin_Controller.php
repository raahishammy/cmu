<?php
if(!defined('BASEPATH')) exit("Direct Access is not allowed");

class MY_Admin_Controller extends MY_Controller{

    public function __construct(){

        parent::__construct();
        if($this->aauth->is_loggedin() == false){
            redirect('login');
        }
    }
}