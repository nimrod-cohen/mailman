<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

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
		$ver = $this->aauth->get_system_var("mailman_version");

		if($ver >= 1)
		{
			redirect(base_url());
			die;

		}

		$this->load->view('public_head');
		$this->load->view('setup');
		$this->load->view('footer');
	}

	public function install()
	{
		$ver = $this->aauth->get_system_var("mailman_version");
		if($ver >= 1)
		{
			$data["error"] = "System is installed already";
			$data["success"] = true;
			echo json_encode($data);
			return;
		}

		$name = $this->input->post('txtAdminName');
		$email = $this->input->post('txtAdminMail');
		$password = $this->input->post('txtAdminPassword');

		$this->aauth->update_user(1,$email,$password,$name);

		$this->aauth->set_system_var("mailman_version",1);

		$user = $this->aauth->get_user(1);

		$this->session->user = $user;

		$arr = array("message" => "Operation completed successfully");

		echo json_encode($arr);
	}
}
