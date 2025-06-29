<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
		$this->load->model('Project_model');
		$this->load->model('User_model');
		$this->load->model('Phase_model');
   		$this->load->model('Activity_model');
        $this->load->library('session'); // Load session library
    }

// ADMIN PPJIM Dashboard
public function PPJIM_Dashboard() {
    // Ensure only Admin PPJIM can access
    if ($this->session->userdata('userRole') !== 'Admin PPJIM') {
        redirect('auth/login'); // or show 403
    }

    // Count all projects
    $data['project_count'] = $this->Project_model->count_all_projects();

    // Get all projects and calculate in-progress and completed
    $projects = $this->Project_model->get_all_projects();
    $inProgress = 0;
    $completed = 0;

    foreach ($projects as $project) {
        $phases = $this->Phase_model->get_phases_by_project($project->projectID);

        if (empty($phases)) {
            continue;
        }

        $all_completed = true;

        foreach ($phases as $phase) {
            $totalActivities = $this->Activity_model->countActivitiesByPhase($phase->phaseID);
            $completedActivities = $this->Activity_model->countCompletedActivitiesByPhase($phase->phaseID);
            $progress = ($totalActivities > 0) ? round(($completedActivities / $totalActivities) * 100) : 0;

            if ($progress < 100) {
                $all_completed = false;
                break;
            }
        }

        if ($all_completed) {
            $completed++;
        } else {
            $inProgress++;
        }
    }

    $data['in_progress_projects'] = $inProgress;
    $data['completed_projects'] = $completed;

	// Pass the projects list to view
	$data['projects'] = $projects;

    // Count users except Admins
    $data['user_count'] = $this->User_model->count_all_users(); // Ensure this excludes Admins in your model

    // Load views
    $this->load->view('templates/header');
	$this->load->view('templates/PPJIM_sidebar'); 
    $this->load->view('PPJIM_Dashboard', $data);
    $this->load->view('templates/footer');
}


	// ADMIN PPJIM View list all users
	public function list_users() {

    // Get all users
    $data['users'] = $this->User_model->get_all_users();

    // Load view
	$this->load->view('templates/header');
	$this->load->view('templates/PPJIM_sidebar'); 
	$this->load->view('PPJIM_list_users', $data);
	$this->load->view('templates/footer');
}

	// ADMIN PPJIM View list all users
	public function delete_user($userID) {

    if ($this->User_model->delete_user($userID)) {
        $this->session->set_flashdata('success', 'User deleted successfully.');
    } else {
        $this->session->set_flashdata('error', 'Failed to delete user.');
    }

    redirect('dashboard/list_users'); 
}

	// For Project Leaders count all the projects
	public function dashboard() {
		$userID = $this->session->userdata('userID');

		$data['project_count'] = $this->Project_model->count_projects_by_leader($userID);
		$data['in_progress_projects'] = $this->Project_model->count_in_progress_projects($userID);
    	$data['completed_projects'] = $this->Project_model->count_completed_projects($userID);

		

		$events = [];

		$projects = $this->Project_model->get_projects_by_leader($userID);
		// Pass the projects list to view
		$data['projects'] = $projects;

		foreach ($projects as $project) {
			$phases = $this->Phase_model->get_phases_by_project($project->projectID);

			foreach ($phases as $phase) {
				$events[] = [
					'phaseName' => $phase->phaseName,
					'startDate' => $phase->startDate,
					'deadline' => $phase->deadline,
					'backgroundColor' => '#007bff',
					'borderColor' => '#007bff'
				];
			}
		}

		$projectList = [];
		foreach ($projects as $project) {
			$projectList[] = [
				'projectID' => $project->projectID,
				'projectName' => $project->projectName,
				'startDate' => $project->startDate, 
				'endDate'   => $project->endDate     
			];
		}

		$data['project_list'] = json_encode($projectList); // Pass to view as JSON


		$data['calendar_events'] = json_encode($events); // pass to view


		$this->load->view('templates/header');
		$this->load->view('templates/sidebar'); // Project leader sidebar
		$this->load->view('dashboard', $data);  // Project leader dashboard
		$this->load->view('templates/footer');
	}


	// For Beneficiaries
