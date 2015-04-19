<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Your own constructor code
	}

	public function index()
	{
		if($this->input->post('txtEmail'))
			$this->doSignup();
		else
		{
			$this->load->view('public_head');
			$this->load->view('signup');
			$this->load->view('footer');
		}
	}

	private function doSignup()
	{
		$result = array();

		$email = $this->input->post("txtEmail");
		$password = $this->input->post("txtPassword");

		$userId = $this->aauth->get_user_id($email);

		$fail = false;
		//check if there is such a user.
		if($userId === false)
		{
			$result["error"] = "Incorrect username or password";
			$fail = true;
		}

		if(!$fail)
		{
			//check if the user id exist
			$user = $this->aauth->get_user($userId);

			if ($user === false)
			{
				$result["error"] = "Incorrect username or password";
				$fail = true;
			}
		}

		if(!$fail)
		{
			//check that the passwords match
			$hash = $this->aauth->hash_password($password,$userId);
			if($hash != $user->pass)
			{
				$result["error"] = "Incorrect username or password";
				$fail = true;
			}

		}

		if($fail)
		{
			$this->load->view('public_head');
			$this->load->view('signup',$result);
			$this->load->view('footer');
		}
		else
		{
			$this->session->user = $user;
			redirect(base_url());
		}
	}
}
