<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Record_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Show all record
    public function index() {
        $data['records'] = $this->Record_model->get_all_records_userID(); // Fetch all records

        // Load the view and pass the data
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('list_ALLrecord', $data);
    }

    

    
    //show the record by specific user
    // public function userList() {
    //     $userID = $this->session->userdata('userID');
    
    //     // Fetch user records
    //     $data['records'] = $this->Record_model->get_record_by_user_id($userID);
    
    //     // Get the project info (assumes all records belong to one project)
    //     if (!empty($data['records'])) {
    //         $projectID = $data['records'][0]['projectID'];
    //         $this->load->model('Project_model');
    //         $data['project'] = $this->Project_model->get_project_by_id($projectID);
    //     } else {
    //         $data['project'] = null;
    //     }
    
    //     // Load the view
    //     $this->load->view('templates/header');
    //     $this->load->view('templates/community_sidebar');
    //     $this->load->view('list_record', $data);
    //     $this->load->view('templates/footer');
    // }

    public function userList() {
        $userID = $this->session->userdata('userID');
        $role = $this->session->userdata('userRole'); // assuming this is set at login
    
        $this->load->model('Project_model');
    
        // If the user is a project leader
        if ($role === 'project_leader') {
            // You might want to retrieve all projects the leader is in charge of
            $projects = $this->Project_model->get_projects_by_leader($userID); // You need to implement this method
            $data['projects'] = $projects;
    
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('leader_project_list', $data); // you can show all projects and link to view records per project
            $this->load->view('templates/footer');
    
        } else {
            // Community member - show only their own records
            $data['records'] = $this->Record_model->get_record_by_user_id($userID);
    
            if (!empty($data['records'])) {
                $projectID = $data['records'][0]['projectID'];
                $data['project'] = $this->Project_model->get_project_by_id($projectID);
            } else {
                $data['project'] = null;
            }
    
            $this->load->view('templates/header');
            $this->load->view('templates/community_sidebar');
            $this->load->view('list_record', $data);
            $this->load->view('templates/footer');
        }
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
        redirect('record/userList');
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
