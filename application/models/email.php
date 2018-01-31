<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Emails
 *
 * @author raulh
 */
class email extends CI_Model {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    function create($data) {

        $items['email'] = $data['email'];

        $items['user_id'] = $data['user_id'];


        $this->db->insert('emails', $items);
        return true;
    }

}
