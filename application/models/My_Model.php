<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Model extends CI_MOdel {

    public function fetchProduct(){
        $this->db->select('*');
        $this->db->from('product');
        $query = $this->db->get();
        return $query->result();
    }

    public function addUser($data){
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }

    public function checkLogin($username,$pass){
        $where = array('username'=>$username, 'password'=>$pass, 'status'=> 1);
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function hitUpdate($user,$bid_limit){
        $hit = array('bid_qty' => $bid_limit);
        $this->db->where('user_id',$user);
        $this->db->update('user',$hit);
        return true;
    }

    public function changePrice($product_id,$price){
        $hit = array('price' => $price);
        $this->db->where('id',$product_id);
        $this->db->update('product',$hit);
        return true;
    }
}
