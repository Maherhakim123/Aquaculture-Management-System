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

    // Fetch all record
    public function get_all_records() {
        $query = $this->db->get('record'); // Fetch all records from the table
        return $query->result_array(); // Return the result as an array
    }

    // Fetch records by userID
    public function get_record_by_user_id($userID) {
        $query = $this->db->get_where('record', array('userID' => $userID)); // Fetch records by userID
        return $query->result_array(); // Return the result as an array
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
}
?>
