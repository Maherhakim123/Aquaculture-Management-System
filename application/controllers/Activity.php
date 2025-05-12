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

    $this->load->view('create_activity_record', $data); 
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
    
    
}
?>
