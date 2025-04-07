<?php
   class user_model extends CI_Model {
      public function insert_data($data) {
        return $this->db->insert('users',$data);
      }

      public function get_all_users() {
         $query = $this->db->get('users');  // Assuming you have a 'users' table
         return $query->result_array();  // Return all users as an array
     }

     public function get_local_community_users() {
      $this->db->where('userRole', 'Local Community');
      $query = $this->db->get('users');
      return $query->result();
  }
  
     
   }
