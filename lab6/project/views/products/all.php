<h1><?= $h1; ?></h1>
<div id="content">
	<table>
		<tr>
			<th>id</th>
			<th>title</th>
			<th>ссылка</th>
		</tr>
		<?php foreach ($products as $products): ?>
		<tr>
			<td><?= $products['id']; ?></td>
			<td><?= $products['название']; ?></td>
			<td><a href="/products/<?= $products['id']; ?>/">ссылка на страницу</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>