<?php
class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->model('Phase_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }

    public function create($phaseID) {
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


    public function add() {
        $user_role = $this->session->userdata('role'); // 'leader' or 'beneficiary'
        $user_id = $this->session->userdata('userID');
        $phaseID = $this->input->post('phaseID');

        $data = array(
            'activityType' => $this->input->post('activityType'),
            'activityName' => $this->input->post('activityName'),
            //'comment' => $this->input->post('comment'),
            'phaseID' => $phaseID,
            //'userID' => $userID
        );
    
        $this->Activity_model->add_activity($data);
        redirect('phase/view/' . $phaseID);
    }


    public function edit($activityID) {
        $data['activity'] = $this->Activity_model->get_activity($activityID);
        
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('edit_activity', $data); 
    $this->load->view('templates/footer');
    }
    
    public function update($activityID) {
        $data = array(
            'activityType' => $this->input->post('activityType'),
            'activityName' => $this->input->post('activityName'),
            //'comment' => $this->input->post('comment'),
        );
    
        $phaseID = $this->Activity_model->update_activity($activityID, $data);
        redirect('phase/view/' . $phaseID);
    }
    
    public function delete($activityID, $phaseID) {
        $this->Activity_model->delete_activity($activityID);
        redirect('phase/view/' . $phaseID);
    }


public function beneficiary_add_comment_form($projectID)
{
    // logged‑in beneficiary
    $data['projectID'] = $projectID;
    $data['phases']    = $this->Phase_model->get_phase($projectID);

    // view needs phases only; activities are fetched on demand
    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('beneficiary_add_comment', $data);
    $this->load->view('templates/footer');
}



public function save_beneficiary_comment()
{
    $activityID = $this->input->post('activityID');
    $comment    = $this->input->post('comment');
    $spending   = $this->input->post('spending');
    $userID     = $this->session->userdata('userID');

    // 1. store the new comment
    $this->Activity_model->add_activity_comment($activityID, $userID, $comment, $spending);

    // 2. find the project this activity is under
    $activity   = $this->Activity_model->get_activity($activityID);      // gives phaseID
    $phase      = $this->Phase_model->get_phase_by_id($activity->phaseID); // gives projectID
    $projectID  = $phase->projectID;

    // 3. send user to the progress page for that project
    redirect('phase/beneficiary_progress/'.$projectID);
}


public function getActivitiesByPhase($phaseID) {
    $activities = $this->Activity_model->get_activities_by_phase($phaseID);
    echo json_encode($activities);
}

//Project leader tick to make the progress in phase_list (progress bar)
public function update_progress() {
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

//Project leader tick to approved budget from beneficiary
public function update_budget_approval() {
    $commentID = $this->input->post('commentID');
    //$approved = $this->input->post('approvalStatus') == 1 ? 'approved' : 'not_approved';
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
public function leader_add_comment() {
    $activityID = $this->input->post('activityID');
    $comment    = $this->input->post('comment');
    $userID     = $this->session->userdata('userID');

    if ($activityID && $comment && $userID) {
        $this->db->insert('comments', [
            'activityID' => $activityID,
            'userID'     => $userID,
            'comment'    => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'approvalStatus' => 'approved' // Optional: leader's own messages are auto-approved
        ]);
    }

    redirect('activity/view_conversation/' . $activityID);
}


//Project Leader delete comment in messages
public function delete_comment_messages($commentID, $activityID)
{
    // Optional: check if current user is the owner or a project leader
    $userRole = $this->session->userdata('role'); // 'leader' or 'beneficiary'
    $userID   = $this->session->userdata('userID');

    // You could allow only project leaders or comment owners to delete
    $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

    if ($comment && ($userRole === 'leader' || $comment->userID == $userID)) {
        $this->db->delete('comments', ['commentID' => $commentID]);
    }

    redirect('activity/view_conversation/' . $activityID);
}

//Project Leader delete comment in progress
public function delete_comment_progress($commentID, $activityID)
{
    $userRole = $this->session->userdata('role');
    $userID   = $this->session->userdata('userID');

    // Get the comment to check permissions
    $comment = $this->db->get_where('comments', ['commentID' => $commentID])->row();

    if ($comment && ($userRole === 'leader' || $comment->userID == $userID)) {
        $this->db->delete('comments', ['commentID' => $commentID]);
    }

    // 🛠 Get the projectID from the activity's phase
    $this->db->select('phase.projectID');
    $this->db->from('activity');
    $this->db->join('phase', 'phase.phaseID = activity.phaseID');
    $this->db->where('activity.activityID', $activityID);
    $query = $this->db->get();
    $result = $query->row();

    $projectID = $result ? $result->projectID : null;

    if ($projectID) {
        redirect('phase/progress_by_project/' . $projectID);
    } else {
        // fallback just in case
        redirect('project/index');
    }
}


public function view_conversation($activityID)
{
    // Load necessary models
    $this->load->model('Activity_model');

    // Get activity data
    $activity = $this->Activity_model->get_activity($activityID);
    if (!$activity) {
        show_404();
    }

    // Get comments
    $comments = $this->Activity_model->get_comments_by_activity($activityID);

    // Data to pass to views
    $data = [
        'activity' => $activity,
        'comments' => $comments,
        'activityID' => $activityID
    ];

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('view_comment_conversation', $data); 
    $this->load->view('templates/footer');
}


// Beneficiary view comment in conversation
public function beneficiary_view_comment($activityID)
{
    $this->load->model('Activity_model');

    $activity = $this->Activity_model->get_activity($activityID);
    if (!$activity) {
        show_404();
    }

    $comments = $this->Activity_model->get_comments_by_activity($activityID);

    $data = [
        'activity' => $activity,
        'comments' => $comments,
        'activityID' => $activityID
    ];

    $this->load->view('templates/header');
    $this->load->view('templates/community_sidebar');
    $this->load->view('beneficiary_view_comment', $data);
    $this->load->view('templates/footer');
}










    
    
}
?>
