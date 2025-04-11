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
        $data['records'] = $this->Record_model->get_all_records(); // Fetch all records

        // Load the view and pass the data
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('list_ALLrecord', $data);
    }

    
    //show the record by specific user
    public function userList() {
        $userID = $this->session->userdata('userID');
    
        // Fetch user records
        $data['records'] = $this->Record_model->get_record_by_user_id($userID);
    
        // Get the project info (assumes all records belong to one project)
        if (!empty($data['records'])) {
            $projectID = $data['records'][0]['projectID'];
            $this->load->model('Project_model');
            $data['project'] = $this->Project_model->get_project_by_id($projectID);
        } else {
            $data['project'] = null;
        }
    
        // Load the view
        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('list_record', $data);
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
}
?>
