<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author raulh
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Model{

    //put your code here

    function __construct() {
        parent::__construct();
    }
    

    function get_by_id($id) {
        $this->db->where('product_id', $id);
        $query = $this->db->get('product');
        $result = $query->result();
        $query->free_result();
        if ($result) {
            return $result[0];
        } else {
            return null;
        }
    }

}
