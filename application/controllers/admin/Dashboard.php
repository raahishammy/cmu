<?php 

class Dashboard extends MY_Admin_controller{

    protected $id;

    public function __contruct(){

        parent::__contruct();
    }

    public function index_get(){

        $this->load->view('admin/dashboard');
    }
}