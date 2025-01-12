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

        $data = [
            'projectID' => $projectID,
            'projectName' => $projectName,
            'projectLocation' => $projectLocation,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'budget' => $budget,
            'budgetSource' => $budgetSource,
            'leaderID' => 1
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

    // View a project
    public function view($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID);
        $this->load->view('view_project', $data);
    }


    // Edit a project
    public function edit($projectID)
    {
        $data['project'] = $this->Project_model->get_project_by_id($projectID); // Get the project by its ID
        $this->load->view('edit_project', $data); // Load the edit form with the project data
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
}












