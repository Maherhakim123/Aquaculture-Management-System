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

     // Method to view a project and invite users
     public function view($projectID) {
        // Fetch project details
        $data['project'] = $this->Project_model->get_project_by_id($projectID);

        // Get all users (or limit it as needed)
        $data['users'] = $this->User_model->get_all_users(); // Adjust according to your User model method

        // Load the view
        $this->load->view('view_project', $data);
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

    public function invite_user_to_project($data) {
        return $this->db->insert('projectMembers', $data);
    }

    
    
}










