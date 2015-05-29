<?php
/**
 * Created by PhpStorm.
 * User: nimrod
 * Date: 02/04/15
 * Time: 17:31
 */

class Mailgun {

	private $curl;
	private $apiKey;

	const apiEndpoint = "https://api.mailgun.net/v3/";

	public function __construct()
	{
		$_ci =& get_instance();

		$_ci->load->library('aauth');

		$this->curl = $_ci->curl;
		if($_ci->session->user != null )
			$this->apiKey = $_ci->aauth->get_user_var("mgAPIKey",$_ci->session->user->id);
	}

	function lists()
	{
		$this->curl->create(Mailgun::apiEndpoint."lists");

		$this->curl->login('api', $this->apiKey);

		$result = $this->curl->execute();

		return json_decode($result);
	}

	function domains()
	{
		$this->curl->create(Mailgun::apiEndpoint."domains");

		$this->curl->login('api', $this->apiKey);

		$result = $this->curl->execute();

		return json_decode($result);
	}

	function message($domain,$from, $to,$subject,$html,$text,$files )
	{
		$this->curl->create(Mailgun::apiEndpoint.$domain."/messages");
		$this->curl->login("api",$this->apiKey);

		$post = array(
			"from" => $from,
			"to" => $to,
			"subject" => $subject,
			"text" => $text,
			"html" => $html
		);

		for($i = 0; $i < count($files); $i++) {
			if(function_exists('curl_file_create'))
				$post["inline[" . $i . "]"] = new CURLFile($files[$i]["path"],$files[$i]["mime"]);
			else
				$post["inline[" . $i . "]"] = '@' . $files[$i]["path"];
		}
		$this->curl->post($post);

		$result = $this->curl->execute();

		if(!$result)
			$result = array("error" => "Email sending failed: ".$this->curl->error_string,"success" => false);
		else
		{
			$result = json_decode($result,true);
			$result["success"] = true;
		}

		return $result;
	}
}