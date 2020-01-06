<?= $this->call("index/admin/header", array('title' => 'Пользователи')); ?>

		
		<h3>Пользователи</h3>
		<form class="form-control" action="/admin/users/search">

			<label for="sort">Сортировка</label>
			<select name="sort" class="article_cat_select form-control">
				<option <?= (isset($params['sort']) && $params['sort'] == 'ASC') ? 'selected' : ''; ?> value="ASC">старые</option>
				<option <?= (isset($params['sort']) && $params['sort'] == 'DESC') ? 'selected' : ''; ?> value="DESC">новые</option>
			</select>
	
			<label for="sort">Логин</label>
			<input type="text" name="s" class="form-control" value="<?= $this->input->get('s'); ?>" />

			<p style="margin-top: 10px;"><button class="btn btn-outline-success">Применить</button></p>
			
		</form>
		<h2><a href="/admin/users/add" class="btn btn-outline-success">Добавить Пользователя</a></h2>
		<? if($params['users']): ?>
		<? foreach($params['users'] as $a): ?>
			<div class="article_item">
				<a href="/user/<?= $a['login']; ?>"><?= $a['login']; ?></a>
				<a class="btn btn-outline-success" href="/admin/users/edit/<?= $a['id']; ?>">Редактировать</a>
				<a class="btn btn-outline-danger" href="/admin/users/delete/<?= $a['id']; ?>">Удалить</a>
				- <a href="/conversations/<?= $a['id']; ?>">переписки</a>
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет пользователей</p>
		<? endif; ?>
<?= $this->call("index/admin/footer"); ?>