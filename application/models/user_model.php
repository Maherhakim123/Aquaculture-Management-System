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

public function get_user_by_email($email)
{
    return $this->db->get_where('users', ['userEmail' => $email])->row();
}

public function store_reset_token($email, $token)
{
    $data = [
        'reset_token' => $token,
        'token_created_at' => date('Y-m-d H:i:s'),
    ];
    $this->db->where('userEmail', $email);
    return $this->db->update('users', $data);
}


// Validate token
public function is_valid_token($token)
{
    $this->db->where('reset_token', $token);
    $user = $this->db->get('users')->row();

    if ($user) {
        $created_at = strtotime($user->token_created_at);
        return (time() - $created_at) < (60 * 60); // valid for 1 hour
    }

    return false;
}

// Update password by token
public function update_password_by_token($token, $new_password)
{
    $this->db->where('reset_token', $token);
    $this->db->update('users', [
        'userPassword' => $new_password,
        'reset_token' => null,
        'token_created_at' => null
    ]);
}




  
     
}
