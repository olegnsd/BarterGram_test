<?= $this->call("index/index/header", array('title' => 'История платежей')); ?>
<div>
<h1>История платежей</h1>
<? if($params['payments']): ?>
<table border="1" style="width: 100%;">
	<tr>
		<th>ID</th>
		<th>Сумма</th>
		<th>Проект</th>
		<th>Действие</th>
		<th>Дата операции</th>
	</tr>
	<? foreach($params['payments'] as $p): ?>
	<tr>
		<td><?= $p['id']; ?></td>
		<td><?= $p['amount']; ?> <?= \dvijok\core\Config::$currencies[$p['currency']]; ?></td>
		<td><?= $p['title']; ?></td>
		<td><?= \dvijok\core\Config::$action[$p['type']]; ?></td>
		<td><?= $p['created_at']; ?></td>
	</tr>
	<? endforeach; ?>
</table>
<? else: ?>
	<p>Ваша история платежей пуста</p>
<? endif; ?>
</div>
<?= $this->call("index/index/footer"); ?>