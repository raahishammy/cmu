<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function user_email_exists_check($email = NULL, $id = NULL)
{
  $CI = &get_instance();

  $exist = $CI->Users->get_by('email', $email);

  if ($exist){
    if ($id && $exist->id == $id) {
      return TRUE;
    }else {
      return FALSE;
    }
  }
  return TRUE;  
}

function is_unique_contact( $contact, $id = null){

    $CI = &get_instance();
    $exist = $CI->Users->get_by('contact', $contact);

    if ($exist){
        if (!empty($id) && $exist->id == $id) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
    return TRUE;  
}