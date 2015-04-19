<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<img alt="MailMan" src="<?php echo base_url('/img/favicon-57.png'); ?>" width="16">
						MailMan
					</a>
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
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>
				MailMan Setup
			</h3>
			<form role="form" id="frmSetup" method="POST" action="<?php echo base_url()."send/send"; ?>">
				<?php echo generate_csrf_field(); ?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							Set administrator details
						</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="txtAdminName">Name</label><input type="text" class="form-control" placeholder="Joe Jameson" name="txtAdminName" id="txtAdminName" />
						</div>
						<div class="form-group">
							<label for="txtAdminMail">Email Address</label><input type="text" placeholder="joe@company.com" class="form-control" name="txtAdminMail" id="txtAdminMail" />
						</div>
						<div class="form-group">
							<label for="txtAdminPassword">Password</label><input type="password" class="form-control" name="txtAdminPassword" id="txtAdminPassword" />
						</div>
						<div class="form-group">
							<label for="txtAdminPasswordRepeat">Repeat password</label><input type="password" class="form-control" name="txtAdminPasswordRepeat" id="txtAdminPasswordRepeat" />
						</div>
						<button id="btnSetup" type="button" class="btn btn-primary">Do Setup</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<script>
	$(document).ready(function()
	{
		$("#btnSetup").click(function()
		{
			MailMan.submitAjaxForm("<?php echo base_url(); ?>setup/install","form#frmSetup",
				function(data)
				{
					MailMan.showAlert(data.message,"success");
					$("form#frmSetup").find("input[type=text],input[type=password]").attr("disabled","disabled");
					var btnSetup = $("#btnSetup")
					btnSetup.text("Proceed to MailMan");
					btnSetup.removeClass("btn-primary");
					btnSetup.addClass("btn-success");
					btnSetup.unbind('click');
					btnSetup.click(function(){
						document.location.href = '<?php echo base_url(); ?>';
					});

				},
				function(xhr,textStatus)
				{
					MailMan.showAlert("failed to complete setup","danger");
				}
			);
		});
	});

</script>