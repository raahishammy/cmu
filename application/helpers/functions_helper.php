<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('show_flash_messages')) {
    function show_flash_messages( $messages ){

        $messages_html = '';
        if(!empty($messages)){
            if(is_array($messages)){
                foreach($messages as $loop=>$message){
                    $messages_html .= '<p>'.$message.'</p>';
                }
            }else{
                $messages_html = $messages;
            }
        }

        return $messages_html;
    }
}


if (!function_exists('pr')) {
    function pr( $array = array() ){

        echo '<pre>'; print_r($array); die;
    }
}

if(!function_exists('create_connections_tree_view')){
    function create_connections_tree_view($connections){
            if(!isset($connection_html)) {
                $connection_html = '';
            }
          $connection_html .= '<div class="hv-item-children">';
           foreach($connections as $loop=>$user){
           $connection_html .= '<div class="hv-item-child">';   
            if(isset($user->children) && !empty($user->children)){
             $connection_html .= '<div class="hv-item">';
                    $connection_html .= '<div class="hv-item-parent">';
                        $connection_html .= '<p class="simple-card"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">  <a href="'.site_url().'connections/'.$user->id.'">'.$user->name.' 
                        </a></font></font></br></p>';
                    $connection_html .= '</div>';
                    $connection_html .= '</div>';
                    $connection_html .= create_connections_tree_view($user->children);
                    $connection_html .= '</div>';

             }else{
                    $connection_html .= '<div class="hv-item-child">';
                 $connection_html .= '<p class="simple-card"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <a href="'.site_url().'connections/'.$user->id.'"> '.$user->name.'</a> </font></font></p>';
                  $connection_html .= '</div>';
                  $connection_html .= '</div>';
              
               }
            }
             
        $connection_html .= '</div>';
         return $connection_html;
    }
}