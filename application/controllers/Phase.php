<?php
class Phase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Phase_model');
        $this->load->model('Activity_model');
    }

    // Show phase for a specific project
    public function index($projectID) {
        $data['phases'] = $this->Phase_model->get_phase($projectID);
        $data['projectID'] = $projectID;
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('phase_list', $data);
        $this->load->view('templates/footer');
    }


    // View details of a specific phase
public function view($phaseID) {
    $data['phase'] = $this->Phase_model->get_phase_by_id($phaseID);
    $data['activities'] = $this->Activity_model->get_activities_by_phase($phaseID);

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
    // public function add() {
       
    //     $status = "not started";
    //     $progress = 0;

    //     $data = [
    //         'projectID' => $this->input->post('projectID'),
    //         'phaseName' => $this->input->post('phaseName'),
    //         'startDate' => $this->input->post('startDate'),
    //         'deadline' => $this->input->post('deadline'),
    //         'status' => $status,
    //         'progress' => $progress
    //     ];

    //     if ($this->Phase_model->add_phase($data)) {
    //         redirect('phase/index/' . $data['projectID']);
    //     } else {
    //         show_error("Failed to create phase.", 500);
    //     }
    // }


    public function add() {
    $projectID = $this->input->post('projectID');
    $phaseName = $this->input->post('phaseName');
    $startDate = $this->input->post('startDate');
    $deadline = $this->input->post('deadline');

    // Get current phase count for this project
    $phaseCount = $this->Phase_model->get_phase_count_by_project($projectID);
    $nextNumber = $phaseCount + 1;

    // Auto-generate phase name
    $fullPhaseName = 'PHASE ' . $nextNumber . ' - ' . strtoupper($phaseName);

    $data = [
        'projectID' => $projectID,
        'phaseName' => $fullPhaseName,
        'startDate' => $startDate,
        'deadline' => $deadline,
        'status' => 'Not Started',
        'progress' => 0
    ];

    if ($this->Phase_model->add_phase($data)) {
        redirect('phase/index/' . $projectID);
    } else {
        show_error("Failed to create phase.", 500);
    }
}


    // Update a Phase
    public function update($phaseID) {
        $progress = $this->input->post('progress');
        
        if ($progress == 0) {
            $status = 'Not Started';
        } elseif ($progress > 0 && $progress < 100) {
            $status = 'In Progress';
        } elseif ($progress == 100) {
            $status = 'Completed';
        } else {
            show_error("Invalid progress value.", 400);
        }
    
        $data = [
            'phaseName' => $this->input->post('phaseName'),
            'startDate' => $this->input->post('startDate'),
            'deadline' => $this->input->post('deadline'),
            'progress' => $progress,
            'status' => $status
        ];
    
        if ($this->Phase_model->update($phaseID, $data)) {
            redirect('phase/view/' . $phaseID);
        } else {
            show_error("Failed to update phase.", 500);
        }
    }
    

    // Delete a phase
    public function delete($phaseID, $projectID) {
        $this->Phase_model->delete_phase($phaseID);
        redirect('phase/index/' . $projectID);
    }


    // show progress
    public function progress($phaseID) {
    $data['activities'] = $this->Activity_model->get_activities_with_phase_name($phaseID);
    //S$data['projectID'] = $projectID;


    if (empty($data['activities'])) {
        show_404(); // or set a message saying no activity found
    }

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('leader_view_progress', $data);
    $this->load->view('templates/footer');
}


// Leader view the progress
public function progress_by_project($projectID) {
    $this->load->model('Phase_model');
    $this->load->model('Activity_model'); 

    // Get all phases under this project
    $phases = $this->Phase_model->get_phases_by_project($projectID);

    $progressData = [];

    foreach ($phases as $phase) {
        // Get progress/activities by phaseID
        $activities = $this->Activity_model->get_activities_by_phase($phase->phaseID);

        $progressData[] = [
            'phase' => $phase,
            'activities' => $activities
        ];
    }

    $data['progressData'] = $progressData;
    $data['projectID'] = $projectID;

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('leader_view_progress', $data);
    $this->load->view('templates/footer');
}



}
?>
