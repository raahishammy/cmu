<?php 
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Dashboard extends MY_Admin_controller{

    protected $id;

     public function __construct()
    {
        parent::__construct();
        $this->id = $this->aauth->get_user_id();
        $this->load->model('User_wallet_model', 'UserWallet');
    
    }

     public function index_get()
    {
    	$id = $this->aauth->get_user_id();
    	$checkWallet = $this->UserWallet->get_many_by(array('user_id'=>$id));
    	$this->load->view('admin/dashboard', ['checkWallet'=>$checkWallet]);	
     }

}