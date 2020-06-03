<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Plans_model extends MY_Model { 
    // Table Name
    public $_table = 'ci_plans';

    // Primary Key
    public $primary_key = 'id';

    // Soft Delete
    protected $soft_delete = TRUE;

    
    

}