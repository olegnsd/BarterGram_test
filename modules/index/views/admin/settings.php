<?= $this->call("index/admin/header", array('title' => 'Настройки')); ?>
<h1>Настройки сайта</h1>
<form method="post">
<div class="form-group">
	<label for="title">Название сайта</label>
	<input class="form-control" type="text" name="title" id="title" value="<?= $this->settings['title']; ?>" />
</div>
<div class="form-group site_enabled"> 
	<label for="site_enabled">Включить/Выключить сайт</label>
	<div>
	<input class="radio-inline" type="radio" name="site_enabled" id="site_enabled1" <?= $this->settings['site_enabled'] == 1 ? 'checked' : ''; ?> value="1" /> Включить 
	<input class="radio-inline" type="radio" name="site_enabled" id="site_enabled2" <?= $this->settings['site_enabled'] == 0 ? 'checked' : ''; ?> value="0" /> Выключить 
	</div>
</div>
<div class="form-group">
	<label for="title">Выводить слайдер только на главной</label>
	<div>
		<input class="radio-inline" type="radio" name="slider_on_main" id="slider_on_main1" <?= $this->settings['slider_on_main'] == 1 ? 'checked' : ''; ?> value="1" /> да 
		<input class="radio-inline" type="radio" name="slider_on_main" id="slider_on_main2" <?= $this->settings['slider_on_main'] == 0 ? 'checked' : ''; ?> value="0" /> нет
	</div>
</div>
<div class="form-group">
	<label for="title">Выводить по странично</label>
	<input class="form-control" type="number" min="1" name="per_page" id="per_page" value="<?= $this->settings['per_page']; ?>" />
</div>
<div class="form-group">
	<label for="title">Копирайт</label>
	<input class="form-control" type="text" name="copyright" id="copyright" value="<?= $this->settings['copyright']; ?>" />
</div>
<p><button class="btn btn-success">Сохранить</button></p>
<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get("csrf"); ?>">
</form>
<?= $this->call("index/admin/footer"); ?> 