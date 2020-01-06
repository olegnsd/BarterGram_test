# BarterGram
Fresh Distributed Financial System + Fresh Distributed Messenger

Этот движок будет использоватся как основа для barter gram

имеется:

1) модульность
2) роутинг
3) класс для базы данных
4) шаблонизация(partial layout)

роутинг задаётся в файле Config.php

доступ к модулям может быть осуществлён напрямую без указания роутинга, либо через алиас если указан роутинг к примеру:
```
		'register/:param' => array(
		
			'path' => 'index/index/register'
		
		),
		'login/:param' => array(
		
			'path' => 'index/index/login'
		
		),
```

классы контроллера создаются так:
```
namespace dvijok\modules\index;
class Index extends \dvijok\core\Core {

	public $user;
	public $data;
	public $path;
	public $settings;

	public function __construct($path, $data) {
  
        }
	
	
	public function index(){


        }
  
  }
  
  
```
в конструктор передаются данные о пути и прочие параметры вызова

в шаблоне можем делать вызов соответствующих модулей, тоесть внутренний роутинг вызова аналогичен прямому вызова модуля из браузера,
либо через алиас если указан в роутинге, также можно передавать параметры каждому вызову
```
<?= $this->call("index/index/header", array('title' => $params['title'])); ?>
<div class="content">
<?= $content; ?>
</div>
<?= $this->call("index/index/footer"); ?>
```
