<?= $this->call("index/index/header", array('hide_buttons' => true, 'title' => 'Вход')); ?>
<h1>Вход</h1>
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
<label for="password">Пароль</label>
<input id="password" maxlength="255" required class="form-control" type="password" name="password" />
<? if(isset($errors['password'])): ?>
	<? foreach($errors['password'] as $e): ?>
		<div class="error">
			<?= $e; ?>
		</div>
	<? endforeach; ?>
<? endif; ?>
</div>
<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
<div class="form-group">
	<button class="btn btn-success">Войти в Личный кабинет</button>
</div>
</form>
<?= $this->call("index/index/footer"); ?>