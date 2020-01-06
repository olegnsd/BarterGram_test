<?= $this->call("index/index/header"); ?>
<? if($this->session->hasFlash('register_success', true)): ?>
<h3 class="text-success">Письмо с активацией выслано на ваш E-mail: <?= $this->session->getFlash('register_success_email'); ?></h3>
<? else: ?>
<h3 class="text-danger">Эта страница устарела</h3>
<? endif; ?>
	<a href="/" class="btn btn-success text-white">Вернутся на главную</a>
<?= $this->call("index/index/footer"); ?>