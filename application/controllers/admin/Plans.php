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
        $this->load->model('Users_plan_model', 'UserPlan');
        $this->load->model('User_wallet_transaction_model', 'WalletTransaction');
        $this->load->model('User_wallet_model', 'UserWallet');
        

        
    }

    public function index_get()
    {
        if($this->aauth->get_user_role() == 'Admin')
        {
            $plans = $this->Plans->get_all();
            $this->load->view('admin/plan/view', ['plans' => $plans]);
        }
    }

    public function create_get()
    {
        if($this->aauth->get_user_role() == 'Admin')
        {
            $this->load->view('admin/plan/create');
            }
    }
    
    public function create_post()
    {
        if($this->aauth->get_user_role() == 'Admin')
        {
          $this->form_validation->set_rules('plan_name', 'Plan Name', 'required'); 
          $this->form_validation->set_rules('plan_amount', 'Amount', 'required'); 
          $this->form_validation->set_rules('status', 'Status', 'required'); 
            if($this->form_validation->run() == true)
            { 
                   $planInfo = array(
                       'plan_name' => $this->input->post('plan_name'),
                       'amount' => $this->input->post('plan_amount'),
                       'status' => $this->input->post('status')
                      );
                   $insert = $this->Plans->insert($planInfo);
                   $insert_id = $this->db->insert_id(); 
                   $this->session->set_flashdata('success', 'Your plan has been added successful.');
                    redirect('plan/'.$insert_id); 
             
            }else{
               $this->session->set_flashdata('fail', 'Something went wrong.');
              redirect('plan/create-plan');
            }
        }
    }

    public function edit_get()
    {
         if($this->aauth->get_user_role() == 'Admin')
         {
           $id = $this->uri->segment(2);
           if($id !="")
           {
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

    public function edit_post($id = NULL)
    {
    if($this->aauth->get_user_role() == 'Admin')
    {
          $id = $this->input->post('plan_id');
          $this->form_validation->set_rules('plan_name', 'Plan Name', 'required'); 
          $this->form_validation->set_rules('plan_amount', 'Amount', 'required'); 
          $this->form_validation->set_rules('status', 'Status', 'required'); 
            if($this->form_validation->run() == true)
            { 
                   $planInfo = array(
                      'plan_name' => $this->input->post('plan_name'),
                       'amount' => $this->input->post('plan_amount'),
                       'status' => $this->input->post('status')
                      );
                   $insert = $this->Plans->update($id, $planInfo); 
                   $this->session->set_flashdata('success', 'Your plan has been updated successfully.');
                    redirect('plan/'.$id); 
             
            }else{
               $this->session->set_flashdata('fail', 'Something went wrong.');
               redirect('plans');
            }
        }
    }

    public function subscribe_get()
    {
          $plans = $this->Plans->get_many_by('status','1');
           $this->load->view('admin/plan/purchase-plan', ['plans' => $plans]);
    }

    public function subscribe_post()
    {
      $data =array();
      $packageId = $this->input->post('package_id');
      if($packageId !="" && $this->id !="")
      {
        $findSubscription = $this->UserPlan->get_many_by(array('plan_id'=>$packageId,'user_id'=> $this->id));
          $this->create_wallet($packageId);
        if(empty($findSubscription))
        {
        $plan = array(
          'plan_id' => $this->input->post('package_id'),
          'user_id' => $this->id
        );
        $insert = $this->UserPlan->insert($plan); 
        $insert_id = $this->db->insert_id(); 
        $this->create_wallet_transaction($packageId);
        if($insert)
        {
          $data['status'] = 'alert-success';
          $data['message'] = 'Plan Subscribed Successfully';
        }else{
           $data['status'] = 'alert-danger';
           $data['message'] = 'Something went worng';
        }
        }else{
        $data['status'] = 'alert-danger';
           $data['message'] = 'This plan is already subscribed';
        }
      }else{
         $data['status'] = 'alert-danger';
         $data['message'] = 'Something went worng';
      }
        echo json_encode($data);
        die();
    }


    public function create_wallet($packageId)
    {
      $findPackagePrice = $this->Plans->get_many_by(array('id'=>$packageId));
      $packagePrice = $findPackagePrice[0]->amount;
      $wallet = $this->UserWallet->get_many_by(array('user_id'=>$this->id));
      if(empty($wallet))
      {
         $walletData = array(
          'user_id' => $this->id,
          'amount' => 0
        );
        $insert = $this->UserWallet->insert($walletData); 
      }else{
        $previousAmount = $wallet[0]->amount + $packagePrice;
          $walletData = array(
            'user_id' => $this->id,
            'amount' => 0
          );
       $this->UserWallet->update($wallet[0]->id, $walletData); 
      }
      return;
    }

     public function create_wallet_transaction($packageId)
    {
      $findPackagePrice = $this->Plans->get_many_by(array('id'=>$packageId));
      $packagePrice = $findPackagePrice[0]->amount;
       $wallet = $this->UserWallet->get_many_by(array('user_id'=>$this->id));
         $walletData = array(
          'user_id' => $this->id,
          'wallet_id' => $wallet[0]->id,
          'amount' => $packagePrice
        );
         $insert = $this->WalletTransaction->insert($walletData); 
        return;
    }


    
}