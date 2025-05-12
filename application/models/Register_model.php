<?php
class Register_model extends CI_Model {

    public function insert_data($data) {
        return $this->db->insert('users', $data);
    }

    public function add($data) {
        return $this->db->insert('users', $data);
    }

    // Check email exist
    public function email_exists($userEmail){
        $this->db->where('userEmail', $userEmail);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function get_user_by_email($userEmail) {
        $query = $this->db->get_where('users', ['userEmail' => $userEmail]);
        return $query->row(); // Returns the user object or null
    }

    public function get_user_by_id($userID) {
        $query = $this->db->get_where('users', ['userID' => $userID]);
        return $query->row(); // This returns a single row object for the user
    }

    public function update_user($userID, $data) {
      $this->db->where('userID', $userID);
      return $this->db->update('users', $data);
    }

    public function delete_user($userID) {
      $this->db->where('userID', $userID);
      return $this->db->delete('users');
    }
  
}
