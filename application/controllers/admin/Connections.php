<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Connections extends MY_Admin_Controller{

    protected $id;

    public function __construct(){
        parent::__construct();

        $this->id = $this->aauth->get_user_id();
    }

    public function index_get(){
        $data['connections'] = $this->Users->getConnectionsByParentID( $this->id );
        // pr($data);
        $this->load->view('admin/connections', $data);
    }
}