		<div class="filter form-control">
			<form method="get">
				<input type="hidden" name="page" value="1" />
				<h3>Для ускорения поиска воспользуйтесь уточняющим фильтром</h3>
				<label for="search">
				Введите ключевые слова
				</label>
				<input type="text" id="search" name="search" class="form-control" value="<?= $this->input->get('search') ? $this->input->get('search') : ''; ?>" />
				<label for="sort">
				Сортировать
				</label>
				<div class="input-group">
					<select class="form-control" id="sort" name="sort">
						<option <?= $this->input->get('sort')== 'created_at' ? 'selected' : ''; ?> value="created_at">
						по дате
						</option>
						<option <?= $this->input->get('sort')== 'price' ? 'selected' : ''; ?> value="price">
						по цене
						</option>
					</select>
			
					<select class="form-control" id="direction" name="direction">
						<option <?= $this->input->get('direction')== 'desc' ? 'selected' : ''; ?>  value="desc">
						&#8593; новые вверх
						</option>
						<option <?= $this->input->get('direction')== 'asc' ? 'selected' : ''; ?>  value="asc">
						&#8595; старые вверх
						</option>
					</select>
				</div>
				<label for="sort">
					Дополнительно
				</label>
				<div class="input-group">
					<label class="checkbox-inline">
					  <input <?= $this->input->get('type') == '' ? 'checked' : ''; ?> name="type" type="radio" value="">Все
					</label>
					<label class="checkbox-inline">
					  <input <?= $this->input->get('type') == 'p' ? 'checked' : ''; ?> name="type" type="radio" value="p">Предложение
					</label>
					<label class="checkbox-inline">
					  <input <?= $this->input->get('type') == 's' ? 'checked' : ''; ?> name="type" type="radio" value="s">Спрос
					</label>
					<label class="checkbox-inline">
					  <input <?= $this->input->get('pay_type') == 1 ? 'checked' : ''; ?> name="pay_type" type="checkbox" value="1">наличными
					</label>
					<label class="checkbox-inline">
					  <input <?= $this->input->get('finished') == 1 ? 'checked' : ''; ?> name="finished" 
					  <?= $this->input->get('finished') ? 'checked' : ''; ?> type="checkbox" value="1">Отображать завершённые
					</label>
				</div>
				<div style="margin-top: 10px; margin-bottom: 10px;"><button class="btn btn-success">Применить</button></div>
			</form>
		</div>