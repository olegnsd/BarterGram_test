<?= $this->call("index/index/header", array('title' => $params['rules']['title'])); ?>
<h1><?= $params['rules']['title']; ?></h1>
<div class="group-control">
	<?= $params['rules']['description']; ?>
</div>
<?= $this->call("index/index/footer"); ?>