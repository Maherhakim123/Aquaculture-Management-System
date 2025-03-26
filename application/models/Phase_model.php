<?php
class Phase_model extends CI_Model {

    // Insert a new phase into the database
    function add_phase($data) {
        $status = $this->db->insert('phase', $data);
        return $status;
    }


    // Get all phase for a specific project
    public function get_phase($projectID) {
        $this->db->where('projectID', $projectID);
        $query = $this->db->get('phase');
        return $query->result();
    }
    

    // Get a single phase by its ID
    public function get_phase_by_id($phaseID) {
        $query = $this->db->get_where('phase', ['phaseID' => $phaseID]);
        return $query->row(); // Return a single row object
    }

    // Update a phase by its ID
    public function update($phaseID, $data) {
        $this->db->where('phaseID', $phaseID);
        return $this->db->update('phase', $data); // Update the phase
    }

    // Delete a phase by its ID
    public function delete($phaseID) {
        $this->db->where('phaseID', $phaseID);
        return $this->db->delete('phase'); // Delete the phase
    }
}










