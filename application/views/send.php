<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form role="form" id="frmSend" method="POST">
	<?php echo generate_csrf_field(); ?>
	<input type="hidden" style="display: none" id="tempDir" name="tempDir" value="<?php echo $tempDir; ?>"/>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>Send an email to a list</h3>
		</div>
	</div>
	<div class="panel-group" id="panel-881945">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="panel-title" data-toggle="collapse" data-parent="#panel-881945" href="#panel-element-details">Email details</a>
			</div>
			<div id="panel-element-details" class="panel-collapse in">
				<div class="panel-body">
					<div class="row clearfix">
						<div class="col-md-6 column">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Choose a target list</h3>
								</div>
								<div class="panel-body search-list-panel">
									<ul id="lstLists" class="list-group">
										<li class="list-group-item">
											<input type="text" class="list-filter-text form-control" data-for="lstLists" placeholder="Search a list"/>
										</li>
										<?php foreach($lists as $list) { ?>
											<li class="list-group-item">
												<span class="badge"><?php echo $list->members_count; ?></span>
												<label class="radio-inline"><input type="radio" name="rbListAddress" value="<?php echo $list->address; ?>"><?php echo $list->name; ?></label>
											</li>
										<?php } ?>
									</ul>
									<div class="form-group">
										<label for="txtFromName">Or free emails (Use comma to separate multiple addresses)</label><input type="text" class="form-control" name="txtFreeEmail" id="txtFreeEmail" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 column">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Choose a domain</h3>
								</div>
								<div class="panel-body search-list-panel">
									<ul class="list-group" id="lstDomains">
										<li class="list-group-item">
											<input type="text" class="list-filter-text form-control" data-for="lstDomains" placeholder="Search a domain"/>
										</li>
										<?php foreach($domains as $domain) { ?>
											<li class="list-group-item">
												<label class="radio-inline"><input type="radio" name="rbDomain" value="<?php echo $domain->name; ?>"><?php echo $domain->name; ?></label>
											</li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix" style="padding-top:30px">
						<div class="col-md-6">
							<div class="form-group">
								<label for="txtFromName">From name</label><input type="text" class="form-control" name="txtFromName" id="txtFromName" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="txtFromEmail">From email address</label><input type="email" class="form-control" name="txtFromEmail" id="txtFromEmail" />
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-12">
							<div class="form-group">
								<label for="txtSubject">Subject</label><input type="text" class="form-control" id="txtSubject" name="txtSubject"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-881945" href="#panel-element-design">Design your mail</a>
			</div>
			<div id="panel-element-design" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row clearfix">
						<div class="col-md-12">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#" id="lnkHtmlSource" object="txtHtml">Html</a>
									</li>
									<li class="">
										<a href="#" id="lnkHtmlPreview" object="txtHtmlPreview">Message Preview</a>
									</li>
									<li class="">
										<a href="#" id="lnkTextVersion" object="txtTextVersion">Text Version</a>
									</li>
									<li class="pull-right">
										<span>Synchronize text version</span>
										<div class="btn-group btn-toggle" id="chkSynchronize">
											<button class="btn btn-xs btn-primary active">ON</button>
											<button class="btn btn-xs btn-default">OFF</button>
										</div>
									</li>
								</ul>
								<textarea class="form-control" id="txtHtml" name="txtHtml" cols="25" rows="20"></textarea>
								<iframe id="txtHtmlPreview" style="display:none"></iframe>
								<textarea class="form-control" style="display:none" id="txtTextVersion" name="txtTextVersion" cols="25" rows="20"></textarea>
							</div>
							<div class="form-group">
								<input id="btnUpload" name="btnUpload" type="file" style="display:none;" multiple/>
								<button id="btnUploadView" type="button" class="btn btn-default">Choose image files</button>
								<small>PNG, JPG, or GIF</small>
							</div>
							<div class="row clearfix" id="imagesContainer" style="display:none">
								<div class="col-md-12 scroll-wrapper">
									<span class="scroll-pane"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row clearfix">
			<div class="col-md-12 column">
				<div class="form-group">
					<div class="checkbox">
						<button type="button" id="btnSend" class="btn btn-primary">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div id="context-menu" style="display: none;">
	<ul class="dropdown-menu" role="menu">
		<li><strong id="imgName" style="margin-left: 6px">Name of Image</strong></li>
		<li><a id="btnAddAtCaret" tabindex="-1" href="#">Add to html at caret position</a></li>
	</ul>
</div>
<script>
	var myScroll;

	$(document).ready(function()
	{
		myScroll = new IScroll('.scroll-wrapper',
			{
				scrollbars: true,
				fadeScrollbars: false,
				interactiveScrollbars: true,
				scrollX: true
			});
		$(".scroll-pane").width(parseInt($(".scroll-wrapper").css('padding-right'))+ parseInt($(".scroll-wrapper").css('padding-left')));

		$("#btnSend").click(function()
		{
			MailMan.submitAjaxForm("<?php echo base_url(); ?>send/send","form#frmSend",
				function(data)
				{
					MailMan.showAlert(data.message,"success");
				},
				function(xhr,textStatus)
				{
					MailMan.showAlert("failed to send message","danger");
				}
			);
		});

		$('#lnkHtmlPreview,#lnkHtmlSource,#lnkTextVersion').click(function()
		{
			$('#lnkHtmlPreview,#lnkHtmlSource,#lnkTextVersion').parent().removeClass('active');
			$('#txtHtml,#txtHtmlPreview,#txtTextVersion').hide();
			$(this).parent().addClass('active');
			$('#'+$(this).attr("object")).show();
		});

		$('#txtHtml').change(function()
		{
			updateHtmlPreview();
		});

		function updateHtmlPreview()
		{
			var tempDir = $("#tempDir").val();

			var html = $("#txtHtml").val();

			//find and replace cid: with urls

			html = html.replace(
				/<img(.+?)src=(?:['"]cid:(.*?)["']|cid:(.*?)\s)(.*)>/g,
				"<img$1src='<?php echo base_url(); ?>img/temp/"+tempDir+"/$2$3?r="+Math.random()+"' $4>");

			var doc = $("#txtHtmlPreview").get(0).contentWindow.document;
			$('body',doc).html(html);

			if($("#chkSynchronize").find(".btn.active").text() == "ON")
				$("#txtTextVersion").val($('body',doc).text());
		}

		$('#lnkHtmlPreview').click(function()
		{
			updateHtmlPreview();
		})

		$(".panel-heading").css("cursor","pointer");

		$(".panel-heading").click(function(){
			$(this).children("a")[0].click();
		});

		$("#btnUploadView").click(function(){
			$("#btnUpload").click();
		});

		$('#btnUpload').on('change', function(event){

			var tempDir = $("#tempDir").val();

			var data = new FormData();
			$.each(event.target.files, function(key, value)
			{
				data.append(key, value);
			});

			data.append("tempDir",tempDir);
			data.append("csrf_token",MailMan.getCookie("csrf_cookie"));

			MailMan.hideAlert();
			MailMan.doLoading();

			$.ajax({
				url: '<?php echo base_url();?>send/uploadImages',
				type: 'POST',
				data: data,
				cache: false,
				dataType: 'json',
				processData: false, // Don't process the files
				contentType: false // Set content type to false as jQuery will tell the server its a query string request
			}).done(function(data)
			{
				if(typeof data.error === 'undefined')
				{
					// Success so call function to process the form
					$("#imagesContainer").show();

					$.each(event.target.files, function(ptr)
					{
						var fileName = event.target.files[ptr].name;
						var img = new Image();
						img.src = '<?php echo base_url();?>img/temp/'+tempDir+'/'+fileName;
						$(img).attr("data-item",fileName);
						$(img).css("height",'100px');
						$(img).load(function(){
							$(".scroll-pane").width($(".scroll-pane").width()+$(img).outerWidth(true));
							myScroll.refresh();
						});
						$(".scroll-pane").append(img);
					});

					$('.scroll-pane img').contextmenu({
						'target':'#context-menu',
						before: function (e, context)
						{
							if(typeof($(e.target).attr("data-item")) == 'undefined')
								return;
							var filename = $(e.target).attr("data-item");
							$("#imgName").text(filename);
						}
					});

				}
				else
				{
					MailMan.showAlert(data.error,"danger");
				}
			}).fail(function()
			{

				MailMan.showAlert('Failed to upload images',"danger");
			})
			// STOP LOADING SPINNER
			.always(function()
			{
				MailMan.stopLoading();
				$("input[name='csrf_token']").val(MailMan.getCookie('csrf_cookie'));
			});
		});
		$('.scroll-pane').contextmenu({'target':'#context-menu',
			onItem : function(context,e)
			{
				$("#txtHtml").insertAtCaret($('#imgName').text());
			}
		});

		$(".list-filter-text").change(function()
		{
			var search = $(this).val().trim().toLowerCase();

			var listId = $(this).attr("data-for");
			var searchId = this.id;

			$("#"+listId+" li").each(function()
			{
				if($($(this).children()[0]).hasClass("list-filter-text") || search == "" || $(this).text().toLowerCase().indexOf(search)>=0)
					$(this).show();
				else
					$(this).hide();
			});
		})
	});
</script>
