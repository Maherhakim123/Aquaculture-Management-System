<?php
   class Register_model extends CI_Model {
      public function insert_data($data) {
        return $this->db->insert('projectleader',$data);
      }

      function add($data){
        $status = $this->db->insert('projectleader',$data);
        return $status;
      }


      public function get_user_by_email($leaderEmail)
      {
    $query = $this->db->get_where('projectleader', ['leaderEmail' => $leaderEmail]);
    return $query->row(); // Returns the user object or null
      }




   }
