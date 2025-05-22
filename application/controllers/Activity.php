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

        $recordDate = $this->input->post('recordDate');
        $phaseID = $this->input->post('phaseID');

        $data = array(
            'activityType' => $this->input->post('activityType'),
            'activityName' => $this->input->post('activityName'),
            'comment' => $this->input->post('comment'),
            'recordDate' => $recordDate,
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
            'comment' => $this->input->post('comment'),
            'recordDate' => $this->input->post('recordDate'),
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
    $this->load->view('beneficiary_add_comment', $data);
}



public function save_beneficiary_comment()
{
    $activityID = $this->input->post('activityID');
    $comment    = $this->input->post('comment');
    $userID     = $this->session->userdata('userID');

    // 1. store the new comment
    $this->Activity_model->add_activity_comment($activityID, $userID, $comment);

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



// public function add_comment() {
//     $activityID = $this->input->post('activityID');
//     $comment = $this->input->post('comment');
//     $userID = $this->session->userdata('userID');

//     if ($activityID && $comment && $userID) {
//         $this->db->insert('comments', [
//             'activityID' => $activityID,
//             'userID' => $userID,
//             'comment' => $comment,
//             'created_at' => date('Y-m-d H:i:s'),
//         ]);
//     }

//     // Redirect back to the project progress view
//     redirect($this->agent->referrer()); // or redirect('project/community_view/' . $projectID)
// }




    
    
}
?>
