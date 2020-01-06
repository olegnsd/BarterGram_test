<?= $this->call("index/admin/header", array( 'title' => 'Добавление обьявления')); ?>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');

?>
	<h1>Добавление обьявления</h1>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Название</label>
			<input id="title" required class="form-control" name="title" type="text" maxlength="255" value="<?= $olds['title']; ?>" />
			<? if(isset($errors['title'])): ?>
				<? foreach($errors['title'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<div class="form-group form-inline">
			<label for="type">Тип</label>
			
			<select required name="type" class="form-control currency">
				<option value="s">Спрос</option>
				<option value="p">Предложение</option>
			</select>
			<? if(isset($errors['type'])): ?>
				<? foreach($errors['type'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<div class="form-group form-inline">
			<label for="category_id">Категория</label>
			
			<select required id="category_id" name="category_id" class="form-control currency">
				<? foreach($params['categories'] as $a): ?>
				<option value="<?= $a['id']; ?>"><?= $a['title']; ?></option>
				<? endforeach; ?>
			</select>
			<? if(isset($errors['category_id'])): ?>
				<? foreach($errors['category_id'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<div class="form-group">
			<label for="description">Описание</label>
			<textarea id="description" name="description" class="form-control description"><?= $olds['description']; ?></textarea>
			<? if(isset($errors['description'])): ?>
				<? foreach($errors['description'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		
		<div class="form-group form-inline">
			<label for="price">Цена</label>
			<input id="price" required class="form-control price" name="price" type="number" value="<?= $olds['price'] ? $olds['price'] : 0; ?>" />
			
			<select required name="currency" class="form-control currency">
				<option value="1">сом</option>
				<option value="2">$</option>
				<option value="3">€</option>
				<option value="4">рубль</option>
			</select>
			<? if(isset($errors['price'])): ?>
				<? foreach($errors['price'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<div class="form-group form-inline">
			<label for="pay_type">Тип оплаты</label>
			
			<select required id="pay_type" name="pay_type" class="form-control currency">
				<option value="1">Наличными</option>
				<option value="2">Через систему оплаты qiwi</option>
				<option value="3">Через систему оплаты yandex money</option>
				<option value="4">Через систему оплаты webmoney</option>
			</select>
			<? if(isset($errors['pay_type'])): ?>
				<? foreach($errors['pay_type'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<div class="form-group">
			<label for="files">Прикрепить файлы (можно несколько)</label>
			<input id="files" class="form-control" name="files[]" type="file" multiple />
			<? if(isset($errors['files'])): ?>
				<? foreach($errors['files'] as $e): ?>
					<div class="error">
						<?= $e; ?>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
		<input type="hidden" id="csrf" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
		<div class="form-group">
			<button class="btn btn-success">Добавить</button>
		</div>
		</div>
	</form>
<?= $this->call("index/admin/footer"); ?>