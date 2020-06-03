<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Plans extends MY_Admin_Controller{

    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->id = $this->aauth->get_user_id();
        $this->load->library('form_validation');
        $this->load->model('Plans_model', 'Plans');
    }

    public function index_get()
    {
        if($this->aauth->get_user_role() == 'Admin'){
            $plans = $this->Plans->get_all();
            $this->load->view('admin/plan/view', ['plans' => $plans]);
        }
    }

    public function create_get()
    {
        if($this->aauth->get_user_role() == 'Admin'){
            $this->load->view('admin/plan/create');
            }
    }
    
    public function create_post()
    {
        if($this->aauth->get_user_role() == 'Admin'){
          $this->form_validation->set_rules('plan_name', 'Plan Name', 'required'); 
          $this->form_validation->set_rules('plan_amount', 'Amount', 'required'); 
          $this->form_validation->set_rules('status', 'Status', 'required'); 
            if($this->form_validation->run() == true){ 
                   $planInfo = array(
                       'plan_name' => $this->input->post('plan_name'),
                       'amount' => $this->input->post('plan_amount'),
                       'status' => $this->input->post('status')
                      );
                   $insert = $this->Plans->insert($planInfo); 
                   $this->session->set_flashdata('success', 'Your plan has been added successful.');
                    redirect('plan/create-plan'); 
             
            }else{
               $this->session->set_flashdata('fail', 'Something went wrong.');
              redirect('plan/create-plan');
            }
        }
    }

    public function edit_get()
    {
         if($this->aauth->get_user_role() == 'Admin'){
           $id = $this->uri->segment(2);
           if($id !=""){
                $plan = $this->Plans->get_by(array('id'=>$id));
                if($plan!="")
                {
                    $this->load->view('admin/plan/edit', ['plan' => $plan]);
                }else{
                   $this->session->set_flashdata('fail', 'Something went wrong.');
                    redirect('plan/create-plan');  
                }
            }
        }
    }

    public function edit_post()
    {
         if($this->aauth->get_user_role() == 'Admin'){
          pr($this->input->post());
        }
    }


}