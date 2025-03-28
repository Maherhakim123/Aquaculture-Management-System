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
        $this->load->view('list_record', $data);
    }

    // Load create record form
    public function create() {
        $this->load->view('templates/header');
		$this->load->view('templates/community_sidebar');
        $this->load->view('create_record');
        $this->load->view('templates/footer');

    }

    // Handle form submission
    public function store() {
        $data = array(
            'quantity' => $this->input->post('quantity'),
            'recordDate' => $this->input->post('recordDate'),
            'incomeGenerated' => $this->input->post('incomeGenerated'),
            'situation' => $this->input->post('situation'),
            //'projectID' => $this->input->post('projectID'),
            'userID' => $this->session->userdata('userID') // assuming session contains userID
        );

        $this->Record_model->insert_record($data);
        redirect('record');
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
