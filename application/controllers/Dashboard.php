<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Register_model'); // Load the user model
		$this->load->model('Project_model');
        $this->load->library('session'); // Load session library
    }

	// ADMIN PPJIM Dashboard
	public function PPJIM_Dashboard() {

    // Ensure only Admin PPJIM can access
    $this->session->userdata('userRole') !== 'Admin PPJIM';

    // Load the dashboard view for Admin PPJIM
	$this->load->view('templates/header');
	$this->load->view('templates/PPJIM_sidebar'); // Project leader sidebar
    $this->load->view('PPJIM_Dashboard');
	$this->load->view('templates/footer');
}



	// For Project Leaders count all the projects
	public function dashboard() {
		$userID = $this->session->userdata('userID');

		$data['project_count'] = $this->Project_model->count_projects_by_leader($userID);
		$data['in_progress_projects'] = $this->Project_model->count_in_progress_projects($userID);
    	$data['completed_projects'] = $this->Project_model->count_completed_projects($userID);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar'); // Project leader sidebar
		$this->load->view('dashboard', $data);  // Project leader dashboard
		$this->load->view('templates/footer');
	}

	


    // For Project Leaders count only projects


	// For Beneficiaries
	public function beneficiary_dashboard() {
		$userID = $this->session->userdata('userID');
        $data['project_count'] = $this->Project_model->count_projects_by_member($userID);

		$this->load->model('Project_model');

     	// Get the number of projects this beneficiary is involved in
    	$project_count = $this->Project_model->count_projects_by_user($userID);

    	$data['project_count'] = $project_count;

		$this->load->view('templates/header');
		$this->load->view('templates/community_sidebar'); // Community member sidebar
		$this->load->view('beneficiary_dashboard' , $data);// Community dashboard view
		$this->load->view('templates/footer');
	}
	
	

	public function homepage(){
		$this->load->view('HOMEPAGE');
	}


	public function profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
		$userRole = $this->session->userdata('userRole');
		$data['users'] = $this->Register_model->get_user_by_id($userID);
		
	
		$this->load->view('templates/header');
	
		if ($userRole === 'Project Leader') {
			$this->load->view('templates/sidebar');
		} else {
			$this->load->view('templates/community_sidebar');
		}
	
		$this->load->view('view_profile', $data);
		$this->load->view('templates/footer');
	}
	

	public function edit_profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
		$userRole = $this->session->userdata('userRole');
		$data['user'] = $this->Register_model->get_user_by_id($userID);
	
		$this->load->view('templates/header');
		if ($userRole === 'Project Leader') {
			$this->load->view('templates/sidebar');
		} else {
			$this->load->view('templates/community_sidebar');
		}
		$this->load->view('edit_profile', $data);
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
