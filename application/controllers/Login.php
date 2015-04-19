<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Your own constructor code
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->input->post('txtEmail'))
			$this->doLogin();
		else
		{
			$this->load->view('public_head');
			$this->load->view('login');
			$this->load->view('footer');
		}

	}

	private function doLogin()
	{
		$result = array();

		try
		{
			$email = $this->input->post("txtEmail");
			$password = $this->input->post("txtPassword");

			$userId = $this->aauth->get_user_id($email);

			//check if there is such a user.
			if ($userId === false)
				throw new Exception("Incorrect username or password");

			//check if the user id exist
			$user = $this->aauth->get_user($userId);

			if ($user === false)
				throw new Exception("Incorrect username or password");

			//check that the passwords match
			$hash = $this->aauth->hash_password($password, $userId);
			if ($hash != $user->pass)
				throw new Exception("Incorrect username or password");

			$this->session->user = $user;
			redirect(base_url());
		}
		catch(Exception $ex)
		{
			$result["error"] = $ex->getMessage();
			$this->load->view('public_head');
			$this->load->view('login',$result);
			$this->load->view('footer');
		}
	}
}
