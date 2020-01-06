<?= $this->call("index/index/header", array('title' => $params['cat']['title'])); ?>
<div class="clear"></div>
<div class="content2">
	<?= $this->call('leftBar'); ?>
	<div class="rightBar">
		<h2>Категория "<?= $params['cat']['title']; ?>"</h2>
		<div>
		<?= $params['cat']['content']; ?>
		</div>
		<? if($params['categories']): ?>
		<?= $params['categories']; ?>
		<hr />
		<? endif; ?>
		
		<?= $this->call('index/index/articleFilter'); ?>
		<? if($params['articles']): ?>
		<h3>Обьявления</h3>
		<div class="articles">
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
				<div class="created_at_article"><?= $a['created_at']; ?></div>
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