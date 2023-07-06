<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('Logged_in') !== TRUE){
            redirect('signIn');
        }
        $this->load->model('Data_table','table');
    }

	public function index()
	{
        $data['result'] = $this->table->fetchcity();
		$this->load->view('table',$data);
	}
    public function getAll(){
        $result = $this->table->get_datatables();
        $data = array();

        foreach($result as $row)
        {
         $sub_array = array();
         $sub_array[] = $row['CustomerName'];
         $sub_array[] = $row['Gender'];
         $sub_array[] = $row['Address'];
         $sub_array[] = $row['City'];
         $sub_array[] = $row['PostalCode'];
         $sub_array[] = $row['Country'];
         $data[] = $sub_array;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->table->count_all(),
            "recordsFiltered" =>$this->table->count_filtered(),
            "data" => $data
        );
        // $output = array(
        //  "draw"       =>  intval($_POST["draw"]),
        //  "recordsTotal"   =>  $this->table->count_all_data(),
        //  "recordsFiltered"  =>  $number_filter_row,
        //  "data"       =>  $data
        // );
        // //$_POST['start'];
        // echo "<pre>";print_r($list);"</pre>";die;
        echo json_encode($output); 
    }
    
}
