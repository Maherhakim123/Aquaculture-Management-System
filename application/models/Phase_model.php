<?php
class Phase_model extends CI_Model {

    // Insert a new phase into the database
    public function add_phase($data) {
        return $this->db->insert('phase', $data);
    }

    // Get all phases for a specific project
    public function get_phase($projectID) {
        return $this->db->where('projectID', $projectID)->get('phase')->result();
    }

    // Get a single phase by its ID
    public function get_phase_by_id($phaseID) {
        return $this->db->get_where('phase', ['phaseID' => $phaseID])->row();
    }

    // Update a phase by its ID
    public function update($phaseID, $data) {
        return $this->db->where('phaseID', $phaseID)->update('phase', $data);
    }

    // Delete a phase by its ID
    public function delete_phase($phaseID) {
        return $this->db->where('phaseID', $phaseID)->delete('phase');
    }
}
?>
