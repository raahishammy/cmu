<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Referrals extends MY_Admin_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index_get(){
        $this->load->view('admin/referrals');
    }
}