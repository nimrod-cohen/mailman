<?php
/**
 * Created by PhpStorm.
 * User: nimrodcohen
 * Date: 08/02/2018
 * Time: 21:50
 */
?>
<link href="css/material-icon.css" rel="stylesheet">
<link href="less/designer.less" rel="stylesheet/less" type="text/css">
<script src="js/less.min.js" type="text/javascript"></script>
<script src="js/designer.js" type="text/javascript"></script>

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script src="js/summernote/summernote-ext-rtl.js"></script>


<div class="email-designer">
	<div class="left-pane">
		<section class="nav">
			<ul>
				<li tab-id="elements" class="active">Elements</li>
				<li tab-id="structure">Structure</li>
				<li tab-id="settings">Settings</li>
			</ul>
		</section>
		<section class="tab" id="elements">
			<div data-block="Text" class="block" draggable="true">
				<i class="material-icons">text_format</i><span>Text</span>
			</div>
			<div data-block="Text" class="block" draggable="true">
				<i class="material-icons">image</i><span>Image</span>
			</div>
			<div data-block="Text" class="block" draggable="true">
				<i class="material-icons">crop_16_9</i><span>Button</span>
			</div>
			<div data-block="Text" class="block" draggable="true">
				<i class="material-icons">remove</i><span>Divider</span>
			</div>
			<div data-block="Text" class="block" draggable="true">
				<i class="material-icons">import_export</i><span>Spacer</span>
			</div>
		</section>
	</div>
	<div class="right-pane" bgcolor="#f6f8f1">
		<div class="email-editor">
			<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="drag-receiver">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>

</div>