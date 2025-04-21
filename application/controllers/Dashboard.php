<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Register_model'); // Load the user model
		$this->load->model('Project_model');
        $this->load->library('session'); // Load session library
    }


	// public function dashboard() {
	// 	// Check if the user is logged in
	// 	if (!$this->session->userdata('logged_in')) {
	// 		redirect('auth/login');
	// 	}
	
	// 	// Get user role from session
	// 	$userRole = $this->session->userdata('userRole');
	
	// 	// Load header
	// 	$this->load->view('templates/header');
	
	// 	// Load sidebar based on user role
	// 	if ($userRole == 'Project Leader') {
	// 		$this->load->view('templates/sidebar');  // Sidebar for Project Leader
	// 	} else {
	// 		$this->load->view('templates/community_sidebar');  // Sidebar for Community Member
	// 	}
	
	// 	// Load main dashboard content
	// 	$this->load->view('dashboard');
	
	// 	// Load footer
	// 	$this->load->view('templates/footer');
	// }


	
	public function dashboard() {
		// Check if the user is logged in
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		// Get user role from session
		$userRole = $this->session->userdata('userRole');
		$userID = $this->session->userdata('userID');
		$data['project_count'] = $this->Project_model->count_projects_by_leader($userID);

	
		// Load header
		$this->load->view('templates/header');
	
		// Load sidebar based on user role
		if ($userRole == 'Project Leader') {
			$this->load->view('templates/sidebar');  // Sidebar for Project Leader
		} else {
			$this->load->view('templates/community_sidebar');  // Sidebar for Community Member
		}
	
		// Load main dashboard content
		$this->load->view('dashboard', $data);	
		// Load footer
		$this->load->view('templates/footer');
	}
	

	public function homepage(){
		$this->load->view('HOMEPAGE');
	}


    public function profile() {
        // Ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Fetch the logged-in user's ID from session
        $userID = $this->session->userdata('userID');

        // Debug: Check if userID exists
        if (!$userID) {
            echo "Error: UserID not found in session.";
            exit;
        }

        // Fetch user details from the database
        $data['users'] = $this->Register_model->get_user_by_id($userID);

        // Debug: Check if user details exist
        if (!$data['users']) {
            echo "Error: No user found in the database for userID: " . $userID;
            exit;
        }

        // Load the profile view with user data
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('view_profile', $data);
        $this->load->view('templates/footer');
    }

	public function edit_profile() {
		// Ensure the user is logged in
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
		$data['user'] = $this->Register_model->get_user_by_id($userID); // Fetch user data
	
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('edit_profile', $data); // Load the edit profile view
		$this->load->view('templates/footer');
	}
	
	public function update_profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
	
		// Get updated data from the form
		$data = [
			'userName' => $this->input->post('userName'),
			'userEmail' => $this->input->post('userEmail'),
			'userIC' => $this->input->post('userIC'),
			'userPhoneNo' => $this->input->post('userPhoneNo'),
			'userRole' => $this->input->post('userRole'),
		];
	
		// Update user details in the database
		$this->Register_model->update_user($userID, $data);
	
		// Redirect to profile page
		$this->session->set_flashdata('success', 'Profile updated successfully.');
		redirect('dashboard/profile');
	}

	public function delete_profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
	
		// Delete user from the database
		$this->Register_model->delete_user($userID);
	
		// Clear session and redirect to login
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Your profile has been deleted.');
		redirect('auth/login');
	}
	

}
