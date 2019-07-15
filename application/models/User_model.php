<?php
class User_model extends CI_Model {
    protected $user_tbl = "users";
    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function insert_user($userData='') {
        return $this->db->insert($this->user_tbl, $userData);
    }

    public function check_login($userData='') {

        $query = $this->db->get_where($this->user_tbl, array('username' => $userData['username']));
        if ($this->db->affected_rows() > 0) {
            $password = $query->row('password');

            if ($userData['password'] === $password) {

                return [
                    'status' => TRUE,
                    'data' => $query->row(),
                ];
            } else {
                return [
                  'status' => FALSE,
                  'data' => FALSE
                ];
            }
        } else {
            return [
              'status' => FALSE,
              'data' => FALSE
            ];
        }
    }
}
