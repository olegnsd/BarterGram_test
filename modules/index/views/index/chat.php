<h2>Chat</h2>
<? foreach($messages as $m): ?>
 <div><strong><?= $m["name"] ? $m["name"] : "неизвестный"; ?></strong>: <?= $m["message"]; ?>
</div>
 
<? endforeach; ?>
<form method="post" action="/index/index/addmessage">
    
    <textarea name="message"></textarea>
    <p><button>отправить</button></p>
    <input type="hidden" name="csrf" value="<?= $this->session->get("csrf"); ?>">
</form>