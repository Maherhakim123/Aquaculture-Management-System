<?php
   class user_model extends CI_Model {
      public function insert_data($data) {
        return $this->db->insert('users',$data);
      }

      // Admin PPJIM can retrieve all users info.
       public function get_all_users() {
        // Exclude users with role 'Admin PPJIM'
        $this->db->where('userRole !=', 'Admin PPJIM');
        $query = $this->db->get('users');
        return $query->result();
    }

     // Count all non-admin users for dashboard (Admin PPJIM)
    public function count_all_users() {
        $this->db->where('userRole !=', 'Admin PPJIM');
        return $this->db->count_all_results('users');
    }

     public function get_beneficiary_users() {
      $this->db->where('userRole', 'Beneficiary');
      $query = $this->db->get('users');
      return $query->result();
  }

  // Admin PPJIM can delete user in this system
  public function delete_user($userID) {
    $this->db->where('userID', $userID);
    return $this->db->delete('users');
}

  
     
   }
