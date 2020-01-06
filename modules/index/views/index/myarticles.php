<?= $this->call("index/index/header", array( 'title' => 'Мои обьявления')); ?>
		<h1>Мои обьявления</h1>
		<div id="articles" class="articles">
		<? if($params['articles']): ?>
		<? foreach($params['articles'] as $a): ?>
			<div class="article_item">
				<div class="article_avatar">
					<a href="/user/<?= $a['user_id']; ?>">
					<? if($a['files']): ?>
						<img src="/assets/uploads/users/<?= $a['user_id']; ?>/<?= $a['files'][0]; ?>" />
					<? else: ?>
						<img src="/assets/uploads/no-avatar.png" />
					<? endif; ?>
					</a>
				</div>
				<a href="/article/<?= \dvijok\core\Helper::transliterate($a['title']).'-'.$a['id']; ?>"><?= $a['title']; ?> (<i><?= $a['type'] == 'p' ? 'предложение' : 'спрос'; ?></i>)</a>
				<? if($a['finished']): ?>
				<span class="a_f">ЗАВЕРШЁН</span>
				
				<? endif; ?>
				<div class="a_p_t">
					<div class="article_item_price">
						<strong><?= $a['price']; ?> <?= \dvijok\core\Config::$currencies[$a['currency']]; ?></strong>
					</div>
					<div class="article_item_pay_type">
						<strong><?= \dvijok\core\Config::$payment_types[$a['pay_type']]; ?></strong>
					</div>
				</div>
				<div class="clear"></div>
				<span class="cr"><?= $a['created_at']; ?></span>
				<div class="clear"></div>
				<div class="article_item_description">
				<?= \dvijok\core\Helper::truncate($a['description'], 250); ?>
				</div>
			</div>
		<? endforeach; ?>
		<? else: ?>
		<p>Нет обьявлений</p>
		<? endif; ?>
		</div>
<?= $this->call("index/index/footer"); ?>