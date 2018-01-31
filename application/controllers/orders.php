<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orders
 *
 * @author raulh
 */
class orders extends CI_Controller {

//put your code here

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_logged'])) {
            $this->session->set_flashdata("error", "please login first to view this page");
            redirect("auth/login");
        }
    }

    function index() {
        $this->load->model("order");
        $data["product"] = $this->order->fetch_all();
      /*  $this->load->model("user");
        $user = $this->user->get_by_id($_SESSION['user_id']);
        $this->load->model("shippingaddress");
        $obj3 = $this->shippingaddress->get_by_user($_SESSION['user_id']);*/
        $this->load->view("orders", $data);
    }

    function orders_list() {
        $this->load->model("order");
        $data["orders"] = $this->order->get();
        $this->load->view("orders_list");
//   $this->load->view("orders_list");
    }

    function load_orders() {
       $this->load->model("order");
        $fetch_data = $this->order->make_datatables();
        $data = array();
//print_r("holaaaaa");
         
        foreach ($fetch_data as $row) {
            // obtain user--------
            $this->load->model("user");
            $temp1 = $_SESSION['user_id'];
            $obj1 = $this->user->get_by_id($temp1);
            // obtain product------
            $this->load->model("product");
            $temp = $row->product_id;
            $obj = $this->product->get_by_id($row->product_id);
            // obtain shippingaddress------
            $this->load->model("shippingaddress");
          //  print_r($row);
            $obj2 = $this->shippingaddress->get_by_id($row->idshippingaddress);

            $sub_array = array();

            $sub_array[] = '<img src="' . base_url() . 'images/' . $obj->product_image . '" class="img-thumbnail" width="50" height="35" />';
            $sub_array[] = $obj1->namecompany;
            if ($obj2) {
                 $sub_array[] = $obj2->shippingaddress;
            }else {$sub_array[] = 'test shipping adress';}
           
            $sub_array[] = $obj->product_name;
            $sub_array[] = $row->quantity;
            $sub_array[] = $row->units_of_measurement;  // rhp here test
            $sub_array[] = $row->date;
            $sub_array[] = $row->received;
            $sub_array[] = $row->chipped;
            $sub_array[] = '<button type="button" name="update" id="' . $row->idorder . '" class="btn btn-warning btn-xs">Update</button>';
            //  $sub_array[] = '<button type="button" name="delete" id="' . $row->id . '" class="btn btn-danger btn-xs">Delete</button>';
            $data[] = $sub_array;
         //   print_r($sub_array);
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->order->get_all_data(),
            "recordsFiltered" => $this->order->get_filtered_data(),
            "data" => $data
        );

      echo json_encode($output);
  /* echo '{"draw":1,"recordsTotal":9,"recordsFiltered":9,"data":[["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","Cooler 15 lb","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"51\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","Cooler 18 lb","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"50\" class=\"btn btn-warning btn-xs\">Update<\/button>"],["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","D Container","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"49\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","EH Cooler","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"48\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","D Container","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"47\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","Cooler 15 lb","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"46\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","Cooler 18 lb","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"45\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/FOAMCOOLER1.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","Cooler 30 lb","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"44\" class=\"btn btn-warning btn-xs\">Update<\/button>"],
["<img src=\"http:\/\/localhost\/ice\/images\/re-ice-service.jpg\" class=\"img-thumbnail\" width=\"50\" height=\"35\" \/>","f","test shipping adress","Re-ice Services","0","test units_of_measurement","2018-01-13 14:29:01","0","0","<button type=\"button\" name=\"update\" id=\"43\" class=\"btn btn-warning btn-xs\">Update<\/button>"]]}';
    */}

    function load() {
        echo $this->view();
    }

    function remove() {
        $this->load->library("cart");
        $row_id = $_POST["row_id"];
        $data = array(
            'rowid' => $row_id,
            'qty' => 0
        );
        $this->cart->update($data);
        echo $this->view();
    }

    function clear() {
        $this->load->library("cart");
        $this->cart->destroy();
        echo $this->view();
    }

    function add() {
        $this->load->library("cart");
        //   print_r($_POST["units_of_measurement"]);
        $data = array(
            "id" => $_POST["product_id"],
            "name" => $_POST["product_name"],
            "qty" => $_POST["quantity"],
            "price" => $_POST["product_price"],
            "units_of_measurement" => $_POST["units_of_measurement"],
        );
        $this->cart->insert($data); //return rowid 
        echo $this->view();
    }

    function add_order() {
        $this->load->model("order");
        $this->load->library("cart");
        foreach ($this->cart->contents() as $items) {
            $this->order->create($items);
        }
        $this->clear();
    }

    function view() {
        $this->load->library("cart");
        $output = '';
        $output .= '
  <h3>Shopping Cart</h3><br />
  <div class="table-responsive">
   <div align="right">
    <button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
    <button type="button" id="submit_order" class="btn btn-warning">Submit Drder</button>
   </div>
   <br />
   <table class="table table-bordered">
    <tr>
     <th width="40%">Name</th>
     <th width="15%">Quantity</th>
     <th width="15%">Price</th>
     <th width="15%">Total</th>
     <th width="15%">Action</th>
    </tr>

  ';
        $count = 0;
        foreach ($this->cart->contents() as $items) {
            $count++;
            $output .= '
   <tr> 
    <td>' . $items["name"] . '</td>
    <td>' . $items["qty"] . '</td>
    <td>' . $items["price"] . '</td>
    <td>' . $items["subtotal"] . '</td>
    <td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="' . $items["rowid"] . '">Remove</button></td>
   </tr>
   ';
        }
        $output .= '
   <tr>
    <td colspan="4" align="right">Total</td>
    <td>' . $this->cart->total() . '</td>
   </tr>
  </table>

  </div>
  ';

        if ($count == 0) {
            $output = '<h3 align="center">Cart is Empty</h3>';
        }
        return $output;
    }

    function fetch_single_order() {
        $output = array();
        $this->load->model("orders");
        $data = $this->crud_model->fetch_single_user($_POST["idorder"]);
        foreach ($data as $row) {
            $output['done'] = $row->done;
            if ($row->image != '') {
                $output['user_image'] = '<img src="' . base_url() . 'upload/' . $row->image . '" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="' . $row->image . '" />';
            } else {
                $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
            }
        }
        echo json_encode($output);
    }

}
