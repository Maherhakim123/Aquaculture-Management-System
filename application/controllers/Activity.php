<?php
class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }



    public function add($phaseID) {
        $user_role = $this->session->userdata('role'); // 'leader' or 'beneficiary'
        $user_id = $this->session->userdata('userID');
    
        $data = array(
            'activityType' => $this->input->post('activityType'),
            'activityName' => $this->input->post('activityName'),
            'comment' => $this->input->post('comment'),
            'recordDate' => date('Y-m-d H:i:s'),
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
