<?php
/**
 * Created by PhpStorm.
 * User: nimrod
 * Date: 02/18/15
 * Time: 18:18
 */

if ( ! function_exists('auth_test'))
{
	/**
	 * Current URL
	 *
	 * Returns the full URL (including segments) of the page where this
	 * function is placed
	 *
	 * @return	string
	 */
	function auth_test()
	{
		$CI =& get_instance();

		//don't check for setup if we're already there.
		if(strtolower($CI->router->fetch_class()) == "setup")
			return;

		$CI->load->library("session");

		$user = $CI->session->user;

		//if user is already logged in, no need to check.
		if(isset($user))
			return;

		//now check that the install is up-to-date
		$CI->load->library("aauth");

		$ver = $CI->aauth->get_system_var("mailman_version");

		if($ver === false || $ver == 0)
		{
			redirect(base_url()."setup");
			die;
		}

		//only public pages are now allowed.
		$CI->load->config('mailman_config',true);

		$mailmanConfig = $CI->config->config["mailman_config"];

		if(!in_array($CI->router->fetch_class(),$mailmanConfig["public_routes"]))
		{
			redirect(base_url()."login");
			die;
		}
	}

	auth_test();
}

if (! function_exists('add_csrf_field'))
{
	function generate_csrf_field()
	{
		$CI = & get_instance();

		return "<input type='hidden' style='display:none' name='".config_item('csrf_token_name')."' value='".$CI->security->get_csrf_hash()."'/>";
	}
}