<?= $this->call("index/admin/header", array('title' => 'Все обьявления')); ?>

		
		<h3>Обьявления</h3>
		<form class="form-control" action="/admin/articles/category">
			<label for="category_id">Категория</label>
			<select name="category_id" class="article_cat_select form-control">
				<option value="0">Все категории</option>
				<? foreach($params['categories'] as $c): ?>
				
					<option <?= (isset($params['category_id']) && $params['category_id'] == $c['id']) ? 'selected' : ''; ?> value="<?= $c['id']; ?>"><?= $c['title']; ?></option>
				<? endforeach; ?>
			</select>
			<label for="sort">Сортировка</label>
			<select name="sort" class="article_cat_select form-control">
				<option <?= (isset($params['sort']) && $params['sort'] == 'ASC') ? 'selected' : ''; ?> value="ASC">старые</option>
				<option <?= (isset($params['sort']) && $params['sort'] == 'DESC') ? 'selected' : ''; ?> value="DESC">новые</option>
			</select>
	
			<label for="sort">Название</label>
			<input type="text" name="s" class="form-control" value="<?= $this->input->get('s'); ?>" />

			<p style="margin-top: 10px;"><button class="btn btn-outline-success">Применить</button></p>
			
		</form>
		<h2><a href="/admin/articles/add" class="btn btn-outline-success">Добавить Обьявление</a></h2>
		<? if($params['articles']): ?>
		<? foreach($params['articles'] as $a): ?>
			<div class="article_item">
				<a href="/article/<?= \dvijok\core\Helper::transliterate($a['title']).'-'.$a['id']; ?>"><?= $a['title']; ?> (<i><?= $a['type'] == 'p' ? 'предложение' : 'спрос'; ?></i>)</a>
				
				<? if($a['status'] && !$a['payed'] && $a['finished']): ?>
				
				<strong>(Арбитраж)</strong> 
				<? if($a['conversation_id']): ?>
				<a href="/messages/<?= $a['conversation_id']; ?>">Переписка</a>
				<? endif; ?>
				<form class="d-inline-block" method="post" action="<?= $this->baseUrl; ?>admin/arbitrary">
					<button class="btn btn-success" name="payout">Выплатить исполнителю</button>
					<button class="btn btn-danger" name="denie_payout">Не выплачивать исполнителю</button>
					<input type="hidden" name="article_id" value="<?= $a['id']; ?>" />
					<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
				</form>
				<? endif; ?>
				

				<a class="btn btn-outline-success" href="/admin/articles/edit/<?= $a['id']; ?>">Редактировать</a>
				<a class="btn btn-outline-danger" href="/admin/articles/delete/<?= $a['id']; ?>">Удалить</a>
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет обьявлений</p>
		<? endif; ?>
<?= $this->call("index/admin/footer"); ?>