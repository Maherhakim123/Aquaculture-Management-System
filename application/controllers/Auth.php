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
	

	// public function validate_login() {
	// 	$userEmail = $this->input->post('userEmail');
	// 	$userPassword = $this->input->post('userPassword');
	
	// 	// Check credentials in the database
	// 	$this->load->model('Register_model');
	// 	$user = $this->Register_model->get_user_by_email($userEmail);
	
	// 	// Check if the user exists and verify the password
	// 	if ($user && $user->userPassword == $userPassword) {
	// 		// Store user data in the session
	// 		$session_data = [
	// 			'logged_in' => true,
	// 			'userID' => $user->userID,      // Assuming `userID` is the primary key in your `users` table
	// 			'userName' => $user->userName, // Other user details you want to store
	// 			//'userRole' => $user->userRole // Store user role in session
	// 		];
	// 		$this->session->set_userdata($session_data);
	
	// 		// Redirect to dashboard
	// 		redirect('dashboard/dashboard');
	// 	} else {
	// 		// Handle invalid credentials
	// 		$this->session->set_flashdata('error', 'Invalid email or password.');
	// 		redirect('auth/login');
	// 	}
	// }

	public function validate_login() {
		$userEmail = $this->input->post('userEmail');
		$userPassword = $this->input->post('userPassword');
	
		// Check credentials in the database
		$this->load->model('Register_model');
		$user = $this->Register_model->get_user_by_email($userEmail);
	
		// Check if the user exists and verify the password
		if ($user && $user->userPassword == $userPassword) {
			// Store user data in the session
			$session_data = [
				'logged_in' => true,
				'userID' => $user->userID,      
				'userName' => $user->userName, 
				'userRole' => $user->userRole  // Store user role in session
			];
			$this->session->set_userdata($session_data);
	
			// Redirect to dashboard
			redirect('dashboard/dashboard');
		} else {
			// Handle invalid credentials
			$this->session->set_flashdata('error', 'Invalid email or password.');
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

	// public function dashboard() {
	// 	// Check if the user is logged in
	// 	if (!$this->session->userdata('logged_in')) {
	// 		redirect('auth/login');
	// 	}
	
	// 	// Get user role from session
	// 	$userRole = $this->session->userdata('userRole');
	
	// 	// Load different sidebars based on role
	// 	if ($userRole == 'Project Leader') {
	// 		$this->load->view('templates/sidebar');
	// 	} else {
	// 		$this->load->view('templates/community_sidebar');
	// 	}
	
	// 	// Load dashboard content
	// 	$this->load->view('dashboard');
	// }

	public function login(){
		$this->load->view('login');
	}

	public function sidebar(){
		$this->load->view('sidebar');
	}


}
