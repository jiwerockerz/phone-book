<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('Template');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('form_validation');

	}


	public function login()
	{
		if ($this->session->userdata('logged_in'))
		{
			redirect(site_url('contact'));
		}

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->input->post()){

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());

		}
		else
		{
			$login_data = array(
				'username' => $this->security->xss_clean($this->input->post('username')),
				'password' => $this->security->xss_clean($this->input->post('password')),
			);

			$result = $this->user_model->check_login($login_data);
			if (!empty($result['status']) && $result['status'] === TRUE) {

				$session_array = array(
				'uid'  => $result['data']->id,
				'username'  => $result['data']->username,
				'phone_num' => $result['data']->email,
				);

				$this->session->set_userdata(array('logged_in' => $session_array));
				$this->session->set_flashdata('success', 'Login Success');
				redirect(site_url('contact'));
			} else {
				$this->session->set_flashdata('error', 'Invalid Username/Password.');
				redirect(site_url('login'));
			}
		}
	}

		$data = array();
		$this->template->load('master', 'auth/login', $data);

	}

	public function logout(){

		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}
}
