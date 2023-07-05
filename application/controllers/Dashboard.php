<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('Logged_in') !== TRUE){
            redirect('signIn');
        }
        $this->load->model('My_Model','login');
    }

	public function index()
	{
        $data['result'] = $this->login->fetchProduct();
		$this->load->view('dashboard',$data);
	}

    public function bitHit(){
        $userId = $this->session->userdata('userid');
        $bid_limit = $this->session->userdata('bids');
        $hit = $this->input->post('hit');
        $price = $this->input->post('price');
        $product_id = $this->input->post('product_id');
        if(isset($hit)){
            $bid_limit = $bid_limit - 1;
            $this->session->set_userdata('bids', $bid_limit);
        }
        $userhitupdate = $this->login->hitUpdate($userId,$bid_limit);
        $priceChange = $this->login->changePrice($product_id,$price);
        if($userhitupdate && $priceChange){
            $vals = array('bid_limit'=>$bid_limit);
            echo json_encode($vals);
        }
    }

    public function getAll(){
        $data = $this->login->fetchProduct();
        echo json_encode($data); 
    }
}
