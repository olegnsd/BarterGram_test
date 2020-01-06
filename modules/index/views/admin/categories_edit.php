<?= $this->call("index/admin/header"); ?>
<div class="content">
<h3>Редактирование меню</h3>
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
<input required id="title" class="form-control" type="text" name="title" value="<?= $params['menu']['title']; ?>" />
</div>
<div class="form-group">
<label for="url">url (оставьте поле пустым и оно будет сгенерировано автоматический в соответствии с уникальным заголовком)</label>
<input placeholder="https://example.com" id="url" class="form-control" type="text" name="url" value="<?= $params['menu']['url']; ?>" />
</div>
<div class="form-group">
<label>Контент</label>
<textarea name="content"><?= $params['menu']['content']; ?></textarea>
</div>
<div class="form-group">
<label for="parent_id">Родительское меню</label>
<select id="parent_id" class="form-control" name="parent_id">
	<option value="0">Нет родителя</option>
	<? foreach($params['menus'] as $m): ?>
		<? if($m['id'] == $params['menu']['id']) {continue;} ?>
		<option <? if($m['id'] == $params['menu']['parent_id']) {echo 'selected';} ?> value="<?= $m['id']; ?>"><?= $m['title']; ?></option>
	<? endforeach; ?>

</select>
</div>
<button class="btn btn-success">Сохранить</button>
<input type="hidden" name="id" value="<?= $params['menu']['id']; ?>" />
<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get("csrf"); ?>">
</form>

</div>
<?= $this->call("index/admin/footer"); ?>