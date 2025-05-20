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
    
// fetch comments visible only to the logged-in beneficiar
// public function get_comments_for_beneficiary($activityID, $userID)
// {
//     // Fetch leader user IDs
//     $this->db->select('userID');
//     $this->db->from('project_members');
//     $this->db->where('projectRole', 'leader'); // adjust if your role naming is different
//     $leaderQuery = $this->db->get_compiled_select();

//     $this->db->select('comments.*, users.fullName');
//     $this->db->from('comments');
//     $this->db->join('users', 'comments.userID = users.userID');
//     $this->db->where('comments.activityID', $activityID);
//     $this->db->group_start();
//         $this->db->where('comments.userID', $userID);      // Beneficiary's own comments
//         $this->db->or_where("comments.userID IN ($leaderQuery)", null, false); // Leader comments
//     $this->db->group_end();
//     $this->db->order_by('comments.created_at', 'DESC');

//     return $this->db->get()->result();
// }


// For leaders: get all comments for an activity
public function get_comments_by_activity($activityID) {
    $this->db->where('activityID', $activityID);
    $query = $this->db->get('comments');
    return $query->result();
}

// For beneficiaries: get only this user's comments
public function get_comments_for_beneficiary($activityID, $userID) {
    $this->db->where('activityID', $activityID);
    $this->db->where('userID', $userID);
    $query = $this->db->get('comments');
    return $query->result();
}


public function get_comments_for_beneficiary_view($activityID, $userID)
{
    // Fetch leader user IDs
    $this->db->select('userID');
    $this->db->from('project_members');
    $this->db->where('projectRole', 'leader');
    $leaderQuery = $this->db->get_compiled_select();

    $this->db->select('comments.*, users.fullName');
    $this->db->from('comments');
    $this->db->join('users', 'comments.userID = users.userID');
    $this->db->where('comments.activityID', $activityID);
    $this->db->group_start();
        $this->db->where('comments.userID', $userID);
        $this->db->or_where("comments.userID IN ($leaderQuery)", null, false);
    $this->db->group_end();
    $this->db->order_by('comments.created_at', 'DESC');

    return $this->db->get()->result();
}


//try
// Activity_model.php
public function getActivitiesWithCommentsByPhase($phaseID) {
    $this->db->select('a.activityID, a.activityType, a.activityName, c.comment, c.created_at, u.username');
    $this->db->from('activity a');
    $this->db->join('comments c', 'a.activityID = c.activityID', 'left');
    $this->db->join('users u', 'c.userID = u.userID', 'left');
    $this->db->where('a.phaseID', $phaseID);
    $this->db->order_by('a.activityID, c.created_at', 'ASC');
    $query = $this->db->get();
    return $query->result();
}

// Activity_model.php
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
