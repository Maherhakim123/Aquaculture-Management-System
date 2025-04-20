<?php
class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }

    // public function add($phaseID) {
    //     $user_role = $this->session->userdata('role'); // 'leader' or 'beneficiary'
    //     $user_id = $this->session->userdata('userID');
    
    //     $data = array(
    //         'activityType' => ($user_role === 'leader') ? $this->input->post('activityType') : null,
    //         'activityName' => ($user_role === 'leader') ? $this->input->post('activityName') : null,
    //         'comment' => $this->input->post('comment'),
    //         'recordDate' => date('Y-m-d H:i:s'),
    //         'phaseID' => $phaseID,
    //         'userID' => $userID
    //     );
    
    //     $this->Activity_model->add_activity($data);
    //     redirect('phase/view/' . $phaseID);
    // }


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
    
}
?>
