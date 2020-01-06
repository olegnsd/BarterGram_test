<?= $this->call("index/index/header", array( 'title' => 'Добавить запись')); ?>
<?

	$olds = $this->session->getFlash('olds');
	$errors = $this->session->getFlash('errors');

?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
	tinymce.init({
	selector:'textarea',
	height: 400,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste code"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
</script>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="message">Название</label>
			<input id="message" required class="form-control" name="title" type="text" maxlength="255" value="<?= $params['article']['title']; ?>" />
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
			
			<select id="type" required name="type" class="form-control currency">
				<option <?= ($params['article']['type'] == 's') ? 'selected' : ''; ?> value="s">Спрос</option>
				<option <?= ($params['article']['type'] == 'p') ? 'selected' : ''; ?> value="p">Предложение</option>
			</select>
			<script>
			$(function(){
				
				$('#type').change(function(){
				
					if($(this).val() == 's')
					{
						$('#tp').hide();
						$('#ts').show();
					}
					if($(this).val() == 'p')
					{
						$('#ts').hide();
						$('#tp').show();
					}
				
				});
			});
			</script>
			<style>
				#ts, #tp {

					margin-left: 15px;	
				}
				<? if($params['article']['type'] == 's'): ?>
				#tp {
					
				display: none;	
				}
				<? endif; ?>
				<? if($params['article']['type'] == 'p'): ?>
				#ts {
					
				display: none;	
				}
				<? endif; ?>
			</style>
			<span id="ts">
			мне нужен товар или услуга
			</span>
			<span id="tp">
			я предлагаю товар или услугу
			</span>
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
			
			<select required name="category_id" class="form-control currency">
				<? foreach($params['categories'] as $a): ?>
				<option <?= ($a['id'] == $params['article']['category_id']) ? 'selected' : ''; ?> value="<?= $a['id']; ?>"><?= $a['title']; ?></option>
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
			<textarea id="description" name="description" class="form-control description"><?= $params['article']['description']; ?></textarea>
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
			<input id="price" required class="form-control price" min="1" name="price" type="number" value="<?= $params['article']['price']; ?>" />
			
			<select required name="currency" class="form-control currency">
				<option <?= ($params['article']['currency'] == 1) ? 'selected' : ''; ?> value="1">сом</option>
				<option <?= ($params['article']['currency'] == 2) ? 'selected' : ''; ?> value="2">$</option>
				<option <?= ($params['article']['currency'] == 3) ? 'selected' : ''; ?> value="3">€</option>
				<option <?= ($params['article']['currency'] == 4) ? 'selected' : ''; ?> value="4">рубль</option>
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
			
			<select required name="pay_type" class="form-control currency">
				<option <?= ($params['article']['pay_type'] == 1) ? 'selected' : ''; ?> value="1">Наличными</option>
				<option <?= ($params['article']['pay_type'] == 2) ? 'selected' : ''; ?> value="2">Через систему оплаты qiwi</option>
				<option <?= ($params['article']['pay_type'] == 3) ? 'selected' : ''; ?> value="3">Через систему оплаты yandex money</option>
				<option <?= ($params['article']['pay_type'] == 4) ? 'selected' : ''; ?> value="4">Через систему оплаты webmoney</option>
				<option <?= ($params['article']['pay_type'] == 5) ? 'selected' : ''; ?> value="5">Перечислить на счет stol-zakazov.online</option>
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
		<? if($params['files']): ?>
			<div class="form-group">
			<p><strong>Текущие рикреплённые файлы:</strong> (при загрузке новых файлов, старые будут удалены)</p>
			<? foreach($params['files'] as $key => $f): ?>
				<div>
					<a target="_blank" href="/assets/uploads/articles/<?= $params['article']['id'].'/'.$f; ?>">Файл <?= ($key + 1); ?></a>
				</div>
			<? endforeach; ?>
			</div>
		<? endif; ?>
		<input type="hidden" name="article_id" value="<?= $params['article']['id']; ?>" />
		<input type="hidden" name="csrf" value="<?= $this->session->get('csrf'); ?>" />
		<div class="form-group">
			<button class="btn btn-success">Редактировать</button>
			<a href="/user" class="btn btn-danger">Отмена</a>
		</div>
		</div>
	</form>
<?= $this->call("index/index/footer"); ?>