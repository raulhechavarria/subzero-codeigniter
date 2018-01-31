<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shippingaddress
 *
 * @author raulh
 */
class shippingaddress extends CI_Model{

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function create($data, $last_id) {
        
        $items['shippingaddress'] = $data['shippingaddress'];

        $items['user_id'] = $last_id;


        $this->db->insert('shippingaddress', $items);
        return true;
    }
    
    function get_by_id($id) {
        $this->db->where('idshippingaddress', $id);
        $query = $this->db->get('shippingaddress');
        $result = $query->result();
        $query->free_result();
        if ($result) {
            return $result[0];
        } else {
            return null;
        }
    }
    
    function get_by_user($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('shippingaddress');
        $result = $query->result();
        $query->free_result();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

}
