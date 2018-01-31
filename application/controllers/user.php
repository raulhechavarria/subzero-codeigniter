<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class user extends CI_Controller
{
    
    public function __construct() 
    {
        parent::__construct();
        if (!isset($_SESSION['user_logged'])) {
            $this->session->set_flashdata("error", "please login first to view this page");
            redirect("auth/login");
            }
    }
        
    public function profile()
    {
        $this->load->view('login'); 
    }
}
