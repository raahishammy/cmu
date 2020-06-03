<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Aauth{

    
	/**
	 * The CodeIgniter object variable
	 * @access public
	 * @var object
	 */
    public $CI;
    
    /**
	 * Array to store error messages
	 * @access public
	 * @var array
	 */
    public $errors = array();

    /**
	 * Local temporary storage for current flash errors
	 *
	 * Used to update current flash data list since flash data is only available on the next page refresh
	 * @access public
	 * var array
	 */
	public $flash_errors = array();

    public function __construct(){

        // get main CI object
        $this->CI = & get_instance();

        $this->CI->load->database();

        $this->errors = $this->CI->session->flashdata('errors') ?: array();
    }

    
	########################
	# Login Functions
	########################

	//tested
	/**
	 * Login user
	 * Check provided details against the database. Add items to error array on fail, create session if success
	 * @param string $email
	 * @param string $pass
	 * @param bool $remember
	 * @return bool Indicates successful login.
	 */
	public function login($identifier, $password, $remember = FALSE) {
        
		// Remove cookies first
		$cookie = array(
			'name'	 => 'user',
			'value'	 => '',
			'expire' => -3600,
			'path'	 => '/',
		);
				
        $this->CI->input->set_cookie($cookie);
        
		// if user is not verified
        $query = null;
        
		$query = $this->CI->db->where('email', $identifier);
        $query = $this->CI->db->get('ci_aauth_users');
        
        if($query->num_rows() == 0){
			$this->error("No User Found with the given details.");
			return FALSE;
        }
        
        $row = $query->row();
        
        if ($query->num_rows() > 0 && $this->verify_password($password, $row->password)) { 
            
            $data = array(
                'id' => $row->id,
                'email' => $row->email,
                'loggedin' => TRUE,
            );

            $this->CI->session->set_userdata($data);

            if ( $remember ){
                $this->CI->load->helper('string');
                $expire = ' +3 days ';
                $today = date("Y-m-d");
                $remember_date = date("Y-m-d", strtotime($today . $expire) );
                $random_string = random_string('alnum', 16);
                $unexpired_cookie_exp_time = 2147483647 - time();
                $cookie = array(
                    'name'	 => 'user',
                    'value'	 => $row->id . "-" . $random_string,
                    'expire' => time() + (60 * 60),
                    'path'	 => '/',
                );
                $this->CI->input->set_cookie($cookie);
                setcookie('user',$row->id . "-" . $random_string,time() + (60 * 60));
            }

            return TRUE;
        }else{
            $this->error("Incorrect Email or Password.");
			return FALSE;
        }

    }

    /**
	 * Check user password
	 * Checks if user's password string match with the actual password'.
	 * @return bool
	 */
    public function verify_password($password, $hash_password ){
        return ( md5($password) == $hash_password) ? true : false;
	}
	
    /**
	 * Generate Random Password
	 * Generates a random password string.
	 * @return string
	 */
    public function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return md5(implode($pass)); //turn the array into a string
	}

    /**
	 * Check user login
	 * Checks if user logged in, also checks remember.
	 * @return bool
	 */
	public function is_loggedin() {
        if ( $this->CI->session->userdata('loggedin') ){
			return TRUE;
		}else {
			if( ! $this->CI->input->cookie('user', TRUE) ){
				return FALSE;
			} else {
                $cookie = explode('-', $this->CI->input->cookie('user', TRUE));
                
                if(!is_numeric( $cookie[0] ) OR strlen($cookie[1]) < 13 ){
                    return FALSE;
                }else{
					$query = $this->CI->db->where('id', $cookie[0]);
					$query = $this->CI->db->get('ci_aauth_users');

					$row = $query->row();

					if ($query->num_rows() < 1) {
						return FALSE;
					}else{					
                        $this->login_fast($cookie[0]);
                        return TRUE;
					}
				}
			}
		}
		return FALSE;
    }

    /**
	 * Fast login
	 * Login with just a user id
	 * @param int $user_id User id to log in
	 * @return bool TRUE if login successful.
	 */
	public function login_fast($user_id){

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->get('ci_aauth_users');

		$row = $query->row();

		if ($query->num_rows() > 0) {

			// create session
			$data = array(
				'id' => $row->id,
				'email' => $row->email,
				'loggedin' => TRUE,
			);

			$this->CI->session->set_userdata($data);
			return TRUE;
		}
		return FALSE;
	}

    /**
	 * Logout user
	 * Destroys the CodeIgniter session and remove cookies to log out user.
	 * @return bool If session destroy successful
	 */
	public function logout() {
		$cookie = array(
			'name'	 => 'user',
			'value'	 => '',
			'expire' => -3600,
			'path'	 => '/',
		);

		$this->CI->input->set_cookie($cookie); 
		setcookie('user','',time() + (60 * 60));
		return $this->CI->session->sess_destroy();
    }
    
    /**
	 * Get user
	 * Get user information
	 * @param int|bool $user_id User id to get or FALSE for current user
	 * @return object User information
	 */
	public function get_user($user_id = FALSE) { 

		if ($user_id == FALSE)
			$user_id = $this->CI->session->userdata('id');

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->get('ci_aauth_users');

		if ($query->num_rows() <= 0){
			$this->error("No User Found with the given details.");
			return FALSE;
		}
		return $query->row();
	}

    /**
	 * Get user id
	 * Get user id from email address, if par. not given, return current user's id
	 * @param string|bool $email Email address for user
	 * @return int User id
	 */
	public function get_user_id($email=FALSE) {

		if( ! $email){
			$query = $this->CI->db->where('id', $this->CI->session->userdata('id'));
		} else {
			$query = $this->CI->db->where('email', $email);
		}

		$query = $this->CI->db->get('ci_aauth_users');

		if ($query->num_rows() <= 0){
			$this->error("No User Found with the given details.");
			return FALSE;
		}
		return $query->row()->id;
    }

    /**
	 * Get user name
	 * Get user name from user id, if par. not given, return current user's id
	 * @param string|bool $user_id user id
	 * @return string User Name
	 */
	public function get_user_name($user_id=FALSE) {

		if( ! $user_id){
			$query = $this->CI->db->where('id', $this->CI->session->userdata('id'));
		} else {
			$query = $this->CI->db->where('id', $user_id);
		}

		$query = $this->CI->db->get('ci_aauth_users');

		if ($query->num_rows() <= 0){
			$this->error("No User Found with the given details.");
			return FALSE;
		}
		return $query->row()->name;
    }

    public function get_user_role($user_id=FALSE) {

		if( ! $user_id){
			$query = $this->CI->db->where('id', $this->CI->session->userdata('id'));
		} else {
			$query = $this->CI->db->where('id', $user_id);
		}

		$query = $this->CI->db->get('ci_aauth_users');

		if ($query->num_rows() <= 0){
			$this->error("No User Found with the given details.");
			return FALSE;
		}
		return $query->row()->role;
    }

 /**
	 * Error
	 * Add message to error array and set flash data
	 * @param string $message Message to add to array
	 * @param boolean $flashdata if TRUE add $message to CI flashdata (deflault: FALSE)
	 */
	public function error($message = '', $flashdata = TRUE){
		$this->errors[] = $message;
		if($flashdata)
		{
			$this->flash_errors[] = $message;
			$this->CI->session->set_flashdata('fail', $this->flash_errors);
		}
	}
    
    /**
	 * Get Errors Array
	 * Return array of errors
	 * @return array Array of messages, empty array if no errors
	 */
	public function get_errors_array(){
		return $this->errors;
    }
    
    /**
	 * Get Errors HTML String
	 * Return html string of errors
	 * @return string HTML String of messages, empty if no errors
	 */
	public function get_errors(){

        $errors_html = '';

		if($this->errors){
            foreach($this->errors as $loop => $error){
                $errors_html .= (($loop+1) == count($this->errors)) ? $error : $error . ' <br />';
            }
        }
        return $errors_html;
	}
}
