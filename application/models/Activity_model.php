<?php
class Activity_model extends CI_Model {

    public function add_activity($data) {
        return $this->db->insert('activity', $data);
    }

    public function get_activities_by_phase($phaseID) {
        $this->db->where('phaseID', $phaseID);
        $this->db->order_by('recordDate', 'DESC');
        return $this->db->get('activity')->result();
    }

    public function get_activity($activityID) {
        return $this->db->get_where('activity', ['activityID' => $activityID])->row();
    }
    
    public function update_activity($activityID, $data) {
        $this->db->where('activityID', $activityID);
        $this->db->update('activity', $data);
    
        // Get the related phaseID
        $activity = $this->get_activity($activityID);
        return $activity->phaseID;
    }
    
    public function delete_activity($activityID) {
        $this->db->where('activityID', $activityID);
        $this->db->delete('activity');
    }
    



}
?>
