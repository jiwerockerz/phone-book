<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Contact_model extends CI_Model {

  protected $contact_tbl = 'contacts';
  protected $user_tbl = 'users';
  protected $group_tbl = 'groups';

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function getGroup($data=''){
    $query = $this->db->get_where($this->group_tbl, $data);
    return $query->result_array();
  }

  function chkGroup($uid='', $gName=''){
    $query = $this->db
    ->from($this->group_tbl)
    ->where('user_id', $uid)
    ->where('group_name', $gName);

    $result = $query->get()->result();

    // return true means already used
    return $result;
  }

  function setGroup($data=''){
    if(!$this->chkGroup($data['user_id'], $data['group_name'])){
      if($this->db->insert($this->group_tbl, $data)) {
        return [
            'status' => TRUE,
            'message' => 'Group created!'
        ];
      }else {
        return [
          'status' => FALSE,
          'message' => 'Failed to create group!'
        ];
      }

    }else {
      return [
        'status' => FALSE,
        'message' => 'A group with that name already exists'
      ];
    }
  }

  function getContact($data=''){
    $query = $this->db->get_where($this->contact_tbl, $data);
    return $query->result_array();
  }

  function chk_user($name='', $userid='') {
    $query = $this->db
    ->from($this->contact_tbl)
    ->where('name', $name)
    ->where('user_id', $userid);

    $result = $query->get()->result();

    // return true means already used
    return $result;
  }

  function create($data='') {
    if(!$this->chk_user($data['name'], $data['user_id'])){
      if($this->db->insert($this->contact_tbl, $data)) {
        return [
          'status' => TRUE,
          'message' => 'Contact saved!'
        ];

      }else {
        return [
          'status' => FALSE,
          'message' => 'Failed to save contact!'
        ];
      }

    }else {
      return [
        'status' => FALSE,
        'message' => 'Name already used!'
      ];
    }
  }

  function delete($data=''){
    $query = $this->db
    ->where('id', $data['id'])
    ->where('user_id', $data['user_id'])
    ->delete($this->contact_tbl);

    if($query) {
      return [
        'status' => TRUE,
        'message' => 'Deleted contact successfully!'
      ];
    }else {
      return [
        'status' => FALSE,
        'message' => 'Failed to delete contact!'
      ];
    }
  }

  function update($data='') {
    $query = $this->db
    ->where('id', $data['id'])
    ->where('user_id', $data['user_id'])
    ->update($this->contact_tbl, $data);

    if($query) {
      return [
        'status' => TRUE,
        'message' => 'Updated contact successfully!'
      ];
    }else {
      return [
        'status' => FALSE,
        'message' => 'Failed to update contact!'
      ];
    }
  }


}
