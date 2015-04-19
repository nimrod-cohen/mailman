<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row clearfix">
	<div class="col-md-12 column">
		<table class="table">
			<thead>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>Members</th>
				<th>Created</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($lists as $list) { ?>
			<tr>
				<td><?php echo $list->name; ?></td>
				<td><?php echo $list->address; ?></td>
				<td><?php echo $list->members_count; ?></td>
				<td><?php echo $list->created_at; ?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
