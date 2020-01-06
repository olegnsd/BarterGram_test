<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
<style>
	.error {
		
		color: red;
		text-align: center;
		
	}
	.message {
		
		color: green;
		text-align: center;
	}
	.layout {
		
		width: 70%;
		margin: auto;
		
		
	}
</style>
</head>
<body>
	<div class="layout">
	
		<form method="post">
		<h2 style="text-align: center;">Вход в админку</h2>
		
		<? if($this->session->hasFlash('error')): ?>
			<div class="error">
				<?= $this->session->getFlash('error'); ?>
			</div>
		<? endif; ?>
		<? if($this->session->hasFlash('message')): ?>
			<div class="message">
				<?= $this->session->getFlash('message'); ?>
			</div>
		<? endif; ?>
			<div class="form-group">
			<label for="login">Логин</label>
			<input id="login" class="form-control" type="text" name="login" />
			</div>
			<div class="form-group">
			<label for="password">Пароль</label>
			<input id="password" class="form-control" type="password" name="password" />
			</div>
			<p><button class="btn btn-success">Войти</button></p>
			<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get("csrf"); ?>">
		</form>
		<a href="/">Вернутся на главную</a>
	</div>
</body>
</html>