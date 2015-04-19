<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row clearfix">
	<div class="col-md-12 column">
		<h3>
			Account settings
		</h3>
		<form role="form" id="frmAccount" method="POST">
			<?php echo generate_csrf_field(); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Personal details
					</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="txtName">Name</label><input type="text" class="form-control validate" placeholder="Joe Jameson" name="txtName" id="txtName" minlength="3" value="<?php echo $user->name; ?>" />
					</div>
					<div class="form-group">
						<label for="txtEmail">Email Address</label><input type="text" placeholder="joe@company.com" class="form-control validate" name="txtEmail" id="txtEmail" minlength="3" maxlength="255" value="<?php echo $user->email; ?>"/>
					</div>
					<div class="form-group">
						<label for="txtMailgunAPIKey">Mailgun API Key</label><input type="text" placeholder="key-..." minlength="30" class="form-control validate" name="txtMailgunAPIKey" id="txtMailgunAPIKey" value="<?php echo $mgAPIKey; ?>" />
					</div>
					<div class="form-group">
						<label for="txtPassword">Password</label><input type="password" class="form-control" name="txtPassword validate" minlength="6" id="txtPassword" />
					</div>
					<div class="form-group">
						<label for="txtPasswordRepeat">Repeat password</label><input type="password" class="form-control" name="txtPasswordRepeat" data-validations-matches-match="txtPassword" id="txtPasswordRepeat" />
					</div>
					<button id="btnSave" type="button" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function()
	{
		$("#btnSave").click(function()
		{
			MailMan.submitAjaxForm("<?php echo base_url(); ?>account/save","form#frmAccount",
				function(data)
				{
					MailMan.showAlert(data.message,"success");
					$("#lnkAccountName").html($("#txtName").val()+"<strong class=\"caret\"></strong>");

				},
				function(xhr,textStatus)
				{
					MailMan.showAlert("failed to complete setup","danger");
				}
			);
		});
	});
</script>
