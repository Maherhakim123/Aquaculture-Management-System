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

    // Update phase data
    public function update_phase($phaseID, $data)
    {
        $this->db->where('phaseID', $phaseID);
        return $this->db->update('phase', $data);
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

    // Show all Phases
    public function get_all_phases() {
        $query = $this->db->get('phase');
        return $query->result();
    }


    /**  Return the first phaseID for a project, or NULL if none [FOR COMMENT BENEFICIARY] */
public function get_first_phase_id($projectID)
{
    return $this->db->select('phaseID')
                    ->from('phase')
                    ->where('projectID', $projectID)
                    ->order_by('phaseID', 'ASC')   // or order_by('startDate','ASC')
                    ->limit(1)
                    ->get()
                    ->row('phaseID');              // returns null if no row
}

public function get_phases_with_progress($projectID) {
    $phases = $this->get_phase($projectID);

    foreach ($phases as &$phase) {
        $total = $this->Activity_model->countActivitiesByPhase($phase->phaseID);
        $completed = $this->Activity_model->countCompletedActivitiesByPhase($phase->phaseID);

        $phase->progress = $total > 0 ? round(($completed / $total) * 100) : 0;
        $phase->totalActivities = $total;
        $phase->completedActivities = $completed;
    }

    return $phases;
}

public function update_progress_and_status($phaseID, $progress) {
    $status = 'not_started';
    if ($progress == 100) {
        $status = 'completed';
    } elseif ($progress > 0) {
        $status = 'in_progress';
    }

    $data = [
        'progress' => $progress,
        'status' => $status
    ];

    $this->db->where('phaseID', $phaseID);
    return $this->db->update('phase', $data);
}


}
?>
