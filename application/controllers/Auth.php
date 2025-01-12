<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->model('Register_model'); // Load your models
    }

	public function register()
	{
		$this->load->view('register');

	}

	public function add(){
		$leaderName = $this->input->post('leaderName');
		$leaderEmail = $this->input->post('leaderEmail');
		$leaderPassword = $this->input->post('leaderPassword');
		$leaderPhoneNo = $this->input->post('leaderPhoneNo');
		$department = $this->input->post('department');
		$majorExpertise = $this->input->post('majorExpertise');

		$data = [
			'leaderName' => $leaderName,
			'leaderEmail' => $leaderEmail,
			'leaderPassword' => $leaderPassword,
			'leaderPhoneNo' => $leaderPhoneNo,
			'department' => $department,
			'majorExpertise' => $majorExpertise
		];

		$status = $this->Register_model->add($data);
		if ($status>0){
			redirect('auth/login');
		}
	}

	public function validate_login() {
		$leaderEmail = $this->input->post('leaderEmail');
		$leaderPassword = $this->input->post('leaderPassword');

		//Check credentials in database
		$this->load->model('Register_model');
		$user = $this->Register_model->get_user_by_email($leaderEmail);


		if ($user->leaderPassword == $leaderPassword) {
			// Store user session
			$this->session->set_userdata([
				'logged_in' => true,
				'user_id' => $user->id,
				'user_name' => $user->leaderName
			]);
			redirect('dashboard/dashboard');
		} else {
			// Redirect back with error message
			$this->session->set_flashdata('error', 'Invalid email or password');
			redirect('auth/login');
		}
	}

	public function dashboard()
	{

		//Check either the user is logged in 
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}

		$data['user_name'] = $this->session->userdata('user_name');
		$this->load->view('dashboard', $data);
	
	}

	









	public function login(){
		$this->load->view('login');
	}

	public function sidebar(){
		$this->load->view('sidebar');
	}


}
