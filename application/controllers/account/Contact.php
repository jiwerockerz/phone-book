<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library('Template');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('contact_model');
    if (!$this->session->userdata('logged_in'))
    {
      redirect(site_url('login'));
    }
  }

  public function index()
  {
    $logged_in = $this->session->userdata('logged_in');
    // $userid['user_id'] = $this->session->userdata('logged_in');

    $result = $this->contact_model->getContact(['user_id' => $logged_in['uid']]);
    // $session_array = array(
    // 'uid'  => '1',
    // 'username'  => 'jiwerockerz',
    // 'phone_num' => '01112300461',
    // );
    //
    // $this->session->set_userdata(array('logged_in' => $session_array));
    // var_dump($this->session->userdata('logged_in')['uid']);
    $data = array(
      'contacts' => $result,
    );
    $this->template->load('master', 'pages/home', $data);
  }

  public function add()
  {
    $this->session->set_flashdata('previous_url', current_url());
    $data[] = array();
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('phone-number', 'Phone Number', 'required');
    $this->form_validation->set_rules('group-name', 'Group', 'required');
    $logged_in = $this->session->userdata('logged_in');
    $result_group = $this->contact_model->getGroup(['user_id'=>$logged_in['uid']]);

    $data = array(
      'groups' => $result_group,
    );
    if($this->input->post()){
      if ($this->form_validation->run() == FALSE){

        $this->session->set_flashdata('error', validation_errors());

      }
      else {

        $name = $this->security->xss_clean($this->input->post('name'));
        $phone_num = $this->security->xss_clean($this->input->post('phone-number'));
        $group = $this->security->xss_clean($this->input->post('group-name'));
        $store = array(
        'user_id' => $logged_in['uid'],
        'name' => $name,
        'phone_num' => $phone_num,
        'group_id' => $group
        );

        $result = $this->contact_model->create($store);
        if ($result['status']) {
          echo $result['message'];
          $this->session->set_flashdata('success', $result['message']);

        }else {
          echo $result['message'];
          $this->session->set_flashdata('error', $result['message']);
        }
        redirect(site_url('contact/add-contact'));

      }
    }
    $this->template->load('master', 'pages/add-contact', $data);

  }

  public function newGroup(){
    $this->form_validation->set_rules('group-name', 'Group Name', 'required');

    if($this->input->post()){
      if ($this->form_validation->run() == FALSE){

        $this->session->set_flashdata('error', validation_errors());

      }
      else {
        $logged_in = $this->session->userdata('logged_in');

        $groupName = $this->security->xss_clean($this->input->post('group-name'));

        $data = array(
        'user_id' => $logged_in['uid'],
        'group_name' => $groupName,
        );

        $result = $this->contact_model->setGroup($data);
        if ($result['status']) {
          echo $result['message'];
          $this->session->set_flashdata('success', $result['message']);

        }else {
          echo $result['message'];
          $this->session->set_flashdata('error', $result['message']);
        }

      }
      redirect($this->session->flashdata('previous_url'));
    }
    show_404();
  }

  public function deleteContact(){
    $this->form_validation->set_rules('user-id', 'User ID', 'required');

    if($this->input->post()){
      echo "string";
      if ($this->form_validation->run() == FALSE){

        $this->session->set_flashdata('error', validation_errors());

      }
      else {
        $logged_in = $this->session->userdata('logged_in');

        $deleteID = $this->security->xss_clean($this->input->post('user-id'));
        // var_dump($deleteID);
        $data = array(
        'user_id' => $logged_in['uid'],
        'id' => $deleteID,
        );

        $result = $this->contact_model->delete($data);
        if ($result['status']) {
          echo $result['message'];
          $this->session->set_flashdata('success', $result['message']);

        }else {
          echo $result['message'];
          $this->session->set_flashdata('error', $result['message']);
        }
      }

      redirect(site_url('contact'));
    }
    show_404();

  }

  public function editContact($id=''){
    $this->session->set_flashdata('previous_url', current_url());
    $logged_in = $this->session->userdata('logged_in');

    $user['id'] = $id;
    $user['user_id'] = $logged_in['uid'];

    $result = $this->contact_model->getContact($user);
    if (!$result) {
      show_404();
    }
    $result_group = $this->contact_model->getGroup(array('user_id' => $user['user_id']));

    $user['id'] = $result[0]['group_id'];
    $group = $this->contact_model->getGroup($user);
    if (!$group) {
      $groups = "None";
    }
    else {
      $groups = $group[0]['group_name'];
    }
    $data = array(
    'contacts' => $result[0],
    // 'result_groups' => $result_group,
    'groups' => $result_group,
    );

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('phone-number', 'Phone Number', 'required');
    $this->form_validation->set_rules('group-name', 'Group', 'required');
    if($this->input->post()){
      if ($this->form_validation->run() == FALSE){

        $this->session->set_flashdata('error', validation_errors());

      }
      else {

        $name = $this->security->xss_clean($this->input->post('name'));
        $phone_num = $this->security->xss_clean($this->input->post('phone-number'));
        $group = $this->security->xss_clean($this->input->post('group-name'));
        $userData = array(
        'id' => $id,
        'user_id' => $logged_in['uid'],
        'name' => $name,
        'phone_num' => $phone_num,
        'group_id' => $group
        );

        $result = $this->contact_model->update($userData);
        if ($result['status']) {
          echo $result['message'];
          $this->session->set_flashdata('success', $result['message']);

        }else {
          echo $result['message'];
          $this->session->set_flashdata('error', $result['message']);
        }
        redirect($this->session->flashdata('previous_url'));
      }
    }
    $this->template->load('master', 'pages/edit_contact', $data);

  }

  public function viewContact($id=''){
    $logged_in = $this->session->userdata('logged_in');

    $user['id'] = $id;
    $user['user_id'] = $logged_in['uid'];

    $result = $this->contact_model->getContact($user);
    if (!$result) {
      show_404();
    }
    $user['id'] = $result[0]['group_id'];
    $group = $this->contact_model->getGroup($user);
    if (!$group) {
      $groups = "None";
    }
    else {
      $groups = $group[0]['group_name'];
    }
    $data = array(
    'contacts' => $result[0],
    'groups' => $groups,
    );
    $this->template->load('master', 'pages/view_contact', $data);

  }


}
