<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MailMan, Mass email manager for Mailgun</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Mail manager for MailGun">
	<meta name="author" content="">

	<!--link rel="stylesheet/less" href="/less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="/less/responsive.less" type="text/css" /-->
	<!--script src="/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

	<link href="<?php echo base_url('/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/style.css'); ?>" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url('/js/html5shiv.js'); ?>"></script>
	<![endif]-->

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('/img/favicon-144.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('/img/favicon-114.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('/img/favicon-72.png'); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('/img/favicon-57.png'); ?>">
	<link rel="shortcut icon" href="<?php echo base_url('/img/favicon.ico'); ?>">

	<!-- loading spinner -->
	<script type="text/javascript" src="<?php echo base_url('/js/spin.min.js'); ?>"></script>

	<!-- jQuery & bootstrap -->
	<script type="text/javascript" src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/scripts.js'); ?>"></script>

	<!-- the iScroll script -->
	<script type="text/javascript" src="<?php echo base_url('/js/iscroll.js'); ?>"></script>

</head>

<body id="login-body">
<div id="login-bg"></div>
<div class="container">