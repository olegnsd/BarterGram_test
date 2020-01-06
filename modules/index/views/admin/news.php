<?= $this->call("index/admin/header"); ?>
<div class="content">
<h2><a href="/index/admin/news/add" class="btn btn-outline-success">Добавить меню</a></h2>
	<table style="width: 100%;">
		<tr>
			<th>
			ID
			</th>
			<th>
			Заголовок
			</th>
			<th>
			Дата создания
			</th>
			<th>
			Действия
			</th>
		</tr>
	<? foreach($params['news'] as $n): ?>
	
		<tr>
			<td>
			<?= $n['id'];?>
			</td>
			<td>
			<?= $n['title'];?>
			</td>
			<td>
			<?= $n['created_at'];?>
			</td>
			<td>
				<a href="/index/admin/news/<?= $n['id']; ?>">Редактировать</a>
				<a href="/index/admin/news/delete/<?= $n['id']; ?>">Удалить</a>
			</td>
		</tr>
	
	<? endforeach; ?>
	</table>
</div>
<?= $this->call("index/admin/footer"); ?>