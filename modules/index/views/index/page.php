<?= $this->call("index/index/header", array('title' => $params['page']['title'])); ?>
<h1><?= $params['page']['title']; ?></h1>
<div class="group-control">
	<?= $params['page']['description']; ?>
</div>
<?= $this->call("index/index/footer"); ?>