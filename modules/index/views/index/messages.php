<?= $this->call("index/index/header", array('title' => 'Сообщения')); ?>
		
	<div class="messages">
	
		<? if(isset($params['messages'])): ?>
			<h1>Переписка с пользователем <a href="/user/<?= $params['messager']; ?>"><?= $params['messager']; ?></a></h1>
			<p><a href="/messages">назад к списку переписок</a></p>
			
	<? if(isset($params['finishes']) && $params['finishes']): ?>
		
	<div class="form-control">
	
		
		<? foreach($params['finishes'] as $f): ?>
			
		<form method="post" action="/finish_project">
			<h2>Проект "<?= $f['title']; ?>"</h2>
				<p>Вы можете завершить проект с отзывом в любой момент</p>
				<label for="revision_<?= $f['id']; ?>">Отзыв</label>
				<textarea name="revision" class="form-control" id="revision_<?= $f['id']; ?>" name="revision_<?= $f['id']; ?>"></textarea>
			<div class="form-group">
			<div class="form-check">
			  <input id="result_pay_1" type="radio" class="form-check-input" name="result_pay" value="1" checked />
			  <label class="form-check-label" for="result_pay_1">Принять проект и выплатить деньги</label>
			</div>
			<div class="form-check">
			  <input id="result_pay_2" type="radio" class="form-check-input" name="result_pay" value="-1" />
			  <label class="form-check-label" for="result_pay_2">Проект не выполнен, не выплачивать деньги</label>
			</div>
				<!--
			<div class="form-check">
			  <input id="result_pay_3" type="radio" class="form-check-input" name="result_pay" value="0" />
			  <label class="form-check-label" for="result_pay_3">Привлечь арбитраж</label>
			</div>
				-->
			</div>
			<div class="form-check rating_plus">
			  <input type="radio" class="form-check-input" name="result" value="1" checked />
			  <label class="form-check-label" for="materialGroupExample1">+</label>
			</div>

			
			<div class="form-check rating_minus">
			  <input type="radio" class="form-check-input" name="result" value="-1" />
			  <label class="form-check-label" for="materialGroupExample2">-</label>
			</div>
			<input type="hidden" name="article_id" value="<?= $f['article_id']; ?>" />
			<input type="hidden" name="offer_id" value="<?= $f['id']; ?>" />
			<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
			<p><button class="btn btn-success">Завершить</button></p>
		</form>
		<? endforeach; ?>
	</div>
		
		<? endif; ?>

		<? if(isset($params['work_user_projects2'])): ?>
			<? foreach($params['work_user_projects2'] as $f): ?>
				<p>Проект <strong>"<?= $f['title']; ?>"</strong></p>
		<? if($f['reservation'] && (($f['finished'] && $f['payed'] != 0 && !$f['arbitrary']) || (!$f['finished'] && !$f['arbitrary']))): ?>
			<form method="post" action="/arbitrary_project">
				<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
				<input type="hidden" name="article_id" value="<?= $f['article_id']; ?>" />
				<p><button class="btn btn-warning">Арбитраж</button></p>
			</form>
		<? else: ?>
		
			<? if($f['payed'] == 0 && !$f['arbitrary']): ?>
		
		<p><strong>Проект на рассмотрении арбитража</strong></p>
			<? endif; ?>
		<? endif; ?>
			<? endforeach; ?>
		
		
		<? endif; ?>
		
		<? if(isset($params['work_user_projects'])): ?>
			<? foreach($params['work_user_projects'] as $f): ?>
				<p>Проект <strong>"<?= $f['title']; ?>"</strong></p>
		<? if(!$f['finished']): ?>
			<form method="post" action="/reject_project">
				<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
				<input type="hidden" name="offer_id" value="<?= $f['id']; ?>" />
				<p><button class="btn btn-danger">Отказатся</button></p>
			</form>
		<? endif; ?>
		<? if($f['reservation'] && (($f['finished'] && $f['payed'] != 0 && !$f['arbitrary']) || (!$f['finished'] && !$f['arbitrary']))): ?>
			<form method="post" action="/arbitrary_project">
				<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
				<input type="hidden" name="article_id" value="<?= $f['article_id']; ?>" />
				<p><button class="btn btn-warning">Арбитраж</button></p>
			</form>
		<? else: ?>
		
			<? if($f['payed'] == 0 && !$f['arbitrary']): ?>
		
		<p><strong>Проект на рассмотрении арбитража</strong></p>
			<? endif; ?>
		<? endif; ?>
			<? endforeach; ?>
		
		
		<? endif; ?>
<hr />
		<? foreach($params['messages'] as $m): ?>
					<? if($m['from_id'] == $params['work_user']): ?>
						
						<div class="message from  <?=  $m['is_new_from'] ? 'is_new' : ''; ?>" id="message_<?= $m['id']; ?>">
							<span style="color: purple;"><?= $m['created_at']; ?></span> |
							<strong><a href="/user/<?= $m['from_login']; ?>"><?= $m['from_login']; ?></a></strong> 
							<div>
								<? if($m['is_system']): ?>
									<?= $m['back_message']; ?>
								<? else: ?>
									<?= $m['message']; ?>
								<? endif; ?>
							</div>
							
						</div>
					<? else: ?>
					
						<div class="message to <?= $m['is_new'] == 1 ? 'is_new' : ''; ?>" id="message_<?= $m['id']; ?>">
							<span style="color: purple;"><?= $m['created_at']; ?></span> |
							<strong><a href="/user/<?= $m['from_login']; ?>"><?= $m['from_login']; ?></a></strong> 
							<div>
								<?= $m['message']; ?>
							</div>
							
						</div>
					<? endif; ?>
		<? endforeach; ?>
		<div class="clear"></div>
		<hr />
		<form method="post" action="/sendmessage/<?= $params['id']; ?>">
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
				<input type="hidden" name="offer_id" value="<?= $params['offer_id']; ?>" />
				<div class="form-group">
					<button class="btn btn-success">Отправить</button>
				</div>
			</div>
		</form>
		<? else: ?>
				<h1>Переписки</h1>
			<? if(isset($params['message_groups']) && $params['message_groups']): ?>
				<? foreach($params['message_groups'] as $key => $m): ?>
					<? if($m['from_id'] == $this->user['id']): ?>
					
					<div class="message <?=  $m['is_new_from'] ? 'is_new' : ''; ?>">
						<strong><a href="/user/<?= $m['to_login']; ?>"><?= $m['to_login']; ?></a></strong> (<?= $m['count_messages']; ?>)
						<? if($m['article_title']): ?>
						(Проект: <strong><?= $m['article_title']; ?></strong>)
						<? endif; ?>
						<a href="/messages/<?= $m['conversation_id']; ?>">Прочитать</a>
					</div>
					<? else: ?>
					
					<div class="message <?=  $m['is_new'] ? 'is_new' : ''; ?>">
						<strong><a href="/user/<?= $m['to_login']; ?>"><?= $m['from_login']; ?></a></strong> (<?= $m['count_messages']; ?>)
						<? if($m['article_title']): ?>
						(Проект: <strong><?= $m['article_title']; ?></strong>)
						<? endif; ?>
						<a href="/messages/<?= $m['conversation_id']; ?>">Прочитать</a>
					</div>
					
					<? endif; ?>
				<? endforeach; ?>
			<? else: ?>
				<p>Нет переписок</p>
			<? endif; ?>
			
		<? endif; ?>
	</div>
<?= $this->call("index/index/footer"); ?>