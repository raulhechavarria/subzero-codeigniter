<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author raulh
 */
class user extends CI_Model
{
	function __construct()
    {
      parent::__construct();	       
    }
    
    function get_by_id($id)
    {      
      $this->db->where('user_id', $id);
      $query = $this->db->get('users');
      $result = $query->result();
      $query->free_result();
      if($result){ return $result[0]; }
      else {return null; }
    }
    
    function create($data)
    {      
      $items = array();      
      if(array_key_exists('user_firstname', $data))
      { $items['user_firstname'] = $data['user_firstname']; }
	  if(array_key_exists('user_lastname', $data))
      { $items['user_lastname'] = $data['user_lastname']; }
	  if(array_key_exists('user_login', $data))
      { $items['user_login'] = $data['user_login']; }
	  if(array_key_exists('user_password', $data))
      { $items['user_password'] = md5($data['user_password']); }      
      $this->db->insert('users', $items);     
      return true;
      
    }
    
    function update($data, $id)
    {      
      $items = array();      
      if(array_key_exists('user_firstname', $data))
      { $items['user_firstname'] = $data['user_firstname']; }
	  if(array_key_exists('user_lastname', $data))
      { $items['user_lastname'] = $data['user_lastname']; }
	  if(array_key_exists('user_login', $data))
      { $items['user_login'] = $data['user_login']; }
	  if(array_key_exists('user_password', $data))
      { $items['user_password'] = md5($data['user_password']); }    
      $this->db->where('user_id', $id);
      $this->db->update('users', $items);	  
      return true;
      
    }
    
    function delete($id)
    {        
      $this->db->where('user_id', $id);
      $this->db->delete('users');
      return true;      
    }
    
}
