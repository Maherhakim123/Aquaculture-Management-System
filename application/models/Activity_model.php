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


    // retrieve phase name and all activity data in one page
    public function get_activities_with_phase_name($phaseID) {
    $this->db->select('p.phaseName, a.activityType, a.activityName, a.recordDate, a.comment');
    $this->db->from('activity a');
    $this->db->join('phase p', 'a.phaseID = p.phaseID');
    $this->db->where('a.phaseID', $phaseID);
    $query = $this->db->get();
    return $query->result();
}


//Insert/store data to add comments in table comments
public function add_activity_comment($activityID, $userID, $comment)
{
    return $this->db->insert('comments', [          // <- new table
        'activityID' => $activityID,
        'userID'     => $userID,
        'comment'    => $comment
    ]);
}
    


// To show activity comments by progress
public function get_activities_with_comments_by_phase($phaseID) {
    $this->db->select('a.activityID, a.activityType, a.activityName, c.comment, c.created_at, u.username');
    $this->db->from('activity a');
    $this->db->join('comments c', 'a.activityID = c.activityID', 'left');
    $this->db->join('users u', 'c.userID = u.userID', 'left');
    $this->db->where('a.phaseID', $phaseID);
    $this->db->order_by('a.activityID, c.created_at');
    $query = $this->db->get();
    return $query->result();
}


//ony retrive their specifi comment history
public function get_comments_by_activity_and_user($activityID, $userID) {
    $this->db->select('comments.*, users.username');
    $this->db->from('comments');
    $this->db->join('users', 'users.userID = comments.userID');
    $this->db->where('comments.activityID', $activityID);
    $this->db->where('comments.userID', $userID);
    $this->db->order_by('comments.created_at', 'ASC');
    return $this->db->get()->result_array();
}






}
?>
