<?php

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->model('Phase_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }

    public function create($phaseID)
    {
        $this->load->model('Phase_Model');
        $data['phase'] = $this->Phase_Model->get_phase_by_id($phaseID);

        $this->load->view('create_activity_record', $data);
    }

    // Create record in sidebar
    public function recordActivity()
    {
        $userID = $this->session->userdata('userID');

        $this->load->model('Project_model');
        $this->load->model('Phase_model');

        $data['projects'] = $this->Project_model->get_projects_by_leader($userID);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('create_activity_record', $data);
        $this->load->view('templates/footer');
    }

    public function getPhasesByProject($projectID)
    {
        $this->load->model('Phase_model');
        $phases = $this->Phase_model->get_phases_by_project($projectID);
        echo json_encode($phases);
    }

    // public function add()
    // {
    //     $activityID = $this->input->post('activityID');
    //     $user_role = $this->session->userdata('role'); // 'leader' or 'beneficiary'
    //     $user_id = $this->session->userdata('userID');
    //     $phaseID = $this->input->post('phaseID');

    //     $data = [
    //         'activityType' => $this->input->post('activityType'),
    //         'activityName' => $this->input->post('activityName'),
    //         // 'comment' => $this->input->post('comment'),
    //         'phaseID' => $phaseID,
    //         // 'userID' => $userID
    //     ];

    //     $this->Activity_model->add_activity($data);
    //     redirect('phase/view');
    // }

    // public function add()
    // {
    //     $phaseID = $this->input->post('phaseID');

    //     $data = [
    //         'activityType' => $this->input->post('activityType'),
    //         'activityName' => $this->input->post('activityName'),
    //         'phaseID' => $phaseID,
    //     ];

    //     $this->Activity_model->add_activity($data);
    //     $this->session->set_flashdata('success', 'Activity added successfully!');

    //     redirect('phase/view'); // or redirect back to previous page
    // }

    public function add()
    {
        $phaseID = $this->input->post('phaseID');

        $data = [
            'activityType' => $this->input->post('activityType'),
            'activityName' => $this->input->post('activityName'),
            'phaseID' => $phaseID,
        ];

        $this->Activity_model->add_activity($data);

        // Get the projectID from the phase
        $phase = $this->Phase_model->get_phase_by_id($phaseID);
        $projectID = $phase ? $phase->projectID : null;

        // Store projectID in session for redirect
        $this->session->set_userdata('projectID_to_index', $projectID);

        if ($projectID) {
            redirect('phase/index');
        } else {
            // Fallback if no project found
            redirect('project/index');
        }
    }

    // public function edit()
    // {
    //     $activityID = $this->input->post('activityID');
    //     $activity = $this->Activity_model->get_activity($activityID);

    //     if (!$activity) {
    //         show_404();
    //     }

    //     // Store activityID in session for POST-based update
    //     $this->session->set_userdata('activityID_to_update', $activityID);
    //     $this->session->set_userdata('phaseID_to_return', $activity->phaseID); // for redirect later

    //     $data['activity'] = $activity;

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('edit_activity', $data);
    //     $this->load->view('templates/footer');
    // }

    public function edit()
    {
        $activityID = $this->input->post('activityID');
        $activity = $this->Activity_model->get_activity($activityID);

        if (!$activity) {
            show_404();
        }

        //  Store activityID and phaseID for update and redirect later
        $this->session->set_userdata('activityID_to_update', $activityID);
        $this->session->set_userdata('phaseID_to_return', $activity->phaseID);

        $data['activity'] = $activity;
        $data['phaseID'] = $activity->phaseID;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('edit_activity', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $activityID = $this->session->userdata('activityID_to_update');
        if (!$activityID) {
            show_404(); // fail-safe
        }

        $data = [
            'activityType' => $this->input->post('activityType'),
            'activityName' => $this->input->post('activityName'),
        ];

        $phaseID = $this->Activity_model->update_activity($activityID, $data);
        $this->session->unset_userdata('activityID_to_update'); // clean up

        // If you also stored phaseID earlier, use that for redirect
        $phaseID = $this->session->userdata('phaseID_to_return');
        $this->session->unset_userdata('phaseID_to_return');

        if ($phaseID) {
            $this->load->model('Phase_model');
            $phase = $this->Phase_model->get_phase_by_id($phaseID);
            if ($phase) {
                $this->session->set_userdata('projectID_to_index', $phase->projectID); // optional redirect improvement
            }
        }

        $this->session->set_userdata('phaseID_to_view', $phaseID);
        redirect('phase/view');
    }

    public function delete()
    {
        $activityID = $this->input->post('activityID');
        $phaseID = $this->input->post('phaseID');

        if (!$activityID || !$phaseID) {
            show_404(); // safety check
        }

        $this->Activity_model->delete_activity($activityID);

        // Store phaseID in session for redirect
        $this->session->set_userdata('phaseID_to_view', $phaseID);

        // Redirect using POST-safe session value
        redirect('phase/view');
    }

    public function beneficiary_add_comment_form()
    {
        $projectID = $this->input->post('projectID');

        // logged‑in beneficiary
        $data['projectID'] = $projectID;
        $data['phases'] = $this->Phase_model->get_phase($projectID);

        // view needs phases only; activities are fetched on demand
        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('beneficiary_add_comment', $data);
        $this->load->view('templates/footer');
    }

    public function save_beneficiary_comment()
    {
        $activityID = $this->input->post('activityID');
        $comment = $this->input->post('comment');
        $spending = $this->input->post('spending');
        $userID = $this->session->userdata('userID');

        // 1. store the new comment
        $this->Activity_model->add_activity_comment($activityID, $userID, $comment, $spending);

        // 2. find the project this activity is under
        $activity = $this->Activity_model->get_activity($activityID);      // gives phaseID
        $phase = $this->Phase_model->get_phase_by_id($activity->phaseID); // gives projectID
        $projectID = $phase->projectID;

        // 3. Store projectID in session for POST-style redirect
        $this->session->set_userdata('projectID_to_progress', $projectID);

        // 4. Redirect without passing projectID in the URL
        redirect('phase/beneficiary_progress');
    }

    public function getActivitiesByPhase($phaseID)
    {
        $activities = $this->Activity_model->get_activities_by_phase($phaseID);
        echo json_encode($activities);
    }

    // Project leader tick to make the progress in phase_list (progress bar)
    public function update_progress()
    {
        $activityID = $this->input->post('activityID');
        $progress = $this->input->post('progress');

        $this->load->model('Activity_model');
        $updated = $this->Activity_model->update_progress($activityID, $progress);

        if ($updated) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    // Project leader tick to approved budget from beneficiary
    public function update_budget_approval()
    {
        $commentID = $this->input->post('commentID');
        // $approved = $this->input->post('approvalStatus') == 1 ? 'approved' : 'not_approved';
        $approved = $this->input->post('budget_approved') ? 'approved' : 'not_approved';

        $this->load->model('Activity_model');
        $result = $this->Activity_model->update_approval_status($commentID, $approved);

        echo json_encode(['status' => $result ? 'success' : 'error']);
    }

    // view Converstaion
    public function view_comment_conversation($activityID)
    {
        $this->load->model('Activity_model');
        $userID = $this->session->userdata('userID'); // current user (leader)

        // Get all comments for this activity
        $data['activity'] = $this->Activity_model->get_activity($activityID);
        $data['comments'] = $this->Activity_model->get_comments_by_activity($activityID); // new method
        $data['activityID'] = $activityID;

        $this->load->view('view_comment_conversation', $data);
    }

    // Project Leader add comment in conversation
    // public function leader_add_comment()
    // {
    //     $activityID = $this->input->post('activityID');
    //     $comment = $this->input->post('comment');
    //     $userID = $this->session->userdata('userID');

    //     if ($activityID && $comment && $userID) {
    //         $this->db->insert('comments', [
    //             'activityID' => $activityID,
    //             'userID' => $userID,
    //             'comment' => $comment,
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'approvalStatus' => 'approved', // Optional: leader's own messages are auto-approved
    //         ]);
    //     }

    //     redirect('activity/view_conversation/'.$activityID);
    // }

    public function leader_add_comment()
    {
        $activityID = $this->input->post('activityID');
        $comment = $this->input->post('comment');
        $userID = $this->session->userdata('userID');

        if ($activityID && $comment && $userID) {
            $this->db->insert('comments', [
                'activityID' => $activityID,
                'userID' => $userID,
                'comment' => $comment,
                'created_at' => date('Y-m-d H:i:s'),
                'approvalStatus' => 'approved',
            ]);

            // Set session for redirect
            $this->session->set_userdata('activityID_to_view', $activityID);
        }

        redirect('activity/view_conversation');
    }

    // Project Leader delete comment in messages
    // public function delete_comment_messages($commentID, $activityID)
    // {
    //     // Optional: check if current user is the owner or a project leader
    //     $userRole = $this->session->userdata('role'); // 'leader' or 'beneficiary'
    //     $userID = $this->session->userdata('userID');

    //     // You could allow only project leaders or comment owners to delete
    //     $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

    //     if ($comment && ($userRole === 'leader' || $comment->userID == $userID)) {
    //         $this->db->delete('comments', ['commentID' => $commentID]);
    //     }

    //     redirect('activity/view_conversation/'.$activityID);
    // }

    public function delete_comment_messages()
    {
        $commentID = $this->input->post('commentID');
        $activityID = $this->input->post('activityID');

        $userRole = $this->session->userdata('role');
        $userID = $this->session->userdata('userID');

        $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

        if ($comment && ($userRole === 'leader' || $comment->userID == $userID)) {
            $this->db->delete('comments', ['commentID' => $commentID]);
        }

        // Store activityID in session and redirect
        $this->session->set_userdata('activityID_to_view', $activityID);
        redirect('activity/view_conversation');
    }

    // Project Leader delete comment in progress
    // public function delete_comment_progress($commentID, $activityID)
    // {
    //     $userRole = $this->session->userdata('role');
    //     $userID = $this->session->userdata('userID');

    //     // Get the comment to check permissions
    //     $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

    //     if ($comment && ($userRole === 'leader' || $comment->userID == $userID)) {
    //         $this->db->delete('comments', ['commentID' => $commentID]);
    //     }

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

    // public function view_conversation()
    // {
    //     $activityID = $this->input->post('activityID');

    //     // Get activity data
    //     $activity = $this->Activity_model->get_activity($activityID);
    //     if (!$activity) {
    //         show_404();
    //     }

    //     // Get comments
    //     $comments = $this->Activity_model->get_comments_by_activity($activityID);

    //     // Data to pass to views
    //     $data = [
    //         'activity' => $activity,
    //         'comments' => $comments,
    //         'activityID' => $activityID,
    //     ];

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('view_comment_conversation', $data);
    //     $this->load->view('templates/footer');
    // }

    public function view_conversation()
    {
        $activityID = $this->input->post('activityID');

        // Fallback to session if POST not available
        if (!$activityID) {
            $activityID = $this->session->userdata('activityID_to_view');
        }

        if (!$activityID) {
            show_404();
        }

        // Get activity data
        $activity = $this->Activity_model->get_activity($activityID);
        if (!$activity) {
            show_404();
        }

        // Get comments
        $comments = $this->Activity_model->get_comments_by_activity($activityID);

        $data = [
            'activity' => $activity,
            'comments' => $comments,
            'activityID' => $activityID,
        ];

        // Optional: clear the session
        $this->session->unset_userdata('activityID_to_view');

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('view_comment_conversation', $data);
        $this->load->view('templates/footer');
    }

    // Beneficiary view comment in conversation
    public function beneficiary_view_comment()
    {
        $activityID = $this->input->post('activityID');
        $activity = $this->Activity_model->get_activity($activityID);
        if (!$activity) {
            show_404();
        }

        $comments = $this->Activity_model->get_comments_by_activity($activityID);
        $phase = $this->Phase_model->get_phase_by_id($activity->phaseID);
        $projectID = $phase ? $phase->projectID : null;

        $data = [
            'activity' => $activity,
            'comments' => $comments,
            'activityID' => $activityID,
            'projectID' => $projectID,
        ];

        $this->load->view('templates/header');
        $this->load->view('templates/community_sidebar');
        $this->load->view('beneficiary_view_comment', $data);
        $this->load->view('templates/footer');
    }
}
