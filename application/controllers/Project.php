<?php
class Project extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->model('Project_model');  // Load the Project model
    }

    public function dashboard()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard');
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
            'userID' =>  $userID
        ];

        $status = $this->Project_model->add($data);
        if ($status > 0) {
            redirect('dashboard/dashboard');
        }

    }


    // Fetch all projects and display them
    public function list()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $data['projects'] = $this->Project_model->get_all_projects(); // Fetch projects from the model
        $this->load->view('list_project', $data); // Load the view and pass the data
        $this->load->view('templates/footer');

    }


        public function view($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID);

        // Get only local community users
        $this->load->model('User_model');
        $data['users'] = $this->User_model->get_local_community_users();

        // Get invited members of the project
        $data['members'] = $this->Project_model->get_project_members($projectID);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('view_project', $data);
        $this->load->view('templates/footer');
    }

    public function Communityview($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID);

        // Get only local community users
        $this->load->model('User_model');
        $data['users'] = $this->User_model->get_local_community_users();

        // Get invited members of the project
        $data['members'] = $this->Project_model->get_project_members($projectID);

        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('community_view_project', $data);
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
    public function update() {
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

    // Project Leader Invite User
    public function invite_user() {
        $projectID = $this->input->post('projectID');
        $userID = $this->input->post('userID');
        
        // Assuming project leader is the logged-in user
        $leaderID = $this->session->userdata('userID'); // Get the logged-in user ID
        
        if ($userID && $projectID) {
            // Prepare data to store in the invitations table (or use another method to associate user with project)
            $data = [
                'projectID' => $projectID,
                'userID' => $userID,
                'invited_by' => $leaderID,  // Store the leader's userID who is inviting
                'status' => 'pending'  // Status could be 'pending', 'accepted', etc.
            ];
    
            // Call a method from the model to insert the invitation
            $this->Project_model->invite_user_to_project($data);
            
            // Redirect to the project view page after inviting
            redirect('project/view/' . $projectID);
        } else {
            // Handle the case where no user or project ID is provided
            $this->session->set_flashdata('error', 'Failed to invite user.');
            redirect('project/view/' . $projectID);
        }
    }


    // Project Leader Remove/Cancel Invitations
    public function cancel_invitation($memberID, $projectID)
    {
        $this->db->where('id', $memberID); // assuming 'id' is the primary key in projectMembers table
        $this->db->delete('projectMembers');
        
        $this->session->set_flashdata('message', 'Invitation cancelled successfully.');
        redirect('project/view/' . $projectID);
    }

    public function invitations() {
        $userID = $this->session->userdata('userID');
    
        $data['pending_invitations'] = $this->Project_model->get_pending_invitations_by_user($userID);
        
        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('invitations', $data);
        $this->load->view('templates/footer');
    }
    

    public function accept_invitation() {
        $userID = $this->session->userdata('userID');
        $projectID = $this->input->post('projectID');
    
        if ($userID && $projectID) {
            $this->Project_model->update_invitation_status($userID, $projectID, 'accepted');
            $this->session->set_flashdata('success', 'You have joined the project.');
        } else {
            $this->session->set_flashdata('error', 'Failed to accept invitation.');
        }
    
        redirect('project/my_projects'); // Redirect to list of joined projects
    }

    public function my_projects() {
        $userID = $this->session->userdata('userID');
        $data['projects'] = $this->Project_model->get_projects_by_user($userID);
    
        $this->load->view('templates/community_sidebar');
        $this->load->view('my_projects', $data);
        $this->load->view('templates/footer');
    }
    
    



    

    
    
    

}












