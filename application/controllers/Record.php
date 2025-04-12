<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Record_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Show all record by specific project
    public function index($projectID = null)
{
    if ($projectID === null) {
        show_404(); // Handle case where no project ID is provided
    }

    $data['records'] = $this->Record_model->get_records_by_project($projectID); // Get records for specific project

    // Load views
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('list_project_records', $data);
    $this->load->view('templates/footer');

}

    public function userList($projectID = null)
{
    if (!$projectID) {
        show_error("Project ID is required.", 400);
        return;
    }

    $userID = $this->session->userdata('userID');

    $this->load->model('Record_model');
    $data['records'] = $this->Record_model->get_records_by_user_and_project($userID, $projectID);

    $this->load->model('Project_model');
    $data['project'] = $this->Project_model->get_project_by_id($projectID);

    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('list_user_records', $data);
    $this->load->view('templates/footer');
}


    // Load create record form
    public function create($projectID = null) {
        $data['projectID'] = $projectID; // Pass projectID to the form
        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('create_record', $data);
        $this->load->view('templates/footer');
    }
    

    // Handle form submission
    public function store() {
        $data = array(
            'quantity' => $this->input->post('quantity'),
            'recordDate' => $this->input->post('recordDate'),
            'incomeGenerated' => $this->input->post('incomeGenerated'),
            'situation' => $this->input->post('situation'),
            'projectID' => $this->input->post('projectID'),
            'userID' => $this->session->userdata('userID')
        );
    
        $this->Record_model->insert_record($data);
        redirect('project/community_view/' . $this->input->post('projectID'));
    }
    

    // Load edit form
    public function edit($id) {
        $data['record'] = $this->Record_model->get_record_by_id($id);
        $this->load->view('edit_record', $data);
    }

    // Update record
    public function update($id) {
        $data = array(
            'quantity' => $this->input->post('quantity'),
            'recordDate' => $this->input->post('recordDate'),
            'incomeGenerated' => $this->input->post('incomeGenerated'),
            'situation' => $this->input->post('situation'),
           // 'projectID' => $this->input->post('projectID')
        );

        $this->Record_model->update_record($id, $data);
        redirect('record');
    }

    // Delete record
    public function delete($id) {
        $this->Record_model->delete_record($id);
        redirect('record');
    }


    public function userProjectRecord($userID, $projectID)
{
    $this->load->model('Project_model');

    $data['records'] = $this->Record_model->get_records_by_user_and_project($userID, $projectID);
    $data['project'] = $this->Project_model->get_project_by_id($projectID);
    $data['user'] = $this->User_model->get_user_by_id($userID); // Optional if you want to display user info

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar'); // or community_sidebar depending on role
    $this->load->view('list_user_project_record', $data);
    $this->load->view('templates/footer');
}


    // Controller method to view all records in a specific project (for project leaders)
    public function projectRecords($projectID) {
        // Load required models if not already loaded
        $this->load->model('Project_model');
        $this->load->model('Record_model'); // Ensure the model is loaded
    
        // Get project info
        $data['project'] = $this->Project_model->get_project_by_id($projectID);
    
        // Get all records for this project
        $data['record'] = $this->Record_model->get_record_by_project_id($projectID);
    
        // Load the view
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar'); // or project_leader_sidebar if you have one
        $this->load->view('list_project_records', $data); // you'll need to create this view
        $this->load->view('templates/footer');
    }



}
?>
