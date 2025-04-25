
<div id="content">
	<table>
		<tr>
			<th>id</th>
			<th>название</th>
		</tr>
		<?php foreach ($products as $products): ?>
		<tr>
			<td><?= $products['id']; ?></td>
			<td><?= $products['название']; ?></td>
			
		</tr>
		<?php endforeach; ?>
	</table>
</div>