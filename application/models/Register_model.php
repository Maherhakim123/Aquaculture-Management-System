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

    public function update_user_password($userID, $hashedPassword) {
    $this->db->where('userID', $userID);
    $this->db->update('users', ['userPassword' => $hashedPassword]);
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
