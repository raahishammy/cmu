<?php
if(!defined('BASEPATH')) exit("Direct access is not allowed");

class Users_model extends MY_Model { 
    // Table Name
    public $_table = 'ci_aauth_users';

    // Primary Key
    public $primary_key = 'id';

    // Soft Delete
    protected $soft_delete = TRUE;

    public function getConnectionsByParentID($parent_id = 0){
        
        if(!isset($connectionsArray)) $connectionsArray = array();
        
        $connections = $this->db->get_where( $this->_table, array("parent_id" => $parent_id))->result();
        if(!empty($connections)){
            foreach($connections as $user){
                $connectionsArray[$user->id] = $user;
                if($this->hasChildren($user->id)){
                    $connectionsArray[$user->id]->children = $this->getConnectionsByParentID($user->id);
                }
            }
        }
        
        return $connectionsArray;
    }

    public function hasChildren($parent_id){
        $connections = $this->db->get_where( $this->_table, array("parent_id" => $parent_id));
        if($connections->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    } 
}