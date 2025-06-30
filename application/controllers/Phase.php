<?php

class Phase extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Phase_model');
        $this->load->model('Activity_model');
    }

    // Project leader view the list of phase
    public function index()
    {
        $projectID = $this->input->post('projectID');
        if (isset($projectID)) {
            $projectID = $this->input->post('projectID');
        } else {
            $projectID = $this->session->userdata('projectID_to_index');
        }

        $phases = $this->Phase_model->get_phase($projectID);

        foreach ($phases as &$phase) {
            $totalActivities = $this->Activity_model->countActivitiesByPhase($phase->phaseID);
            $completedActivities = $this->Activity_model->countCompletedActivitiesByPhase($phase->phaseID);

            $progress = ($totalActivities > 0) ? round(($completedActivities / $totalActivities) * 100) : 0;

            $phase->progress = $progress;
            $phase->totalActivities = $totalActivities;
            $phase->completedActivities = $completedActivities;

            // Update in DB
            $this->Phase_model->update_progress_and_status($phase->phaseID, $progress);
        }

        $data['phases'] = $phases;
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('phase_list', $data);
        $this->load->view('templates/footer');
    }

    // Show phase for a specific project for beneficiary
    public function beneficiary_view_phase($projectID)
    {
        $data['phases'] = $this->Phase_model->get_phase($projectID);
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('beneficiary_view_phase', $data);
        $this->load->view('templates/footer');
    }

    // View details of a specific phase
    public function view()
    {
        $phaseID = $this->input->post('phaseID');

        if (!$phaseID) {
            $phaseID = $this->session->userdata('phaseID_to_view');
        }

        // 3. If still missing, show 404
        if (!$phaseID) {
            show_404();
        }

        $phase = $this->Phase_model->get_phase_by_id($phaseID);

        if (!$phase) {
            show_404();
        }

        $data['phase'] = $phase;
        $data['activities'] = $this->Activity_model->get_activities_by_phase($phaseID);
        $data['projectID'] = $phase->projectID;

        // 6. Optional: clear session
        $this->session->unset_userdata('phaseID_to_view');

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('leader_view_phase', $data);
        $this->load->view('templates/footer');
    }

    // Show form to create a new phase
    public function create()
    {
        $projectID = $this->input->post('projectID');

        // Load the project model and fetch project data
        $this->load->model('Project_model');
        $project = $this->Project_model->get_project_by_id($projectID);

        // Pass the min/max date to view
        $data['projectID'] = $projectID;
        $data['minDate'] = $project->startDate;
        $data['maxDate'] = $project->endDate;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('create_phase', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $projectID = $this->input->post('projectID');
        $phaseName = $this->input->post('phaseName');
        $startDate = $this->input->post('startDate');
        $deadline = $this->input->post('deadline');

        // Get current phase count for this project
        $phaseCount = $this->Phase_model->get_phase_count_by_project($projectID);
        $nextNumber = $phaseCount + 1;

        // Auto-generate phase name
        $fullPhaseName = 'PHASE '.$nextNumber.' - '.strtoupper($phaseName);

        $data = [
            'projectID' => $projectID,
            'phaseName' => $fullPhaseName,
            'startDate' => $startDate,
            'deadline' => $deadline,
            'status' => 'Not Started',
            'progress' => 0,
        ];

        if ($this->Phase_model->add_phase($data)) {
            $this->session->set_userdata('projectID_to_index', $projectID);
            redirect('phase/index');
        } else {
            show_error('Failed to create phase.', 500);
        }
    }

    // Display the edit form
    public function edit()
    {
        $phaseID = $this->input->post('phaseID');
        $phase = $this->Phase_model->get_phase_by_id($phaseID);

        if (!$phase) {
            show_404();
        }

        // Store projectID in session for later redirect (e.g., back button)
        $this->session->set_userdata('projectID_to_index', $phase->projectID);

        $data['phase'] = $phase;
        $data['projectID'] = $phase->projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('edit_phase', $data);
        $this->load->view('templates/footer');
    }

    // Handle the form update submission
    public function update()
    {
        $phaseID = $this->input->post('phaseID');
        $projectID = $this->input->post('projectID');
        $phaseName = $this->input->post('phaseName');
        $startDate = $this->input->post('startDate');
        $deadline = $this->input->post('deadline');

        $data = [
            'phaseName' => $phaseName,
            'startDate' => $startDate,
            'deadline' => $deadline,
        ];

        $status = $this->Phase_model->update_phase($phaseID, $data);
        if ($status) {
            redirect('phase/index');
        }
    }

    // Delete a phase
    public function delete()
    {
        $phaseID = $this->input->post('phaseID');
        $projectID = $this->input->post('projectID');
        $this->Phase_model->delete_phase($phaseID);
        redirect('phase/index');
    }

    // show progress
    public function progress($phaseID)
    {
        $data['activities'] = $this->Activity_model->get_activities_with_phase_name($phaseID);
        // S$data['projectID'] = $projectID;

        if (empty($data['activities'])) {
            show_404(); // or set a message saying no activity found
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('leader_view_progress', $data);
        $this->load->view('templates/footer');
    }

    // Project Leader view progress table
    public function progress_by_project()
    {
        $projectID = $this->input->post('projectID');

        // 2. If not in POST, try session
        if (!$projectID) {
            $projectID = $this->session->userdata('projectID_to_progress');
        }

        // 3. Fail-safe: if still not found, 404
        if (!$projectID) {
            show_404();
        }

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
                        'comments' => [],
                    ];
                }

                if ($row->comment) {
                    $activities[$activityID]['comments'][] = [
                        'commentID' => $row->commentID,
                        'username' => $row->username ?? 'Unknown',
                        'comment' => $row->comment,
                        'spending' => $row->spending ?? 0,
                        'created_at' => $row->created_at,
                        'approvalStatus' => $row->approvalStatus ?? 'not_approved',
                    ];
                }
            }

            $progressData[] = [
                'phase' => $phase,
                'activities' => $activities,
            ];
        }

        $data['progressData'] = $progressData;
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('leader_view_progress', $data);
        $this->load->view('templates/footer');
    }

    // Beneficiary view the progress
    public function beneficiary_progress()
    {
        $projectID = $this->input->post('projectID');
        if (!$projectID) {
            // Fallback to session if projectID is not provided
            $projectID = $this->session->userdata('projectID_to_progress');
        }

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
                'activities' => $activities,
            ];
        }

        $data['progressData'] = $progressData;
        $data['projectID'] = $projectID;

        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('beneficiary_view_progress', $data);
        $this->load->view('templates/footer');
    }

    public function update_completion_status()
    {
        $phaseID = $this->input->post('phaseID');
        $is_completed = $this->input->post('is_completed');

        if ($phaseID !== null) {
            $this->Phase_model->update_completion_status($phaseID, $is_completed);
        }
    }

    // Project Leader delete comment in progress
    // public function delete_comment_progress()
    // {
    //     $userRole = $this->session->userdata('role');
    //     $userID = $this->session->userdata('userID');

    //     // Get the comment to check permissions
    //     $commentID = $this->input->post('commentID');
    //     $activityID = $this->input->post('activityID');
    //     $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

    //     $this->db->delete('comments', ['commentID' => $commentID]);

    //     // 🛠 Get the projectID from the activity's phase
    //     $this->db->select('phase.projectID');
    //     $this->db->from('activity');
    //     $this->db->join('phase', 'phase.phaseID = activity.phaseID');
    //     $this->db->where('activity.activityID', $activityID);
    //     $query = $this->db->get();
    //     $result = $query->row();

    //     $projectID = $result ? $result->projectID : null;

    //     if ($projectID) {
    //         redirect('phase/progress_by_project/'.$projectID);
    //     } else {
    //         // fallback just in case
    //         redirect('project/index');
    //     }
    // }

    public function delete_comment_progress()
    {
        $userRole = $this->session->userdata('role');
        $userID = $this->session->userdata('userID');

        // Read from POST
        $commentID = $this->input->post('commentID');
        $activityID = $this->input->post('activityID');

        // Check comment exists
        $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

        // Optional: Only leader or owner can delete
        if ($comment && ($userRole === 'leader' || $comment->userID == $userID)) {
            $this->db->delete('comments', ['commentID' => $commentID]);
        }

        // Get projectID from activity
        $this->db->select('phase.projectID');
        $this->db->from('activity');
        $this->db->join('phase', 'phase.phaseID = activity.phaseID');
        $this->db->where('activity.activityID', $activityID);
        $query = $this->db->get();
        $result = $query->row();

        $projectID = $result ? $result->projectID : null;

        if ($projectID) {
            // Store in session for POST-based redirect
            $this->session->set_userdata('projectID_to_progress', $projectID);
            redirect('phase/progress_by_project');
        } else {
            redirect('project/index');
        }
    }
}
