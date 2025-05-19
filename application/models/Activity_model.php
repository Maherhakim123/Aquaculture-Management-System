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

//Review Balik
public function add_comment_only($activityID, $comment) {
    $this->db->where('activityID', $activityID);
    $this->db->update('activity', ['comment' => $comment]);
}

//For comments
public function add_activity_comment($activityID, $userID, $comment)
{
    return $this->db->insert('comments', [          // <- new table
        'activityID' => $activityID,
        'userID'     => $userID,
        'comment'    => $comment
    ]);
}

public function get_comments($activityID)
{
    return $this->db->where('activityID', $activityID)
                    ->order_by('created_at', 'ASC')
                    ->get('comments')              // <- new table
                    ->result();
}


//comment that belongs to the specific beneficiary user only
public function get_activities_with_user_comment($phaseID, $userID)
{
    $this->db->select('a.activityID,
                       a.activityType,
                       a.activityName,
                       c.comment');                              // <- may be NULL
    $this->db->from('activity a');
    $this->db->join('comments c',
        'c.activityID = a.activityID AND c.userID = '.$this->db->escape($userID),
        'left');                                              // keeps activity even w/out comment
    $this->db->where('a.phaseID', $phaseID);
    $this->db->order_by('a.recordDate','DESC');
    return $this->db->get()->result();
}
    



}
?>
