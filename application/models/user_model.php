<?php
   class user_model extends CI_Model {
      public function insert_data($data) {
        return $this->db->insert('users',$data);
      }
   }
