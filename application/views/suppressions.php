<form role="form" id="frmSuppressions" method="POST">
	<?php echo generate_csrf_field(); ?>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>Upload suppression list</h3>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<span class="card-title">Suppression details</span>
		</div>
		<div class="card-body">
			<div class="row clearfix">
				<div class="col-md-6 column">
					<div class="card">
						<div class="card-header">
							<h3 class="panel-title">Choose a domain</h3>
						</div>
						<div class="card-body search-list-panel">
							<ul class="list-group" id="lstDomains">
								<li class="list-group-item">
									<input type="text" class="list-filter-text form-control" data-for="lstDomains" placeholder="Search a domain"/>
								</li>
								<?php
								$count = 0;
								foreach($domains as $domain)
								{
									$count++;
									?>
									<li class="list-group-item">
										<div class="form-check">
											<label class="form-check-label" for="rbdom<?php echo $count; ?>">
												<input class="form-check-input" type="radio" name="rbDomain" id="rbdom<?php echo $count; ?>" value="<?php echo $domain->name; ?>"><?php echo $domain->name; ?>
											</label>
										</div>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6 column">
					<div class="card">
						<div class="card-header">
							<h3 class="panel-title">Suppression type</h3>
						</div>
						<div class="card-body search-list-panel">
							<ul class="list-group">
							<?php
								$count = 0;
								$suppressions = ["bounces"=> "Bounces","complaints" => "Complaints","unsubscribes" => "Unsubscribes"];
								foreach($suppressions as $suppression => $name)
							{
								$count++;
								?>
							<li class="list-group-item" id="lstSuppressionType">
								<div class="form-check">
									<label class="form-check-label" for="rbsup<?php echo $count; ?>">
										<input class="form-check-input" type="radio" id="rbsup<?php echo $count; ?>" name="rbSuppressionType" value="<?php echo $suppression; ?>" checked><?php echo $name; ?>
									</label>
								</div>
							</li>
							<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container mt-3">
				<div class="row clearfix">
					<div class="col col-md-6">
						<div class="form-group">
							<label for="suppressionFile">Suppression list file</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="suppressionFile" name="suppressionFile">
								<label class="custom-file-label" for="suppressionFile">Choose file</label>
							</div>
						</div>
					</div>
					<div class="col col-md-6">
						<div class="col col-md-12">
							<div class="form-group">
								<label for="txtSkipRows">Skip Header Rows</label><input type="number" class="form-control" value="0" id="txtSkipRows" name="txtSkipRows"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col col-md-12">
						<div class="form-group">
							<label for="txtReason">Reason</label><input type="text" class="form-control" id="txtReason" name="txtReason"/>
						</div>
					</div>
				</div>
			</div>
			<div class="container mt-3">
				<div class="row">
					<div class="col col-md-12">
						<button id="btnSuppress" type="submit" class="btn btn-primary">Upload</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(document).ready(function () {
		$("#btnSuppress").click(function(ev)
		{
			ev.preventDefault();
			var formData = new FormData();

			var domain = $("[name=rbDomain]:checked").val();
			formData.append("rbDomain",domain);

			var supptype = $("[name=rbSuppressionType]:checked").val()
			formData.append("rbSuppressionType",supptype);

			formData.append("csrf_token",MailMan.getCookie("csrf_cookie"));

			formData.append("txtReason",$("#txtReason").val());
			formData.append("txtSkipRows",$("#txtSkipRows").val());

			formData.append("file",$("#suppressionFile")[0].files[0]);

			MailMan.hideAlert();
			MailMan.doLoading();

			$.ajax({
				url: '<?php echo base_url();?>suppressions/upload',
				type: 'POST',
				data: formData,
				cache: false,
				dataType: 'json',
				processData: false, // Don't process the files
				contentType: false // Set content type to false as jQuery will tell the server its a query string request
			}).done(function(data)
				{
					if(typeof data.error === 'undefined')
						MailMan.showAlert(data.message,"success");
					else
						MailMan.showAlert(data.error,"danger");
				})
			.fail(function(xhr,textStatus)
				{
					MailMan.showAlert("failed to send message","danger");
				})
			.always(function ()
				{
					MailMan.stopLoading();
					$("input[name='csrf_token']").val(MailMan.getCookie('csrf_cookie'));
				});
		});
	})
</script>