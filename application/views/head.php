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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!--link rel="stylesheet/less" href="/less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="/less/responsive.less" type="text/css" /-->
	<!--script src="/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

	<link href="<?php echo base_url('/css/bootstrap.min.css'); ?>" rel="stylesheet">
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
	<script type="text/javascript" src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/bootstrap-contextmenu.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/js/jqBootstrapValidation-1.3.7.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('/js/scripts.js'); ?>"></script>

	<!-- the iScroll script -->
	<script type="text/javascript" src="<?php echo base_url('/js/iscroll.js'); ?>"></script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">
						<img alt="MailMan" src="<?php echo base_url('img/favicon-57.png'); ?>" width="16">
						MailMan
					</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="<?php echo $this->router->class == 'send' ? 'active' : ''?>">
							<a href="<?php echo base_url()."send"; ?>">Send</a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Definitions<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li class="<?php echo $this->router->class == 'lists' ? 'active' : ''?>">
									<a href="<?php echo base_url()."lists"; ?>">Lists</a>
								</li>
								<li class="<?php echo $this->router->class == 'domains' ? 'active' : ''?>">
									<a href="<?php echo base_url()."domains"; ?>">Domains</a>
								</li>
							</ul>
						</li>
					</ul>
					<!-- form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" />
						</div> <button type="submit" class="btn btn-default">Submit</button>
					</form-->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a id="lnkAccountName" href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userName ?><strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo base_url()."account"; ?>">Account Settings</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="<?php echo base_url().'account/logout'; ?>">Log out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div id="dvAlert" class="alert alert-dismissable" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<span class="alert-content"></span>
			</div>
		</div>
	</div>
