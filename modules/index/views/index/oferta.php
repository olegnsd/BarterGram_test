<?= $this->call("index/index/header", array('title' => $params['oferta']['title'])); ?>
<h1><?= $params['oferta']['title']; ?></h1>
<div class="group-control">
	<?= $params['oferta']['description']; ?>
</div>
<?= $this->call("index/index/footer"); ?>