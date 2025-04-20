<?php
class Phase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Phase_model');
    }

    // Show phase for a specific project
    public function index($projectID) {
        $data['phases'] = $this->Phase_model->get_phase($projectID); // Ensure the key matches the view
        $data['projectID'] = $projectID;
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('phase_list', $data);
        $this->load->view('templates/footer');
    }


    // View details of a specific phase
public function view($phaseID) {
    $data['phase'] = $this->Phase_model->get_phase_by_id($phaseID);

    if (!$data['phase']) {
        show_404();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('leader_view_phase', $data);
    $this->load->view('templates/footer');
}

    

    // Show form to create a new phase
    public function create($projectID = null) {
        if ($projectID === null) {
            show_error("Invalid Project ID", 400);
        }
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('create_phase', $data);
        $this->load->view('templates/footer');
    }

    // Save the new phase
    public function add() {
        $data = [
            'projectID' => $this->input->post('projectID'),
            'phaseName' => $this->input->post('phaseName'),
            'startDate' => $this->input->post('startDate'),
            'deadline' => $this->input->post('deadline'),
            'status' => $this->input->post('status'),
            'progress' => $this->input->post('progress')
        ];

        if ($this->Phase_model->add_phase($data)) {
            redirect('phase/index/' . $data['projectID']);
        } else {
            show_error("Failed to create phase.", 500);
        }
    }

    // Delete a phase
    public function delete($phaseID, $projectID) {
        $this->Phase_model->delete_phase($phaseID);
        redirect('phase/index/' . $projectID);
    }
}
?>
