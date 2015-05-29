<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller {

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
		$this->load->helper("utils");

//		$this->output->cache(240);

		$lists = $this->mailgun->lists();
		$domains = $this->mailgun->domains();

		$data = array('lists' => $lists ? $lists->items : Array(),
			'domains' => $domains ? $domains->items : array(),
			'tempDir' => Utils::generateRandomString());

		$this->load->view('head');
		$this->load->view('send',$data);
		$this->load->view('footer');
	}

	public function send()
	{
		$from = $this->input->post('txtFromName');
		$from .= " <".$this->input->post('txtFromEmail').">";
		$to = $this->input->post('rbListAddress');
		$subject = $this->input->post('txtSubject');
		$domain = $this->input->post('rbDomain');
		$message = $this->input->post('txtSterilized');
		$textVersion = $this->input->post('txtTextVersion');
		$tempDir = $this->input->post('tempDir');

		$message = base64_decode($message);

		//find all cid images and inline them
		$files = array();

		$count = preg_match_all("/<img.+?src=(?:['\"]cid:(.*?)[\"']|cid:(.*?)\s).*?>/",
			$message, $files );

		if($count > 0)
		{
			$files = $files[1];

			$sep = DIRECTORY_SEPARATOR;
			for ($i = 0; $i < count($files); $i++) {
				$files[$i] = array("path" => dirname(__FILE__) . $sep . ".." . $sep . ".." . $sep . "img" . $sep . "temp" . $sep . $tempDir . "/" . $files[$i],
					"name" => $files[$i]);
				$finfo = finfo_open(FILEINFO_MIME_TYPE);
				$files[$i]["mime"] = finfo_file($finfo, $files[$i]["path"]);
			}
		}
		else
			$files = array();

		$result = $this->mailgun->message($domain,$from,$to,$subject,$message,$textVersion,$files);

		if($result["success"] === false)
			header('HTTP/1.0 400 Bad Request', true, 400);
		echo json_encode($result);
	}

	public function uploadImages()
	{
		$data = array();

		$sep = DIRECTORY_SEPARATOR;

		$tempDir = dirname(__FILE__).$sep."..".$sep."..".$sep."img".$sep."temp".$sep.$this->input->post("tempDir");

		//save files to an email folder
		if(!is_dir($tempDir) && !mkdir($tempDir))
		{
			$data["error"] = "failed to create temporary directory";
			$data["success"] = false;
			header('HTTP/1.0 400 Bad Request',true,400);
			return;
		}

		foreach ($_FILES as $key => $value)
		{
			$name = $_FILES[$key]["name"];
			$tmpName = $_FILES[$key]["tmp_name"];
			move_uploaded_file($tmpName, $tempDir.$sep.$name);
		}

		$data["success"] = true;
		echo json_encode($data);
	}

	public function uploadImagesProgress()
	{
		return 1;
	}
}
