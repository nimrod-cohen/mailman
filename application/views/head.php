<?php
	$_CI = & get_instance();

	$user = $_CI->session->user;

	$userName = $user->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MailMan, Mass email manager for Mailgun</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!--link rel="stylesheet/less" href="/less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="/less/responsive.less" type="text/css" /-->
	<!--script src="/js/less.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

	<link href="<?php echo base_url('/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/style.css'); ?>" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="/js/html5shiv.js"></script>
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
	<script type="text/javascript" src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/bootstrap-contextmenu.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/jqBootstrapValidation-1.3.7.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('/js/scripts.js'); ?>"></script>

	<!-- the iScroll script -->
	<script type="text/javascript" src="<?php echo base_url('/js/iscroll.js'); ?>"></script>
</head>

<body>
<div class="container">
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="#">
			<img alt="MailMan" src="<?php echo base_url('img/favicon-57.png'); ?>" width="16">
			MailMan
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php echo $this->router->class == 'send' ? 'active' : ''?>">
					<a class="nav-link" href="<?php echo base_url()."send"; ?>">Send</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Assets</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo base_url()."lists"; ?>">Lists</a>
						<a class="dropdown-item" href="<?php echo base_url()."domains"; ?>">Domains</a>
						<a class="dropdown-item" href="<?php echo base_url()."suppressions"; ?>">Suppressions</a>
					</div>
				</li>
				<li class="nav-item <?php echo $this->router->class == 'designer' ? 'active' : ''?>">
					<a class="nav-link" href="<?php echo base_url()."design"; ?>">Design</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="ddl_editors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">External Editors</a>
					<div class="dropdown-menu" aria-labelledby="ddl_editors">
						<a class="dropdown-item" target="_blank" href="https://topol.io/">Topol</a>
						<a class="dropdown-item" target="_blank" href="https://simplemail.io/">Simple Mail</a>
						<a class="dropdown-item" target="_blank" href="https://mosaico.io/">Mosaico</a>
					</div>
				</li>
			</ul>

			<ul class="navbar-nav navbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $userName ?></a>
					<div class="dropdown-menu" aria-labelledby="dropdown02">
						<a class="dropdown-item" href="<?php echo base_url()."account"; ?>">Account settings</a>
						<a class="dropdown-item" href="<?php echo base_url()."account/logout"; ?>">Log out</a>
					</div>
				</li>
			</ul>

			<!--form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form-->
		</div>
	</nav>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div id="dvAlert" class="alert alert-dismissable" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<span class="alert-content"></span>
			</div>
		</div>
	</div>
