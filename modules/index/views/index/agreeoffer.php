<?= $this->call("index/index/header", array('title' => 'Принятие сделки')); ?>
<h1>Принятие сделки проекта "<?= $params['article']['title']; ?>"</h1>
<form method="post">
	<label>Вы действительно согласны принять сделку?</label>
	<div class="form-group">
		<button class="btn btn-success" name="agree" value="1">Принять</button>
		<button class="btn btn-danger" name="agree" value="-1">Отклонить</button>
	</div>
	<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
</form>
<?= $this->call("index/index/footer"); ?>