<?= $this->call("index/index/header", array('title' => 'Пользователи')); ?>
<div class="clear"></div>
<div class="content2">
	<?= $this->call('leftBar'); ?>
	<div class="rightBar">
		<h2>Поиск по Пользователям</h2>
		
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
						<option <?= $this->input->get('sort')== 'login' ? 'selected' : ''; ?> value="login">
						по имени
						</option>
						<option <?= $this->input->get('sort')== 'price' ? 'selected' : ''; ?> value="created_at">
						по дате регистрации
						</option>
					</select>
			
					<select class="form-control" id="direction" name="direction">
						<option <?= $this->input->get('direction')== 'desc' ? 'selected' : ''; ?>  value="desc">
						&#8593; вверх
						</option>
						<option <?= $this->input->get('direction')== 'asc' ? 'selected' : ''; ?>  value="asc">
						&#8595; вниз
						</option>
					</select>
				</div>
				<label for="sort">
					Дополнительно
				</label>
				<div class="input-group">
					<label class="checkbox-inline">
					  <input <?= $this->input->get('only_with_plus_results') == 1 ? 'checked' : ''; ?> name="only_with_plus_results" type="checkbox" value="1"> только с положительными отзывами
					</label>
				</div>
				<div style="margin-top: 10px; margin-bottom: 10px;"><button class="btn btn-success">Применить</button></div>
			</form>
		</div>
		<? if($params['users']): ?>
		<h3>Пользователи</h3>
		<div class="users">
		<? foreach($params['users'] as $a): ?>
			<div class="article_item">
				<a href="/user/<?= $a['login']; ?>"><?= $a['login']; ?></a>
				<!--
				<? if($a['result'] >= 0): ?>
				<i>(<?= $a['result'] ? $a['result'] : 0; ?>)</i>
				<? else: ?>
				<i>(<?= $a['result'] ? $a['result'] : 0; ?>)</i>
				<? endif; ?>
				-->
				<div class="clear"></div>
				<div class="article_avatar">
					
					<a href="/user/<?= $a['id']; ?>">
					
					<? if($a['files'] && file_exists('./assets/uploads/users/'.$a['id'].'/'.$a['files'][0])): ?>
						<img src="/assets/uploads/users/<?= $a['id']; ?>/<?= $a['files'][0]; ?>" />
					<? else: ?>
						<img src="/assets/uploads/no-avatar.png" />
					<? endif; ?>
					</a>
				</div>
				<div class="clear"></div>
				<div class="rating">
					<div class="rating_plus">
					<img src="/assets/images/like.png" /> <?= $a['rating_plus']; ?>
					</div>
					<div class="rating_minus">
					<img src="/assets/images/dislike.png" /> <?= $a['rating_minus']; ?>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="created_at_article"><?= $a['created_at']; ?></div>
				<div class="clear"></div>
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет обьявлений</p>
		<? endif; ?>
		</div>
		<div class="clear"></div>
		<?= $params['nextprevlinks']; ?>
		</div>
	</div>
</div>
<?= $this->call("index/index/footer"); ?>