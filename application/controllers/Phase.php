<?php
class Phase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Phase_model');
    }

    // Show phase for a specific project
    public function index($projectID) {
        $data['phase'] = $this->Phase_model->get_phase($projectID);
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('phase_list', $data);
        $this->load->view('templates/footer');
    }

    // Show form to create a new phase
    public function create($projectID) {
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('phase_create', $data);
        $this->load->view('templates/footer');
    }

    // Save the new phase
    public function add() {
        $data = [
            'projectID' => $this->input->post('projectID'),
            'phaseName' => $this->input->post('phaseName'),
            'startDate' => $this->input->post('startDate'),
            'endDate' => $this->input->post('endDate')
        ];

        $this->Phase_model->add_phase($data);
        redirect('phase/index/' . $data['projectID']);
    }

    // Delete a phase
    public function delete($phaseID, $projectID) {
        $this->Phase_model->delete_phase($phaseID);
        redirect('phase/index/' . $projectID);
    }
}
?>
