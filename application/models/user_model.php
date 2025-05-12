<?php
   class user_model extends CI_Model {
      public function insert_data($data) {
        return $this->db->insert('users',$data);
      }

      public function get_all_users() {
         $query = $this->db->get('users');  // Assuming you have a 'users' table
         return $query->result_array();  // Return all users as an array
     }

     public function get_beneficiary_users() {
      $this->db->where('userRole', 'Beneficiary');
      $query = $this->db->get('users');
      return $query->result();
  }
  
     
   }
