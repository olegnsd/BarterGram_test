<?= $this->call("index/admin/header"); ?>
<div class="content">
<h2><a href="/index/admin/categories/add" class="btn btn-outline-success">Добавить меню</a></h2>
<?= $params['menus']; ?>
</div>
<?= $this->call("index/admin/footer"); ?>