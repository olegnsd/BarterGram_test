<?= $this->call("index/admin/header"); ?>
<div class="content">
<h3>Редактировать о нас</h3>
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
<label for="title">Заголовок</label>
<input id="title" class="form-control" type="text" name="title" value="<?= $params['little_about_us']['title']; ?>" />
</div>
<div class="form-group">
<label for="url">Контент</label>
<textarea name="content"><?= $params['little_about_us']['content']; ?></textarea>
</div>

<button class="btn btn-success">Сохранить</button>
<input type="hidden" name="id" value="<?= $params['little_about_us']['id']; ?>" />
<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get("csrf"); ?>">
</form>
</div>
<?= $this->call("index/admin/footer"); ?>