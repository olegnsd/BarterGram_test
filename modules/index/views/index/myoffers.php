<?= $this->call("index/index/header", array('title' => 'История платежей')); ?>
<div>
<h1>Мои заявки</h1>
<? if($params['offers']): ?>
<table border="1" style="width: 100%;">
	<tr>
		<th>ID</th>
		<th>Проект</th>
		<th>Сообщение</th>
		<th>Дата подачи заявки</th>
	</tr>
	<? foreach($params['offers'] as $p): ?>
	<tr>
		<td><?= $p['id']; ?></td>
		<td><?= $p['title']; ?></td>
		<td><?= \dvijok\core\Helper::truncate($p['message']); ?></td>
		<td><?= $p['created_at']; ?></td>
	</tr>
	<? endforeach; ?>
</table>
<? else: ?>
	<p>У вас еще нет заявок</p>
<? endif; ?>
</div>
<?= $this->call("index/index/footer"); ?>