<?php
class Phase_model extends CI_Model {

    // Insert a new phase into the database
    public function add_phase($data) {
        return $this->db->insert('phase', $data);
    }

    // Get all phases for a specific project
    public function get_phase($projectID) {
        $this->db->where('projectID', $projectID);
        $query = $this->db->get('phase');
        return $query->result(); // Ensure it returns an array of results
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

    public function get_phases_by_project($projectID)
    {
    $this->db->where('projectID', $projectID);
    return $this->db->get('phase')->result();
    }

    //phase automatically prefixed and auto-increment
    public function get_phase_count_by_project($projectID) {
    $this->db->where('projectID', $projectID);
    return $this->db->count_all_results('phase');
}




}
?>
