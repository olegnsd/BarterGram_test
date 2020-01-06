<?= $this->call("index/index/header", array('title' => $params['article']['title'])); ?>
<div class="clear"></div>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');
?>
<div class="content2">
	<?= $this->call('leftBar'); ?>
	<div class="rightBar">
		<h1 class="article_title"><?= $params['article']['title']; ?> (<i><?= $params['article']['type'] == 's' ? 'Спрос' : 'Предложение'; ?></i>) 	
		<? if($params['article']['finished']): ?>
			<span class="a_f">ЗАВЕРШЁН</span>
		<? endif; ?>
		</h1>
		<div class="a_p_t">
			<div class="price"><strong><?= $params['article']['price']; ?> <?= \dvijok\core\Config::$currencies[$params['article']['currency']]; ?></strong></div>
			<div class="pay_type"><strong><?= \dvijok\core\Config::$payment_types[$params['article']['pay_type']]; ?></strong></div>
		</div>
		<div class="clear"></div>
		<div class="created_at"><?= $params['article']['created_at']; ?></div>
		<div class="type"></div>
		<div class="article_author">Автор: <strong><a href="/user/<?= $params['user']['login']; ?>"><?= $params['user']['login']; ?></a></strong></div>
		<div class="article_avatar">
			<a href="/user/<?= $params['user']['id']; ?>">
					<? if($params['ufiles']): ?>
						<img src="/assets/uploads/users/<?= $params['user']['id']; ?>/<?= $params['ufiles'][0]; ?>" />
					<? else: ?>
						<img src="/assets/uploads/no-avatar.png" />
					<? endif; ?>
			</a>
		</div>
		<div class="clear"></div>
		<div class="description">
			<?= $params['article']['description']; ?>
		</div>
		
		<? if($params['files']): ?>
			<p><strong>Прикреплённые файлы:</strong></p>
			<? foreach($params['files'] as $key => $f): ?>
				<div>
					<a target="_blank" href="/assets/uploads/articles/<?= $params['article']['id'].'/'.$f; ?>">Файл <?= ($key + 1); ?></a>
				</div>
			<? endforeach; ?>
		<? endif; ?>
		<hr />
		
		<div class="addoffer">
			<? if($this->session->has('user_id')): ?>
					<? if($params['article']['user_id'] == $this->user['id']): ?>
					<div class="form-group">
					<a class="btn btn-success" href="/edititem/<?= $params['article']['id']; ?>">Редактировать обьявление</a>
					
					
					<a class="btn btn-danger" href="/deleteitem/<?= $params['article']['id']; ?>">удалить обьявление</a>
					</div>
					<? endif; ?>
				<? if(!isset($params['already_offered'])): ?>
					<? if(!$params['article']['finished']): ?>
						<? if($params['article']['user_id'] != $this->user['id']): ?>
						<h2>Оставить заявку</h2>
						<form method="post" action="/addoffer">
							<div class="form-group">
								
								<textarea id="message" name="message" class="form-control offertextarea"><?= $olds['message']; ?></textarea>
							</div>
								<div class="form-group">
								<button class="btn btn-success">Отправить</button>
								</div>
								<input type="hidden" name="article_id" value="<?= $params['article']['id']; ?>" /> 
								<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
						</form>
						
						<? endif; ?>
					<? else: ?>
					<h2>Вы не можете подать заявку на проект, так как он уже завершён</h2>
					<? endif; ?>
				<? else: ?>
				<h2>Вы уже подали заявку</h2>
				<? endif; ?>
			<? else: ?>
			<p><a class="auth" href="">Войдите</a> чтобы оставить заявку</p>
			<? endif; ?>
			<div class="offer_items">
			<? if($params['offers']): ?>
				<p><strong>Заявки</strong></p>
				<? foreach($params['offers'] as $o): ?>
					<div class="offer_item">
						<div><strong><a href="/user/<?= $o['login']; ?>"><?= $o['login']; ?></a></strong> - <?= $o['created_at']; ?></div>
						<div class="form-control offer_message">
						<?= $o['message']; ?>
						</div>
						<div class="offer_item_status">
							
							<? if($this->user['id'] == $o['user_id'] && $o['status'] != -1): ?>
							
							<a class="btn btn-danger" href="/reject_project/<?= $o['id']; ?>">Отклонить свою заявку</a>
							<? endif; ?>
							<? if($this->user['id'] == $params['article']['user_id']): ?>
								
									
									<? if($o['status'] == 0): ?>
										
										<? if(!isset($params['already_selected_offer'])): ?>
										
											<a class="btn btn-success" href="/acceptoffer/<?= $o['id']; ?>">Принять заявку</a>
											<a class="btn btn-danger" href="/rejectoffer/<?= $o['id']; ?>">Отклонить заявку</a>
										<? else: ?>
										
										<? endif; ?>
									<? else: ?>
										
									<? endif; ?>
								
							<? endif; ?>
							
							<hr />
							<? if($o['result'] == -1): ?>
									<div class="rejected_offer">
									<strong><?= $o['status'] == -1 ? 'Пользователь отказался от проекта' : ''; ?></strong>
									</div>
							<? else: ?>
								<? if($o['status'] == 1): ?>
									<div class="selected_offer">
									<strong><?= $o['status'] == 1 ? 'Выбранная заявка' : ''; ?></strong>
									</div>
								<? else: ?>
									<div class="rejected_offer">
									<strong><?= $o['status'] == -1 ? 'Отклонённая заявка' : ''; ?></strong>
									</div>
								<? endif; ?>
							<? endif; ?>
						</div>
					</div>
				<? endforeach; ?>
			<? else: ?>
				Нет заявок
			<? endif; ?>
			</div>
		</div>
	</div>
	
</div>
<?= $this->call("index/index/footer"); ?>