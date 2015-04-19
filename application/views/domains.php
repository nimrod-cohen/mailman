<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row clearfix">
	<div class="col-md-12 column">
		<table class="table">
			<thead>
			<tr>
				<th>Name</th>
				<th>Created</th>
				<th>Active</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($domains as $domain) { ?>
			<tr>
				<td><?php echo $domain->name; ?></td>
				<td><?php echo $domain->created_at; ?></td>
				<td><?php echo $domain->state; ?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
