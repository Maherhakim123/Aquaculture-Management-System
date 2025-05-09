<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->model('Register_model'); // Load models
    }

	public function register()
	{
		$this->load->view('register');

	}

	public function add(){
		$userName = $this->input->post('userName');
		$userEmail = $this->input->post('userEmail');
		$userPassword = $this->input->post('userPassword');
		$userIC = $this->input->post('userIC');
		$userPhoneNo = $this->input->post('userPhoneNo');
		$userRole = $this->input->post('userRole');

		$data = [
			'userName' => $userName,
			'userEmail' => $userEmail,
			'userPassword' => $userPassword,
			'userIC' => $userIC,
			'userPhoneNo' => $userPhoneNo,
			'userRole' => $userRole
		];

		$status = $this->Register_model->add($data);
		if ($status>0){
			redirect('auth/login');
		}
	}
	

	public function validate_login() {
		$userEmail = $this->input->post('userEmail');
		$userPassword = $this->input->post('userPassword');
	
		$this->load->model('Register_model');
		$user = $this->Register_model->get_user_by_email($userEmail);
	
		if ($user && $user->userPassword == $userPassword) {
			$session_data = [
				'logged_in' => true,
				'userID' => $user->userID,
				'userName' => $user->userName,
				'userRole' => $user->userRole
			];
			$this->session->set_userdata($session_data);
	
			// Redirect based on role
			if ($user->userRole == 'Project Leader') {
				redirect('dashboard/dashboard');
			} else {
				redirect('dashboard/beneficiary_dashboard');
			}
		} else {
			$this->session->set_flashdata('error', 'Invalid email or password.');
			redirect('auth/login');
		}
	}
	


	public function login(){
		$this->load->view('login');
	}

	public function sidebar(){
		$this->load->view('sidebar');
	}


}
