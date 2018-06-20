<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppressions extends CI_Controller {

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
		$this->load->view('suppressions',$data);
		$this->load->view('footer');
	}

	public function upload()
	{
		$domain = $this->input->post('rbDomain');
		$suppressionType = $this->input->post('rbSuppressionType');
		$reason = $this->input->post('txtReason');
		$skipRows = $this->input->post('txtSkipRows');

		$file = $_FILES["file"];

		$addresses = [];

		ini_set('auto_detect_line_endings',TRUE);
		$handle = fopen($file["tmp_name"],'r');
		while($skipRows) {
			$data = fgetcsv($handle); //skipping first line.
			$skipRows--;
		}

		while ( ($data = fgetcsv($handle) ) !== FALSE )
		{
			$addresses[] = $data[0];
		}
		fclose($handle);

		ini_set('auto_detect_line_endings',FALSE);

		$result = $this->mailgun->suppress($domain,$suppressionType,$addresses,$reason);

		echo json_encode($result);
		die;
	}
}
