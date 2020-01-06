<?= $this->call("index/admin/header", array('title' => 'слайдеры')); ?>

		
		<h3>Слайдеры</h3>
		<h2><a href="/admin/slider/add" class="btn btn-outline-success">Добавить слайдер</a></h2>
		<? if($params['slider']): ?>
		<? foreach($params['slider'] as $a): ?>
			<div class="article_item">
				<a href="<?= $a['url']; ?>"><img style="width: 30%;" src="<?= preg_match("%https?://%ix", $a['img']) ? $a['img'] : '/assets/uploads/slider/'.$a['id'].'/'.$a['img']; ?>" /></a>
				
				<a class="btn btn-outline-success" href="/admin/slider/edit/<?= $a['id']; ?>">Редактировать</a>
				<a class="btn btn-outline-danger" href="/admin/slider/delete/<?= $a['id']; ?>">Удалить</a>
				
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет слайдеров</p>
		<? endif; ?>
<?= $this->call("index/admin/footer"); ?>