<?php
class Project_model extends CI_Model {

    // Insert project data into the database
    function add($data){
        $status = $this->db->insert('project',$data);
        return $status;
    }

    public function get_all_projects() {
        $query = $this->db->get('project'); // Fetch data from the 'project' table
        return $query->result(); // Return results as an array of objects
    }


     // Get a single project by its ID
     public function get_project_by_id($projectID) {
        $query = $this->db->get_where('project', ['projectID' => $projectID]);
        return $query->row(); // Return a single row object
    }

    // Update a project
    public function update_project($projectID, $data) {
        $this->db->where('projectID', $projectID);
        return $this->db->update('project', $data); // Update the project
    }

    // Delete a project
    public function delete_project($projectID) {
        $this->db->where('projectID', $projectID);
        return $this->db->delete('project'); // Delete the project
    }
}










