<?= $this->call("index/index/header", array( 'title' => 'Резервирование средств')); ?>
<h1>Резервирование средств для проекта "<?= $params['article']['title']; ?>"</h1>
<form method="post">
	<div class="form-group">
		<label for="amount">Сумма</label>
		<input style="width: 20%;" id="amount" class="inline-control" required type="number" name="amount" value="0" />
		<strong><?= \dvijok\core\Config::$currencies[$params['article']['currency']] ?></strong>
	</div>
	<p><button class="btn btn-success">Отправить</button></p>
	<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
</form>
<?= $this->call("index/index/footer"); ?>