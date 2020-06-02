<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Connections extends MY_Admin_Controller{

    protected $id;

    public function __construct(){
        parent::__construct();
        $this->id = $this->aauth->get_user_id();
    }

    public function index_get(){
        if($this->uri->segment(2) ==""){
            $data['connections'] = $this->Users->getConnectionsByParentID( $this->id );
        }else{
            $id = $this->uri->segment(2);
            $checkUserExists = $this->Users->checkUser($id);
            if($checkUserExists !="" || is_numeric($id)){
                $data['connections'] = $this->Users->getConnectionsByParentID( $id );
                $data['parent'] = $checkUserExists;
           }else{
                $data['connections'] = "";
                 $data['parent'] = "";
            }
       }
        $this->load->view('admin/connections', $data);
    }
}