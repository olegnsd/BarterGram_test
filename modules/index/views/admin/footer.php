
	</div>
</div>
	<div class="footer">
    Все права защищены @copyright 2018
	</div>
<div class="dark">
	<div class="win win_auth">
			<img src="/assets/images/close-button-icon.png" class="close" />
		<h2>Вход</h2>
		<?

			$olds = $this->session->getFlash('olds');
			$errors = $this->session->getFlash('errors');
		?>
		<form method="post" action="/login">
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
		<!--<input type="hidden" name="redirectTo" value="<?= $this->current_url; ?>" />-->
		<input type="hidden" name="show_auth" value="1" />
		<div class="form-group">
			<button class="btn btn-success">Отправить</button>
		</div>
		</form>
	</div>
	<div class="win win_message">
			<img src="/assets/images/close-button-icon.png" class="close" />
		<?= $this->session->getFlash('message'); ?>
	</div>
	<? if($this->session->hasFlash('show_auth')): ?>
		<script>
		$('.dark, .win_auth').show();
		</script>
	
	<? endif; ?>
	<? if($this->session->hasFlash('message')): ?>
		<script>
		$('.dark, .win_message').show();
		</script>
	
	<? endif; ?>
</div>
<?php
			$this->session->clearFlash();
?>
</body>
</html>