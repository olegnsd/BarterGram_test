<?= $this->call("index/admin/header", array('title' => 'Переписки пользователя "'.$params['user']['login'].'"')); ?>

		
		<h3>Переписки пользователя "<?= $params['user']['login']; ?>"</h3>
		<? if($params['conversations']): ?>
		<? foreach($params['conversations'] as $a): ?>
			<div class="article_item">
				Переписка между пользователями <a href="/user/<?= $a['from_login']; ?>"><?= $a['from_login']; ?></a> и <a href="/user/<?= $a['to_login']; ?>"><?= $a['to_login']; ?></a>
				- <a href="/messages/<?= $a['id']; ?>">Просмотреть</a>
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет переписок</p>
		<? endif; ?>
<?= $this->call("index/admin/footer"); ?>