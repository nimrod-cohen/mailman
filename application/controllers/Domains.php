<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domains extends CI_Controller {

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
		$this->output->cache(240);

		$domains = $this->mailgun->domains();

		$data = array('domains' => $domains->items);

		$this->load->view('head');
		$this->load->view('domains',$data);
		$this->load->view('footer');
	}
}
