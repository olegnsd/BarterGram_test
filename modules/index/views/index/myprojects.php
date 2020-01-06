<?= $this->call("index/index/header", array( 'title' => 'Мои обьявления')); ?>
<h1>Мои текущие проекты</h1>
<? if($params['current_offers']): ?>
<div id="projects">
	<table class="revisions" border="1" style="width: 100%;">
		<tr>
			<th>Автор</th>
			<th>Название проекта</th>
			<th>Дата</th>
		</tr>
	<? foreach($params['current_offers'] as $of): ?>
		
		<tr>
			<td><a href="/user/<?= $of['login']; ?>"><?= $of['login']; ?></a></td>
			<td><?= $of['title']; ?></td>
			<td><?= $of['created_at']; ?></td>
		</tr>
	<? endforeach; ?>
	</table>
</div>
<? else: ?>
<p>Текущих проектов нет</p>
<? endif; ?>
<?= $this->call("index/index/footer"); ?>