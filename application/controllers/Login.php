<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('My_Model','login');
    $this->form_validation->set_error_delimiters('<div class="error" color="red">', '</div>');
  }
	public function index()
	{
		$this->load->view('login');
	}

    public function check_login(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('name', 'name', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            
                $this->load->view('login');
        }
        else
        {
            $insert = array(
                'name'=>$this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'bid_qty' => 10,
            );
            $insertData = $this->login->addUser($insert);
            if($insertData != FALSE){
                $this->session->set_flashdata('msg-info', 'successfully ragister');
                redirect('Login/signin');
            }else{
                $this->session->set_flashdata('msg-danger', 'user not ragister');
                redirect('Login');
            }
        }
    }

    public function signIn(){
        $this->load->view('signin');
    }
     
    public function auth_login(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        }
        else{
            $username = $this->input->post('username');
            $pass = md5($this->input->post('password'));
            $check = $this->login->checkLogin($username,$pass);
            if($check != FALSE){
                $session_data = array(
                    'userid' => $check['user_id'],
                    'bids' => $check['bid_qty'],
                    'Logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('msg-danger','login crendital invalid');
                redirect('signIn');
            }
    }
 }

 public function logout(){
    $session_data = array(
        'userid' => '',
        'bids' => '',
        'Logged_in' => FALSE
    );
    $this->session->unset_userdata($session_data);
    $this->session->sess_destroy();
    $this->session->set_flashdata('msg-info','logout successfully');
    redirect('signIn');
 }
}
