<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nimrod
 * Date: 02/13/15
 * Time: 16:11
 */

class Curl
{
	protected $_ci;
	protected $url;
	protected $session;
	protected $response;
	protected $info;

	public $error_code;
	public $error_string;

	function __construct($url = '')
	{
		$this->_ci = & get_instance();
		log_message('debug', 'cURL Class Initialized');

		if (! $this->is_enabled())
			log_message('error', 'cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.');

		$this->create($url);
	}

	public function create($url)
	{
		$this->set_defaults();

		// If no a protocol in URL, assume its a CI link
		if ( ! preg_match('!^\w+://! i', $url))
		{
			$this->_ci->load->helper('url');
			$url = site_url($url);
		}

		$this->url = $url;
		$this->session = curl_init();
		$this->option(CURLOPT_URL, $this->url);


		return $this;
	}

	public function set_defaults()
	{
		$this->session = NULL;
		$this->response = '';
		$this->error_code = NULL;
		$this->error_string = '';
	}

	public function login($username = '', $password = '', $type = 'any')
	{
		$this->option(CURLOPT_HTTPAUTH, constant('CURLAUTH_' . strtoupper($type)));
		$this->option(CURLOPT_USERPWD, $username . ':' . $password);
		return $this;
	}

	public function option($key, $value)
	{
		curl_setopt($this->session, $key, $value);
	}

	public function post($params = array())
	{
		// Add in the specific options provided
		$this->option(CURLOPT_HEADER, 0);
		$this->option(CURLOPT_VERBOSE, 0);
		//have to put it before post params, and also in execute() function for non-post requests.
		$this->option(CURLOPT_RETURNTRANSFER, true);
		$this->option(CURLOPT_POST, true);
		$this->option(CURLOPT_POSTFIELDS, $params);
	}

	public function is_enabled()
	{
		return function_exists('curl_init');
	}

	public function execute()
	{
		// Set two default options, and merge any extra ones in
		$this->option(CURLOPT_FAILONERROR,TRUE);
		$this->option(CURLOPT_RETURNTRANSFER, true);

		// Only set follow location if not running securely
		if ( ! ini_get('safe_mode') && ! ini_get('open_basedir'))
			$this->option(CURLOPT_FOLLOWLOCATION,TRUE);

		// Execute the request & and hide all output
		$this->response = curl_exec($this->session);
		$this->info = curl_getinfo($this->session);

		// Request failed
		if ($this->response === FALSE)
		{
			$errno = curl_errno($this->session);
			$error = curl_error($this->session);

			curl_close($this->session);
			$this->set_defaults();

			$this->error_code = $errno;
			$this->error_string = $error;

			return FALSE;
		}

		// Request successful
		else
		{
			curl_close($this->session);
			return $this->response;
		}
	}

	public function whole($url,$files,$username,$password,$from,$to,$subject,$html)
	{
		$this->create($url);
		$this->login($username,$password);

		$post = array(
			"from" => $from,
			"to" => $to,
			"subject" => $subject,
			"text" => "text version",
			"html" => $html
		);

		for($i = 0; $i < count($files); $i++)
			$post["inline[".$i."]"] = '@'.$files[$i]["path"];

		$this->post($post);

		return $this->execute();
	}
}