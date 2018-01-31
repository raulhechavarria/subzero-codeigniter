<?php

class Auth extends CI_Controller {

    function add_email() {
        $this->load->model("email");
        //   print_r($_POST["units_of_measurement"]);
        $data = array(
            //    "id" => $_POST["product_id"],
            "email" => $_POST["email"],
        );
        $this->email->insert($data); //return rowid 
        //  echo $this->view();
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        if ($this->form_validation->run() == TRUE) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            // check user in data base
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(array('user_login' => $username, 'user_password' => $password));
            $query = $this->db->get();

            $user = $query->row();
            if ($user->user_login) {    
                // temporal message
                $this->session->set_flashdata("success", "you are logged in");
                // set session variable
                echo $user->user_login;
                $_SESSION['user_logged'] = TRUE;
                $_SESSION['username'] = $user->user_login;
                $_SESSION['user_id'] = $user->user_id;
                // redirect to profile page
                redirect("orders", "refresh");
            } else {
                $this->session->set_flashdata("error", "No such account exists in data base");
                redirect("auth/login", "refresh");
            }
        }
        $this->load->view('login');
    }

    public function register() {
        if (isset($_POST['register'])) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            // $this ->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('addresscompany', 'addresscompany', 'required');
            $this->form_validation->set_rules('namecompany', 'namecompany', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('password', 'Confirm Password', 'required|min_length[5]|matches[password]');

            if ($this->form_validation->run() == TRUE) {
                // echo 'form validated';
                $data = array(
                    'user_login' => $_POST['username'],
                    'addresscompany' => $_POST['addresscompany'],
                    'namecompany' => $_POST['namecompany'],
                    //   'email'=>$_POST['email'],  
                    'user_password' => md5($_POST['password']),
                );
                $this->db->insert('users', $data);
                $last_id = $this->db->insert_id();

                $phones = $_POST['phone'];
               // print_r($email);
               //  echo '--------';
                $this->load->model("phone");
                foreach ($phones as $items) {
                  //  print_r($items);
                    $items['user_id'] = $last_id;
                    $this->phone->create($items);
                }
                
                $email = $_POST['email'];
            //     print_r($email);
              //   echo '--------';
                $this->load->model("email");
                foreach ($email as $items1) {
                    $items1['user_id'] = $last_id;
                    $this->email->create($items1);
                }
                
                $shippingaddress = $_POST['shippingaddress'];
                $this->load->model("shippingaddress");
                foreach ($shippingaddress as $items2) {
                    $this->shippingaddress->create($items2,$last_id);
                }

                $this->session->set_flashdata("success", "Your account has been register");
                redirect("auth/register", "refresh");
            }
        }
        $this->load->view('register');
    }

}
