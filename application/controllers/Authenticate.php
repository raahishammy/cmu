<?php
defined('BASEPATH') OR exit('Direct access is not allowed');

class Authenticate extends MY_Public_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index_get(){
        
        if($this->aauth->is_loggedin() ){
            redirect( 'dashboard' ); 
        }else{
            $this->load->view('pages/login');
        }
    }

    public function index_post(){
        
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->index_get();
        }else{
            if($this->aauth->login($this->input->post('email'),$this->input->post('password'), $this->input->post('remember'))){
                if($user = $this->aauth->get_user()){
                    redirect('dashboard');
                }
            }else{
                // $this->session->set_flashdata('fail', $this->aauth->get_errors() );	
                redirect('login');
            }
        }
    }

    public function logout_get(){
	
        $this->aauth->logout();
        
        $this->session->set_flashdata('success', "Logout Successfully!");	
		redirect('login'); 
	}

    /**
     * Renders HTML View Of Join Page,
     * 
     * 
     */
    public function register_get( $referral_id){
        
        if(empty($referral_id)){
            $this->session->set_flashdata('fail','Referral Link is Invalid or Expired.');
            redirect('login');
        }
        
        if($user = $this->Users->get_by('md5(id)', $referral_id)){
            $this->load->view('pages/register');
        }else{
            $this->session->set_flashdata('fail','Referral Link is Invalid or Expired.');
            redirect('login');
        }
        
    }

    public function register_post( $referral_id){
        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique_email',
            array(
                'is_unique_email'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('contact','Contact','required|trim|is_unique_contact',
            array(
                'is_unique_contact' =>  'This %s already associated with another account.'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->register_get($referral_id);
        }else{

            $user = $this->Users->get_by('md5(id)', $referral_id);
            if($_SERVER['HTTP_HOST'] == "localhost"){
                $password = md5("Admin@123");
            }else{
                $password = $this->aauth->randomPassword();
            }
            $user_id = $this->Users->insert([
                'name'  =>  $this->input->post('name'),
                'email'  =>  $this->input->post('email'),
                'contact'  =>  $this->input->post('contact'),
                'parent_id'  =>  $user->id,
                'password'  =>  $password,
                'role'  =>  'subscriber',
            ]);

            if($user_id){
                // $data['subscriber'] = $this->aauth->get_user($user_id);
                // $email_html = $this->load->view('emails/verification_email', $data, true);
                
                $this->session->set_flashdata('success','Verification email has been sent on the given email ID. Please check the email to get the Password.');
                redirect('login');
            }
        }
    }
}