// 	public function beneficiary_dashboard()
// {
//     $userID = $this->session->userdata('userID');
//     $data['projects'] = $this->Project_model->get_projects_by_user($userID);
//     $data['project_count'] = count($data['projects']); 

//     $this->load->view('templates/header');
//     $this->load->view('templates/community_sidebar');
//     $this->load->view('beneficiary_dashboard', $data);
//     $this->load->view('templates/footer');
// }


	public function beneficiary_dashboard()
{


    $userID = $this->session->userdata('userID');

    // Load only the user's projects
    $data['projects'] = $this->Project_model->get_projects_by_user($userID);
	$data['project_count'] = count($data['projects']); 

    $projectID = $this->input->get('projectID');
    $data['selectedProjectID'] = $projectID;

    if ($projectID) {
        $phases = $this->Phase_model->get_phase($projectID);
        $progressData = [];

        foreach ($phases as $phase) {
            $activities = $this->Activity_model->getActivitiesByPhase($phase->phaseID); // returns as array
            $progressData[] = [
                'phase' => $phase,
                'activities' => $activities
            ];
        }

        $data['progressData'] = $progressData;
    } else {
        $data['progressData'] = [];
    }

    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('beneficiary_dashboard', $data);
    $this->load->view('templates/footer');
}

	// For Beneficiaries
	public function get_project_activities()
{
    $this->load->model('Phase_model');
    $this->load->model('Activity_model');

    $projectID = $this->input->get('projectID');
    if (!$projectID) {
        echo "<p>No project selected.</p>";
        return;
    }

    $phases = $this->Phase_model->get_phase($projectID);
    $progressData = [];

    foreach ($phases as $phase) {
        $activities = $this->Activity_model->getActivitiesByPhase($phase->phaseID); // must return array
        $progressData[] = [
            'phase' => $phase,
            'activities' => $activities
        ];
    }

    if (empty($progressData)) {
        echo "<p>No activities found for this project.</p>";
        return;
    }

    // Start building the HTML
    $output = '<div class="table-responsive">';
    $output .= '<table class="table table-bordered">';
    $output .= '<thead class="thead-dark"><tr><th>Phase</th><th>Activity</th><th>Messages</th></tr></thead>';
    $output .= '<tbody>';

    foreach ($progressData as $entry) {
        $activities = $entry['activities'];
        $count = count($activities);
        $i = 0;
        foreach ($activities as $activity) {
            $output .= '<tr>';
            if ($i === 0) {
                $output .= '<td rowspan="' . $count . '">' . htmlspecialchars($entry['phase']->phaseName) . '</td>';
            }

            $output .= '<td>' . htmlspecialchars($activity['activityType']) . ' - ' . htmlspecialchars($activity['activityName']) . '</td>';
            $output .= '<td><a href="' . base_url('activity/beneficiary_view_comment/' . $activity['activityID']) . '" class="btn btn-sm btn-info">Messages</a></td>';
            $output .= '</tr>';

            $i++;
        }
    }

    $output .= '</tbody></table></div>';

    echo $output;
}




	
	

	public function homepage(){
		$this->load->view('HOMEPAGE');
	}


	// Project Leader Profile
	public function profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
		$userRole = $this->session->userdata('userRole');
		$data['users'] = $this->Register_model->get_user_by_id($userID);
		
	
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('view_profile', $data);
		$this->load->view('templates/footer');
	}

	// Beneficiary Profile
	public function Beneficiary_profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
		$userRole = $this->session->userdata('userRole');
		$data['users'] = $this->Register_model->get_user_by_id($userID);
		
	
		$this->load->view('templates/header');
		$this->load->view('templates/community_sidebar');
		$this->load->view('view_profile', $data);
		$this->load->view('templates/footer');
	}

	// Admin PPJIM Profile
	public function PPJIM_profile() {
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	
		$userID = $this->session->userdata('userID');
		$userRole = $this->session->userdata('userRole');
		$data['users'] = $this->Register_model->get_user_by_id($userID);
		
	
		$this->load->view('templates/header');
		$this->load->view('templates/PPJIM_sidebar');
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
