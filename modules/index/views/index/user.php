<?

	$user = $params['user'];
	$title = $user ? 'Профиль пользователя '.$user['login'] : 'Пользователь не найден';
	//echo password_hash('test123', PASSWORD_DEFAULT);
?>
<?= $this->call("index/index/header", array( 'title' => $title)); ?>
<? if($user): ?>
<h1>Профиль пользователя <?= $params['user']['login']; ?></h1>
<div class="avatar">
	<? if($params['files']): ?>
		<img src="/assets/uploads/users/<?= $params['user']['id']; ?>/<?= $params['files'][0]; ?>" />
	<? else: ?>
		<img src="/assets/uploads/no-avatar.png" />
	<? endif; ?>
</div>
<div class="rating">
	<div class="rating_plus">
	<img src="/assets/images/like.png" /> <?= $params['rating_plus']; ?>
	</div>
	<div class="rating_minus">
	<img src="/assets/images/dislike.png" /> <?= $params['rating_minus']; ?>
	</div>
</div>
<p>E-mail: <a href="mailto:<?= $params['user']['email']; ?>"><?= $params['user']['email']; ?></a></p>
<p>Телефон: <?= $params['user']['phone']; ?></p>
<? if($this->user): ?>
	<? if($params['user']['id'] != $this->user['id']): ?>
	<form method="post" action="/sendmessage">
		<div class="form-group">
			<label for="message">Написать сообщение</label>
			<textarea id="message" name="message" required class="form-control"></textarea>
			<? if(isset($errors['message'])): ?>
				<? foreach($errors['message'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
			<input type="hidden" name="to_id" value="<?= $params['user']['id']; ?>" />
			<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
			<div class="form-group">
				<button class="btn btn-success">Отправить</button>
			</div>
		</div>
	</form>
	<hr />
	<? endif; ?>
	
<? else: ?>

<p><strong><a class="auth" href="">Войдите</a> чтобы написать сообщение</strong></p>
<? endif; ?>
<!--
<? if($this->user['id'] == $params['user']['id']): ?>
<form method="post" action="/uploadavatar" enctype="multipart/form-data">
	<div class="form-group">
		<label for="avatar">Загрузить аватар (соотношение 1:1)</label>
		<input type="file" name="avatar[]" class="form-control" />
	</div>
	<div class="form-group">
		<button>Сохранить</button>
	</div>
	<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
</form>
<? endif; ?>
-->
<h1>Текущие проекты</h1>
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
<hr />
<h1>Отзывы</h1>
<? if($params['offers']): ?>
<div>
	<table class="revisions" border="1" style="width: 100%;">
		<tr>
			<th>Автор</th>
			<th>Название проекта</th>
			<th>Рейтинг</th>
			<th>Отзыв</th>
			<th>Дата подачи заявки</th>
			<th>Дата завершения проекта</th>
		</tr>
	<? foreach($params['offers'] as $of): ?>
		
		<tr>
			<td><a href="/user/<?= $of['user']['login']; ?>"><?= $of['user']['login']; ?></a></td>
			<td><?= $of['title']; ?></td>
			<td><?= $of['result'] > 0 ? '+'.$of['result'] : '-'.abs($of['result']); ?></td>
			<td><?= $of['revision']; ?></td>
			<td><?= $of['created_at']; ?></td>
			<td><?= $of['revision_date']; ?></td>
		</tr>
	<? endforeach; ?>
	</table>
</div>
<? else: ?>
<p>Отзывов нет</p>
<? endif; ?>
<hr />

		<h1>Обьявления</h1>
		<div id="articles" class="articles">
		<? if($params['articles']): ?>
		<? foreach($params['articles'] as $a): ?>
			<div class="article_item">
				<div class="article_avatar">
					<a href="/user/<?= $a['user_id']; ?>">
					<? if($a['files']): ?>
						<img src="/assets/uploads/users/<?= $a['user_id']; ?>/<?= $a['files'][0]; ?>" />
					<? else: ?>
						<img src="/assets/uploads/no-avatar.png" />
					<? endif; ?>
					</a>
				</div>
				<a href="/article/<?= \dvijok\core\Helper::transliterate($a['title']).'-'.$a['id']; ?>"><?= $a['title']; ?> (<i><?= $a['type'] == 'p' ? 'предложение' : 'спрос'; ?></i>)</a>
				<? if($a['finished']): ?>
				<span class="a_f">ЗАВЕРШЁН</span>
				
				<? endif; ?>
				<div class="a_p_t">
					<div class="article_item_price">
						<strong><?= $a['price']; ?> <?= \dvijok\core\Config::$currencies[$a['currency']]; ?></strong>
					</div>
					<div class="article_item_pay_type">
						<strong><?= \dvijok\core\Config::$payment_types[$a['pay_type']]; ?></strong>
					</div>
				</div>
				<div class="clear"></div>
				<span class="cr"><?= $a['created_at']; ?></span>
				<div class="clear"></div>
				<div class="article_item_description">
				<?= \dvijok\core\Helper::truncate($a['description'], 250); ?>
				</div>
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет обьявлений</p>
		<? endif; ?>
		</div>
<? else: ?>

	<h2>Пользователь не найден</h2>
<? endif; ?>
<?= $this->call("index/index/footer"); ?>