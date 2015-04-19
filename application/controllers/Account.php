<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Your own constructor code
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array(
			"user" => $this->session->user,
			"mgAPIKey" => $this->aauth->get_user_var("mgAPIKey",$this->session->user->id)
		);
		$this->load->view('head');
		$this->load->view('account',$data);
		$this->load->view('footer');
	}

	public function save()
	{
		try {
			$result = array();

			$user = $this->session->user;

			$email = $this->input->post("txtEmail");
			$name = $this->input->post("txtName");
			$password = trim($this->input->post("txtPassword"));
			$mgApiKey = $this->input->post("txtMailgunAPIKey");

			$password = strlen($password) == 0 ? false : $this->aauth->hash_password($password, $user->id);

			$this->aauth->update_user($user->id, $email, $password, $name);

			$this->aauth->set_user_var("mgAPIKey", $mgApiKey, $user->id);

			//update the session user
			$user->name = $name;
			$user->email = $email;

			$result["success"] = true;
			$result["message"] = "Operation completed successfully";
		}
		catch(Exception $ex)
		{
			$result["error"] = "Incorrect username or password";
		}

		echo json_encode($result);
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect(base_url()."login");
	}

}
