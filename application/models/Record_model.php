<?php
class Record_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert a new record
    public function insert_record($data) {
        return $this->db->insert('record', $data);
    }

    public function get_all_records_userID() {
        $this->db->select('record.*, users.userName'); // select record fields and user's name
        $this->db->from('record');
        $this->db->join('users', 'users.userID = record.userID'); // join with user table
        $query = $this->db->get();
        return $query->result_array();
    }
    

    // Fetch records by userID
    public function get_record_by_user_id($userID) {
        $query = $this->db->get_where('record', array('userID' => $userID)); // Fetch records by userID
        return $query->result_array(); // Return the result as an array
    }

    // isi balik
    public function get_record_by_user_and_project($userID, $projectID)
{
    $this->db->where('userID', $userID);
    $this->db->where('projectID', $projectID);
    $query = $this->db->get('record');
    return $query->result_array();
}



    // Update a record
    public function update_record($recordID, $data) {
        $this->db->where('recordID', $recordID);
        return $this->db->update('record', $data);
    }

    // Delete a record
    public function delete_record($recordID) {
        $this->db->where('recordID', $recordID);
        return $this->db->delete('record');
    }

    // Fetch records by projectID
public function get_record_by_project_id($projectID) {
    $this->db->select('record.*, users.userName'); // Select record fields and user's name
    $this->db->from('record');
    $this->db->join('users', 'users.userID = record.userID'); // Join with the users table
    $this->db->where('record.projectID', $projectID); // Filter by projectID
    $query = $this->db->get();
    return $query->result_array(); // Return the result as an array
}

public function get_record_by_project_id_with_user($projectID) {
    $this->db->select('record.*, users.userName');  // Corrected table name here
    $this->db->from('record');  // Corrected table name here
    $this->db->join('users', 'users.userID = record.userID'); // Corrected table name here
    $this->db->where('record.projectID', $projectID);  // Corrected table name here
    $query = $this->db->get();
    return $query->result_array();
}


public function get_records_by_project($projectID)
{
    $this->db->select('record.*, users.userName');
    $this->db->from('record');
    $this->db->join('users', 'users.userID = record.userID');
    $this->db->where('record.projectID', $projectID);
    return $this->db->get()->result_array();
}






}
?>
