<?= $this->call("index/admin/header", array('title' => 'Добавление пользователя ')); ?>
<h1>Добавление пользователя</h1>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');
?>
<form method="post">
<div class="form-group">
<label for="login">Логин</label>
<input id="login" maxlength="255" required class="form-control" type="text" name="login" value="<?= $olds['login']; ?>" />
<? if(isset($errors['login'])): ?>
	<? foreach($errors['login'] as $e): ?>
		<div class="error">
			<?= $e; ?>
		</div>
	<? endforeach; ?>
<? endif; ?>
</div>
<div class="form-group">
<label for="email">E-mail</label>
<input id="email" required class="form-control" type="text" name="email" value="<?= $olds['email']; ?>" />
<? if(isset($errors['email'])): ?>
	<? foreach($errors['email'] as $e): ?>
		<div class="error">
			<?= $e; ?>
		</div>
	<? endforeach; ?>
<? endif; ?>
</div>
<div class="form-group">
<label for="phone">Телефон</label>
<input id="phone" required class="form-control" type="text" name="phone" value="<?= $olds['phone']; ?>" />
<? if(isset($errors['phone'])): ?>
	<? foreach($errors['phone'] as $e): ?>
		<div class="error">
			<?= $e; ?>
		</div>
	<? endforeach; ?>
<? endif; ?>
</div>
<div class="form-group">
<label for="password">Пароль</label>
<input id="password" maxlength="255" class="form-control" type="password" name="password" />
<? if(isset($errors['password'])): ?>
	<? foreach($errors['password'] as $e): ?>
		<div class="error">
			<?= $e; ?>
		</div>
	<? endforeach; ?>
<? endif; ?>
</div>
<div class="form-group">
<label for="password_re">Повторить пароль</label>
<input id="password_re" maxlength="255" class="form-control" type="password" name="password_re" />
<? if(isset($errors['password_re'])): ?>
	<? foreach($errors['password_re'] as $e): ?>
		<div class="error">
			<?= $e; ?>
		</div>
	<? endforeach; ?>
<? endif; ?>
</div>
		<div class="form-group form-inline">
			<label for="pay_type">Тип пользователя</label>
			
			<select required name="type" class="form-control currency">
				<option value="1">Пользователь</option>
				<option value="2">Администратор</option>
			</select>
			<? if(isset($errors['type'])): ?>
				<? foreach($errors['type'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
<div class="form-group">
	<button class="btn btn-success">Добавить</button>
</div>
</form>
<?= $this->call("index/index/footer"); ?>