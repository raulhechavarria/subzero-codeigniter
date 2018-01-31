<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of phone
 *
 * @author raulh
 */
class phone extends CI_Model{
    //put your code here
    
    function __construct()
    {
      parent::__construct();	 
    }
    
    function create($data) {

            $items['number'] = $data['number'];
        

      
              $items['user_id'] = $data['user_id'];
       

        $this->db->insert('phones', $items);
        return true;
    }
}
