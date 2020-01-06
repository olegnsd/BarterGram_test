<?= $this->call("index/admin/header"); ?>
<div class="content">
<h3>Редактирование Новость</h3>
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
<form method="post">
<div class="form-group">
<label for="title">Заголовок (укажите уникальное название)</label>
<input id="title" class="form-control" type="text" name="title" value="<?= $params['news']['title']; ?>" />
</div>

<div class="form-group">
<label for="url">Контент</label>
<textarea name="content"><?= $params['news']['content']; ?></textarea>
</div>

<button class="btn btn-success">Сохранить</button>
<input type="hidden" name="id" value="<?= $params['news']['id']; ?>" />
<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get("csrf"); ?>">
</form>

</div>
<?= $this->call("index/admin/footer"); ?>