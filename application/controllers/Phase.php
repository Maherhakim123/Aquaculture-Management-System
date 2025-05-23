<?php
class Phase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Phase_model');
        $this->load->model('Activity_model');
    }

  // Project leader view the list of phase
  public function index($projectID) {
    $phases = $this->Phase_model->get_phase($projectID);

    // Calculate progress for each phase based on activities
   foreach ($phases as &$phase) {
    $totalActivities = $this->Activity_model->countActivitiesByPhase($phase->phaseID);
    $completedActivities = $this->Activity_model->countCompletedActivitiesByPhase($phase->phaseID);

    if ($totalActivities > 0) {
        $phase->progress = round(($completedActivities / $totalActivities) * 100);
    } else {
        $phase->progress = 0;
    }

    $phase->totalActivities = $totalActivities;
    $phase->completedActivities = $completedActivities;
}

    $data['phases'] = $phases;
    $data['projectID'] = $projectID;

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('phase_list', $data);
    $this->load->view('templates/footer');
}


    // Show phase for a specific project for beneficiary
    public function beneficiary_view_phase($projectID) {
        $data['phases'] = $this->Phase_model->get_phase($projectID);
        $data['projectID'] = $projectID;
    
        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('beneficiary_view_phase', $data);
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

// Project Leader view progress table
public function progress_by_project($projectID) {
    $this->load->model('Phase_model');
    $this->load->model('Activity_model'); 

    // Get all phases under this project
    $phases = $this->Phase_model->get_phases_by_project($projectID);

    $progressData = [];

    foreach ($phases as $phase) {
    $rawData = $this->Activity_model->get_activities_with_comments_by_phase($phase->phaseID);

    $activities = [];
    foreach ($rawData as $row) {
        $activityID = $row->activityID;
        if (!isset($activities[$activityID])) {
            $activities[$activityID] = [
                'activityID' => $activityID,
                'activityType' => $row->activityType,
                'activityName' => $row->activityName,
                'progress' => $row->progress,
                'comments' => []
            ];
        }

        if ($row->comment) {
            $activities[$activityID]['comments'][] = [
                'username' => $row->username ?? 'Unknown',
                'comment' => $row->comment,
                'created_at' => $row->created_at
            ];
        }
    }

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


//Beneficiary view the progress
public function beneficiary_progress($projectID) {
    $this->load->model('Phase_model');
    $this->load->model('Activity_model');

    $userID = $this->session->userdata('userID');  // Ensure userID is stored in session

    $phases = $this->Phase_model->get_phases_by_project($projectID);
    $progressData = [];

    foreach ($phases as $phase) {
        $activities = $this->Activity_model->get_activities_by_phase($phase->phaseID);

        // For each activity, attach ONLY comments from the current user
        foreach ($activities as &$activity) {
            $activity->comments = $this->Activity_model->get_comments_by_activity_and_user($activity->activityID, $userID);
        }

        $progressData[] = [
            'phase' => $phase,
            'activities' => $activities
        ];
    }

    $data['progressData'] = $progressData;
    $data['projectID'] = $projectID;

    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('beneficiary_view_progress', $data);  // View for beneficiaries
    $this->load->view('templates/footer');
}

public function update_completion_status() {
    $phaseID = $this->input->post('phaseID');
    $is_completed = $this->input->post('is_completed');

    if ($phaseID !== null) {
        $this->Phase_model->update_completion_status($phaseID, $is_completed);
    }
}



}
?>
