<?php

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
defined('BASEPATH') OR exit('No direct script access allowed');

class order extends CI_Model {

    var $table = "orders";
    var $select_column = array("idorder", "product_id", "user_id", "quantity", "units_of_measurement", "date", "received", "chipped", "idshippingaddress");
    var $order_column = array(null, "date", null, null);

    function __construct() {
        parent::__construct();
    }

    function get_by_id($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users');
        $result = $query->result();
        $query->free_result();
        if ($result) {
            return $result[0];
        } else {
            return null;
        }
    }

    function get_all_data() {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_filtered_data() {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function make_query() {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->like("date", $_POST["search"]["value"]);
            $this->db->or_like("user_id", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('idorder', 'DESC');
        }
    }

    function make_datatables() {
        $this->make_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();

    }

    function get() {
        $query = $this->db->get('orders');
        $result = $query->result();
        $query->free_result();
        if ($result) {
            foreach ($result as $value) {
                $this->load->model("user");
                $user = $this->user->get_by_id($_SESSION['user_id']);
                $this->load->model("shippingaddress");
                $obj3 = $this->shippingaddress->get_by_user($_SESSION['user_id']);
             //   $result['customer']
            }
            return $result[0];
        } else {
            return null;
        }
    }

    function create($data) {

        if (array_key_exists('id', $data)) {
            $items['product_id'] = $data['id'];
        }

        if (isset($_SESSION['user_logged'])) {
            $items['user_id'] = $_SESSION['user_id'];
        }

        $this->db->insert('orders', $items);
        return true;
    }

    function update($data, $id) {
        $items = array();
        if (array_key_exists('user_firstname', $data)) {
            $items['user_firstname'] = $data['user_firstname'];
        }
        if (array_key_exists('user_lastname', $data)) {
            $items['user_lastname'] = $data['user_lastname'];
        }
        if (array_key_exists('user_password', $data)) {
            $items['user_password'] = md5($data['user_password']);
        }
        $this->db->where('user_id', $id);
        $this->db->update('users', $items);
        return true;
    }

    function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
        return true;
    }

    function fetch_all() {
        $query = $this->db->get("product");
        return $query->result();
    }

}
