<?php
class Project_model extends CI_Model {

    // Insert project data into the database
    function add($data) {
        $status = $this->db->insert('project', $data);
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

    // Fetch records associated with a specific project
    public function get_records_by_project_id($projectID) {
        $this->db->select('r.*, u.userName'); // Fetch record details and user's name
        $this->db->from('record r');
        $this->db->join('users u', 'r.userID = u.userID'); // Join with users table
        $this->db->where('r.projectID', $projectID); // Filter by projectID
        $query = $this->db->get();
        return $query->result_array(); // Return records as an array
    }

    // Method to view a project and invite users
    public function view($projectID) {
        // Fetch project details
        $data['project'] = $this->Project_model->get_project_by_id($projectID);

        // Get all users (or limit it as needed)
        $data['users'] = $this->User_model->get_all_users(); // Adjust according to User model method

        // Fetch records for this project
        $data['record'] = $this->Project_model->get_records_by_project_id($projectID);

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

    // Project Leader Invite Project Members
    public function invite_user_to_project($data) {
        return $this->db->insert('projectMembers', $data);
    }

    // Pending invitations from local community
    public function get_pending_invitations_by_user($userID) {
        $this->db->select('pm.*, p.projectName, p.projectLocation');
        $this->db->from('projectMembers pm');
        $this->db->join('project p', 'p.projectID = pm.projectID');
        $this->db->where('pm.userID', $userID);
        $this->db->where('pm.status', 'pending');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_project_members($projectID) {
        $this->db->select('u.userName, u.userEmail, pm.status');
        $this->db->from('projectMembers pm');
        $this->db->join('users u', 'pm.userID = u.userID');
        $this->db->where('pm.projectID', $projectID);
        $query = $this->db->get();
        return $query->result(); // Return list of invited users
    }

    

    public function update_invitation_status($userID, $projectID, $status) {
        $this->db->where('userID', $userID);
        $this->db->where('projectID', $projectID);
        return $this->db->update('projectMembers', ['status' => $status]);
    }
    

    public function get_projects_by_user($userID) {
        $this->db->select('p.*');
        $this->db->from('projectMembers pm');
        $this->db->join('project p', 'p.projectID = pm.projectID');
        $this->db->where('pm.userID', $userID);
        $this->db->where('pm.status', 'accepted');
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>
