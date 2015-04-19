<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="row">
		<div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
			<div class="login-box clearfix">
				<div class="login-logo">
					<a href="#"><img src="<?php echo base_url('img/logo-144.png'); ?>" alt="Company Logo"></a>
				</div>
				<div class="login-form">
					<?php if(isset($error)) { ?>
					<div class="alert alert-dismissable alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<?php echo $error; ?>
					</div>
					<?php } ?>
					<form role="form" class="form login-form" method="post" action="<?php echo base_url()."login/" ?>">
						<?php echo generate_csrf_field(); ?>
						<div class="form-group">
							<input type="email" class="form-control validate" placeholder="Email" required id="txtEmail" name="txtEmail" />
						</div>
						<div class="form-group">
							<input type="password" class="form-control validate" id="txtPassword" name="txtPassword" placeholder="Password" required />
						</div>
						<div class="form-group">
							<label class="checkbox inline">
								<input type="checkbox" id="chkRemember" name="chkRemember"/> Remember me
							</label>
						</div>
						<button type="submit" class="btn btn-red">Login</button>
					</form>
					<div class="login-links">
						<a href="forgot-password">
							Forgot password?
						</a>
						<br>
						<a href="<?php echo base_url(); ?>signup">
							Don't have an account? <strong>Sign Up</strong>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
