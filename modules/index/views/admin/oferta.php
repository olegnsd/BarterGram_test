<?= $this->call("index/admin/header", array('title' => 'Настройки')); ?>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');

?>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Название</label>
			<input id="title" required class="form-control" name="title" type="text" maxlength="255" value="<?= $params['oferta']['title']; ?>" />
			<? if(isset($errors['title'])): ?>
				<? foreach($errors['title'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<div class="form-group">
			<label for="description">Описание</label>
			<textarea id="description" required name="description" class="form-control description"><?= $params['oferta']['description']; ?></textarea>
			<? if(isset($errors['description'])): ?>
				<? foreach($errors['description'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<input type="hidden" id="page_id" name="page_id" value="<?= $params['oferta']['id']; ?>" />
		<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
		<div class="form-group">
			<button class="btn btn-success">Редактировать</button>
		</div>
	</form>
<?= $this->call("index/admin/footer"); ?>