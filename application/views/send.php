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
	<div class="card">
		<div class="card-header">
			<a class="card-title" data-toggle="collapse" data-parent="#panel-881945" href="#panel-element-details">Email details</a>
		</div>
		<div id="panel-element-details" class="panel-collapse in">
			<div class="card-body">
				<div class="row clearfix">
					<div class="col-md-6 column">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Choose a target list</h3>
							</div>
							<div class="card-body search-list-panel">
								<ul id="lstLists" class="list-group">
									<li class="list-group-item">
										<input type="text" class="list-filter-text form-control" data-for="lstLists" placeholder="Search a list"/>
									</li>
									<?php foreach($lists as $list) { ?>
										<li class="list-group-item">
											<div class="form-check">
												<label class="form-check-label">
													<input type="radio" class="form-check-input" name="rbListAddress" value="<?php echo $list->address; ?>"><?php echo $list->name; ?>
												</label>
												<span class="badge"><?php echo "( ".$list->members_count." members )"; ?></span>
											</div>
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
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Choose a domain</h3>
							</div>
							<div class="card-body search-list-panel">
								<ul class="list-group" id="lstDomains">
									<li class="list-group-item">
										<input type="text" class="list-filter-text form-control" data-for="lstDomains" placeholder="Search a domain"/>
									</li>
									<?php foreach($domains as $domain) { ?>
										<li class="list-group-item">
											<div class="form-check">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="rbDomain" value="<?php echo $domain->name; ?>"><?php echo $domain->name; ?>
												</label>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix mt-3">
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
		<div class="card">
			<div class="card-header">
				<a class="card-title collapsed" data-toggle="collapse" data-parent="#panel-881945" href="#panel-element-design">Design your mail</a>
			</div>
			<div id="panel-element-design" class="panel-collapse collapse">
				<div class="card-body">
					<div class="row clearfix">
						<div class="col-md-12">
							<div class="navbar">
								<ul class="nav nav-tabs mr-auto">
									<li class="nav-item">
										<a href="#" class="nav-link active" id="lnkHtmlSource" object="txtHtml">Html</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link" id="lnkHtmlPreview" object="txtHtmlPreview">Message Preview</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link" id="lnkTextVersion" object="txtTextVersion">Text Version</a>
									</li>
								</ul>
								<span>Synchronize text version</span>
								<div class="btn-group btn-toggle" id="chkSynchronize">
									<button class="btn btn-xs btn-primary active">ON</button>
									<button class="btn btn-xs btn-default">OFF</button>
								</div>
								<textarea class="form-control" id="txtHtml" name="txtHtml" cols="25" rows="20"></textarea>
								<textarea class="hidden" style="display:none" id="txtSterilized" name="txtSterilized"></textarea>
								<iframe id="txtHtmlPreview" style="display:none"></iframe>
								<textarea class="form-control" style="display:none" id="txtTextVersion" name="txtTextVersion" cols="25" rows="20"></textarea>
							</div>
							<div class="form-group navbar">
								<ul class="nav nav-tabs mr-auto">
									<li class="nav-item">
										<input id="btnUpload" name="btnUpload" type="file" style="display:none;" multiple/>
										<button id="btnUploadView" type="button" class="btn btn-primary">Choose image files</button>
										<small>PNG, JPG, or GIF</small>
									</li>
								</ul>
								<ul class="nav">
									<li class="nav-item float-right">
										<button id="btnUnsubscribe" class="btn btn-primary">Unsubscribe URL</button>
									</li>
								</ul>
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
		<div class="row clearfix mt-3">
			<div class="col-md-12 column">
				<div class="form-group ml-3">
					<div class="checkbox">
						<button type="button" id="btnSend" class="btn btn-primary">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div id="context-menu" style="display: none; width:100%">
	<ul class="dropdown-menu" role="menu" style="padding: 10px;">
		<li><strong id="imgName" style="">Name of Image</strong></li>
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
			var txt = $("#txtHtml").val();

			txt = MailMan.hebrew2Unicode(txt)

			txt = MailMan.base64_encode(txt);

			$("#txtSterilized").val(txt);

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

		$('#lnkHtmlPreview,#lnkHtmlSource,#lnkTextVersion').click(function(ev)
		{
			ev.preventDefault();
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

			var html = $('body',doc).clone();
			html.find("head").remove();
			html.find("style").remove();
			html.find("script").remove();

			var txt = html.text();

			while(/\r?\n\s+/g.test(txt))
				txt = txt.replace(/(\r?\n)\s+/g,"$1");
			while(/\s+\r?\n/g.test(txt))
				txt = txt.replace(/\s+(\r?\n)/g,"$1");
			txt = txt.replace(/(\r?\n)(?:\r?\n)+/g,"$1");

			if($("#chkSynchronize").find(".btn.active").text() == "ON")
				$("#txtTextVersion").val(txt);

			html.remove();
		}

		$('#lnkHtmlPreview').click(function()
		{
			updateHtmlPreview();
		})

		$(".card-header").css("cursor","pointer");

		$(".card-header").click(function(){
			$(this).children("a")[0].click();
		});

		$("#btnUploadView").click(function(){
			$("#btnUpload").click();
		});

		$("#btnUnsubscribe").click(function(e){
			e.preventDefault();
			$("#txtHtml").insertAtCaret("%unsubscribe_url%");
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
						$(img).on('load',function(e){
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
							$("#context-menu").children("ul").css("display","block");
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
				e.preventDefault();

				$("#txtHtml").insertAtCaret('cid:'+$('#imgName').text());
				$("#context-menu").children("ul").css("display","none");
			}
		});
	});
</script>
