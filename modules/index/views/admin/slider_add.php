<?= $this->call("index/admin/header", array( 'title' => 'Редактировать слайдер')); ?>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');

?>
	<h1>Добавление слайдера</h1>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="url">url</label>
			<input id="url" class="form-control" name="url" type="text" maxlength="255" value="<?= $olds['url']; ?>" />
			<? if(isset($errors['url'])): ?>
				<? foreach($errors['url'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
			<div>
				<input type="checkbox" name="new" value="1" /> открывать в новом окне
			</div>
		</div>
		<div class="form-group form-inline">
			<label for="type">картинка</label>
			<input type="file" class="form-control" name="img[]" style="margin-right: 10px;" /> 
			 или укажите url картинки <input placeholder="https://site.com/folder/image.png" style="margin-left: 10px; width: 50%;" type="text" class="form-control" name="url_img" />
		</div>
		<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
		<div class="form-group">
			<button class="btn btn-success">Добавить</button>
		</div>
		</div>
	</form>
<?= $this->call("index/admin/footer"); ?>