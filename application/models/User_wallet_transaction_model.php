<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class User_wallet_transaction_model extends MY_Model { 
    // Table Name
    public $_table = 'ci_user_wallet_transactions';
	// Primary Key
    public $primary_key = 'id';
		// Soft Delete
    protected $soft_delete = TRUE;

}