<?= $this->call("index/admin/header", array( 'title' => 'Редактирование слайдера')); ?>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');

?>
	<h1>Редактирование слайдера</h1>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="url">url</label>
			<input id="url" class="form-control" name="url" type="text" maxlength="255" value="<?= $params['slider']['url']; ?>" />
			<? if(isset($errors['url'])): ?>
				<? foreach($errors['url'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
			<div>
				<input type="checkbox" name="new" value="1" <?= $params['slider']['new'] ? 'checked' : ''; ?> /> открывать в новом окне
			</div>
		</div>
		<div class="form-group form-inline">
			<label for="type">картинка</label>
			<input type="file" class="form-control" name="img[]" style="margin-right: 10px;" /> 
			 или укажите url картинки <input placeholder="https://site.com/folder/image.png" style="margin-left: 10px; width: 50%;" type="text" class="form-control" name="url_img" />
		</div>
		<div style="margin-bottom: 10px;">
			<p>Текущая картинка</p>
			<img src="<?= preg_match("%https?://%ix", $params['slider']['img']) ? $params['slider']['img'] : '/assets/uploads/slider/'.$params['slider']['id'].'/'.$params['slider']['img']; ?>" />
		</div>
		<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
		<div class="form-group">
			<button class="btn btn-success">Редактировать</button>
		</div>
		</div>
	</form>
<?= $this->call("index/admin/footer"); ?>