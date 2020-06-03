<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Users_plan_model extends MY_Model { 
    // Table Name
    public $_table = 'ci_user_plans';
	// Primary Key
    public $primary_key = 'id';
		// Soft Delete
    protected $soft_delete = TRUE;

}