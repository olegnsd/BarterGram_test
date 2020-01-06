<?= $this->call("index/index/header", array('title' => 'Настройки')); ?>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');
?>
<div class="rightBar userSettings">
<div class="avatar">
	<? if($params['files']): ?>
		<img src="/assets/uploads/users/<?= $params['user']['id']; ?>/<?= $params['files'][0]; ?>" />
	<? else: ?>
		<img src="/assets/uploads/no-avatar.png" />
	<? endif; ?>
</div>
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
	<hr />
<form method="post">
	<h3>Прежде чем сделать какие-либо изменения введите ваш старый пароль</h3>
	<div class="form-group">
		<label for="password_old">Введите ваш старый пароль</label>
		<input id="password_old" class="form-control" type="password" name="password_old" />
			<? if(isset($errors['password_old'])): ?>
				<? foreach($errors['password_old'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
	</div>



	<div class="form-group">
		<label for="phone">Телефон</label>
		<input id="phone" class="form-control" type="text" name="phone" value="<?= $this->user['phone']; ?>" />
			<? if(isset($errors['phone'])): ?>
				<? foreach($errors['phone'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
	</div>
	<div class="form-group">
		<label for="password_new">Пароль</label>
		<input id="password_new" class="form-control" type="text" name="password_new" />
			<? if(isset($errors['password_new'])): ?>
				<? foreach($errors['password_new'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
	</div>
	<div class="form-group">
		<label for="password_re">Повторите пароль</label>
		<input id="password_re" class="form-control" type="text" name="password_re" />
			<? if(isset($errors['password_re'])): ?>
				<? foreach($errors['password_re'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
	</div>
<p><button class="btn btn-success">Сохранить</button></p>
<input type="hidden" id="id" name="id" value="<?= $this->user['id']; ?>" />
<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get("csrf"); ?>" />
</form>
</div>
<?= $this->call("index/index/footer"); ?>