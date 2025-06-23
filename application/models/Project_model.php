<?php
class Project_model extends CI_Model {

    // Insert project data into the database
    function add($data) {
        $status = $this->db->insert('project', $data);
        return $status;
    }

    // List Project for Admin PPJIM Overview
   public function get_all_projects() {
    $this->db->select('project.*, users.userName');
    $this->db->from('project');
    $this->db->join('users', 'users.userID = project.userID'); 
    $query = $this->db->get();
    return $query->result();
}

    // Count all projects for dashboard (For Admin PPJIM)
    public function count_all_projects() {
        return $this->db->count_all('project');
    }

    //Projects where the user is the leader
    public function get_projects_by_leader($userID) {
        return $this->db->get_where('project', ['userID' => $userID])->result();
    }
    
    //Count in-progress projects 
    public function count_projects_by_leader($userID){
    return $this->db->where('userID', $userID)->count_all_results('project');
    }

    // Count in-progress projects (at least one phase < 100%)
    public function count_in_progress_projects($leaderID) {
    $this->load->model('Phase_model');
    $projects = $this->get_projects_by_leader($leaderID);
    $inProgressCount = 0;

    foreach ($projects as $project) {
        $phases = $this->Phase_model->get_phases_by_project($project->projectID);

        foreach ($phases as $phase) {
            if ($phase->progress < 100) {
                $inProgressCount++;
                break; // Count project only once
            }
        }
    }

    return $inProgressCount;
}

public function count_completed_projects($leaderID) {
    $this->load->model('Phase_model');
    $this->load->model('Activity_model');

    $projects = $this->get_projects_by_leader($leaderID);
    $completed = 0;

    foreach ($projects as $project) {
        $phases = $this->Phase_model->get_phases_by_project($project->projectID);
        $all_completed = true;

        foreach ($phases as $phase) {
            $totalActivities = $this->Activity_model->countActivitiesByPhase($phase->phaseID);
            $completedActivities = $this->Activity_model->countCompletedActivitiesByPhase($phase->phaseID);
            $progress = ($totalActivities > 0) ? round(($completedActivities / $totalActivities) * 100) : 0;

            if ($progress < 100) {
                $all_completed = false;
                break;
            }
        }

        if ($all_completed && count($phases) > 0) {
            $completed++;
        }
    }

    return $completed;
}



    public function count_projects_by_member($userID) {
        $this->db->where('userID', $userID);
        $query = $this->db->get('project');
        return $query->num_rows();
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
        // Include userID in the select statement
        $this->db->select('u.userID, u.userName, u.userEmail, pm.status');
        $this->db->from('projectMembers pm');
        $this->db->join('users u', 'pm.userID = u.userID');
        $this->db->where('pm.projectID', $projectID);
        $query = $this->db->get();
        return $query->result(); // Return list of invited users with userID
    }
    

    public function update_invitation_status($userID, $projectID, $status) {
        $this->db->where('userID', $userID);
        $this->db->where('projectID', $projectID);
        return $this->db->update('projectMembers', ['status' => $status]);
    }
    
    //Projects where the user is a member
    public function get_projects_by_user($userID) {
        $this->db->select('p.*');
        $this->db->from('projectMembers pm');
        $this->db->join('project p', 'p.projectID = pm.projectID');
        $this->db->where('pm.userID', $userID);
        $this->db->where('pm.status', 'accepted');
        $query = $this->db->get();
        return $query->result();
    }

    public function remove_project_member($projectID, $userID)
{
    $this->db->where('projectID', $projectID);
    $this->db->where('userID', $userID);
    $this->db->delete('projectmembers');
}


// Check if the user is already invited to the project
public function is_user_already_invited($projectID, $userID) {
    $this->db->where('projectID', $projectID);
    $this->db->where('userID', $userID);
    $query = $this->db->get('projectMembers');

    return $query->num_rows() > 0;
}

//return to dashboard
public function count_projects_by_user($userID)
{
    $this->db->from('projectMembers');
    $this->db->where('userID', $userID);
    return $this->db->count_all_results();
}

    
}
?>
