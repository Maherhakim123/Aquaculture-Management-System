<?php
class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->model('Project_model');  // Load the Project model
        $this->load->model('Phase_model');
        $this->load->model('Activity_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }



    public function dashboard()
{
    $userID = $this->session->userdata('userID'); // Get logged in user's ID
    $data['project_count'] = $this->Project_model->count_projects_by_leader($userID); // Fetch project count

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('dashboard', $data); 
    $this->load->view('templates/footer');
}


public function beneficiary_dashboard()
{
    $userID = $this->session->userdata('userID'); // Get logged in user's ID

    $this->load->model('Project_model');

     // Get the number of projects this beneficiary is involved in
    $project_count = $this->Project_model->count_projects_by_user($userID);

    $data['project_count'] = $project_count;


    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('beneficiary_dashboard', $data); 
    $this->load->view('templates/footer');
}


    // Display the form to create a new project
    public function create()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('create_project');
        $this->load->view('templates/footer');
    }

    // Handle the form submission to create a new project
    public function add()
    {
        $projectID = $this->input->post('projectID');
        $projectName = $this->input->post('projectName');
        $projectLocation = $this->input->post('projectLocation');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $budget = $this->input->post('budget');
        $budgetSource = $this->input->post('budgetSource');

        $userID = $this->session->userdata('userID');

        $data = [
            'projectID' => $projectID,
            'projectName' => $projectName,
            'projectLocation' => $projectLocation,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'budget' => $budget,
            'budgetSource' => $budgetSource,
            'userID' => $userID
        ];

        $status = $this->Project_model->add($data);
        if ($status > 0) {
            redirect('dashboard/dashboard');
        }
    }

    // List all project for Admin PPJIM
    public function listAll_Project() {
        $userID = $this->session->userdata('userID');
        $data['projects'] = $this->Project_model->get_all_projects(); // Fetch projects from the model
        $this->load->view('templates/header');
        $this->load->view('templates/PPJIM_sidebar');
        $this->load->view('PPJIM_list_project', $data); // Load the view and pass the data
        $this->load->view('templates/footer');

    }


    // Fetch all projects and display them by specif project leader
    public function list()
    {
        $userID = $this->session->userdata('userID');
        $data['projects'] = $this->Project_model->get_projects_by_leader($userID); // Fetch projects from the model
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('list_project', $data); // Load the view and pass the data
        $this->load->view('templates/footer');
    }


    // Admin PPJIM View Project
    public function PPJIM_view_project($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID);

        // Get only Beneficiaries users
        $this->load->model('User_model');
        $data['users'] = $this->User_model->get_beneficiary_users();

        // Get invited members of the project
        $data['members'] = $this->Project_model->get_project_members($projectID);

        $invitedUserIDs = array_map(function($member) {
            return $member->userID;
        }, $data['members']);

        $data['users'] = array_filter(
            $this->User_model->get_beneficiary_users(),
            fn($user) => !in_array($user->userID, $invitedUserIDs)
    );

        $data['projectID'] = $projectID;
        
    // Add this to get total spending from comments
        $data['totalSpent'] = $this->Activity_model->get_total_spending_by_project($projectID);

        //data phase in view project
        $data['phases'] = $this->Phase_model->get_phases_with_progress($projectID);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('PPJIM_view_project', $data);
        $this->load->view('templates/footer');
    }



    // Project Leader View Project
    public function view($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID);

        // Get only Beneficiaries users
        $this->load->model('User_model');
        $data['users'] = $this->User_model->get_beneficiary_users();

        // Get invited members of the project
        $data['members'] = $this->Project_model->get_project_members($projectID);

        $invitedUserIDs = array_map(function($member) {
            return $member->userID;
        }, $data['members']);

        $data['users'] = array_filter(
            $this->User_model->get_beneficiary_users(),
            fn($user) => !in_array($user->userID, $invitedUserIDs)
    );

        $data['projectID'] = $projectID;
        
    // Add this to get total spending from comments
        $data['totalSpent'] = $this->Activity_model->get_total_spending_by_project($projectID);

        //data phase in view project
        $data['phases'] = $this->Phase_model->get_phases_with_progress($projectID);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('view_project', $data);
        $this->load->view('templates/footer');
    }




    // Edit a project
    public function edit($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID); // Get the project by its ID
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('edit_project', $data); // Load the edit form with the project data
        $this->load->view('templates/footer');
    }

    // Update project
    public function update()
    {
        $projectID = $this->input->post('projectID'); // Get project ID from hidden input
        $projectName = $this->input->post('projectName');
        $projectLocation = $this->input->post('projectLocation');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $budget = $this->input->post('budget');
        $budgetSource = $this->input->post('budgetSource');

        $data = [
            'projectName' => $projectName,
            'projectLocation' => $projectLocation,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'budget' => $budget,
            'budgetSource' => $budgetSource
        ];

        $status = $this->Project_model->update_project($projectID, $data);
        if ($status) {
            redirect('project/list'); // Redirect to project list after update
        }
    }

    // Delete a project
    public function delete($projectID)
    {
        $status = $this->Project_model->delete_project($projectID);
        if ($status) {
            redirect('project/list'); // Redirect to project list after delete
        }
    }

 

    public function invite_user()
    {
    $projectID = $this->input->post('projectID');
    $userID = $this->input->post('userID');
    $leaderID = $this->session->userdata('userID');

    if ($userID && $projectID) {
        // Check if user already invited to the project
        $alreadyInvited = $this->Project_model->is_user_already_invited($projectID, $userID);

        if ($alreadyInvited) {
            $this->session->set_flashdata('error', 'User has already been invited to this project.');
        } else {
            $data = [
                'projectID' => $projectID,
                'userID' => $userID,
                'invited_by' => $leaderID,
                'status' => 'pending'
            ];

            $this->Project_model->invite_user_to_project($data);
            $this->session->set_flashdata('success', 'User invited successfully.');
        }
    } else {
        $this->session->set_flashdata('error', 'Failed to invite user.');
    }

    redirect('project/view/' . $projectID);
}

    // View invitations for the current local community user
    public function invitations()
    {
        $userID = $this->session->userdata('userID');
        $data['pending_invitations'] = $this->Project_model->get_pending_invitations_by_user($userID);

        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('invitations', $data);
        $this->load->view('templates/footer');
    }

    // Accept invitation
    public function accept_invitation()
    {
        $userID = $this->session->userdata('userID');
        $projectID = $this->input->post('projectID');

        if ($userID && $projectID) {
            $this->Project_model->update_invitation_status($userID, $projectID, 'accepted');
            $this->session->set_flashdata('success', 'You have joined the project.');
        } else {
            $this->session->set_flashdata('error', 'Failed to accept invitation.');
        }

        redirect('project/my_projects');
    }

    // Show projects that the community user has accepted
    public function my_projects()
    {
        $userID = $this->session->userdata('userID');
        $data['projects'] = $this->Project_model->get_projects_by_user($userID);
        
        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('my_projects', $data);
        $this->load->view('templates/footer');
        
    }

    public function community_view($projectID)
{
    // Load your model if not already loaded
    $this->load->model('Project_model');
    $this->load->model('Phase_model');

    // Get project by ID
    $data['project'] = $this->Project_model->get_project_by_id($projectID);
    $data['phaseIDForComment'] = $this->Phase_model->get_first_phase_id($projectID);

    // Load the view
    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('community_view_project', $data);
    $this->load->view('templates/footer');
}


// Project leader remove member project has been invited
public function remove_member($projectID, $userID)
{
    $this->load->model('Project_model');
    $this->Project_model->remove_project_member($projectID, $userID);

    // Redirect back to the project view
    redirect('project/view/' . $projectID);
}


// Project leader cancels a pending invitation
public function cancel_invitation($projectID, $userID)
{
    $this->load->model('Project_model');
    $this->Project_model->remove_project_member($projectID, $userID);

    // Redirect back to the project view
    redirect('project/view/' . $projectID);
}

// Beneficiary reject a pending invitation
public function reject_invitation($projectID, $userID)
{
    $this->load->model('Project_model');
    $this->Project_model->remove_project_member($projectID, $userID);

    // Redirect back to the project view
    redirect('project/invitations');

}


}
