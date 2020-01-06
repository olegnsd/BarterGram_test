<!DOCTYPE html>
<html>
    <head>
		<title><?= $params['title']; ?> | <?= $this->settings['title']; ?></title>
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/css/bootstrap-glyphicons.css" />
        <link rel="stylesheet" href="/assets/css/site.css" />
        <link rel="stylesheet" href="/assets/css/jquery.bxslider.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/assets/js/jquery-3.3.1.min.js"></script>
		<script src="/assets/js/jquery-ui.js"></script>
		<script src="/assets/js/jquery.bxslider.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<script>
		$(function() {
				
		  $('.list-group-item').on('click', function(e) {
			  e.stopPropagation();
			$('.glyphicon', this).first()
			  .toggleClass('glyphicon-chevron-down')
			  .toggleClass('glyphicon-chevron-right');
			  var ul = $('ul', this).first();
			  if(ul.children().length > 0)
			  {
				  ul.slideToggle();
			  }
		  });
		  
		  $('.list-group-item a').click(function(e){
			  
			  e.stopPropagation();
			  
			  
		  });
		  $(document).on('click', 'a.auth', function(e){
			  
			  e.preventDefault();
			  $('.dark, .win_auth').show();
			  
			  
		  });
		  
		  $('.win').click(function(e){
			  
			  //alert(1);
			  e.stopPropagation();
			  
		  });
		  $('.dark, .dark .close').click(function(e){
			  
			  e.stopPropagation();
			  if($(e.target).attr('class') == 'dark' || $(e.target).attr('class') == 'close')
			  {
				$('.dark').hide();
			  }
			  //alert(2);
			  
		  });
		  
		  $('.btn-danger').click(function(e) {
				
				if (window.confirm("Вы уверены?")) {
					//location.href = this.href;
				}
				else
				{
					e.preventDefault();
				}
			});
		  
			$('.slider').bxSlider({
				
				hideControlOnEnd: false,
				auto: true,
				mode: 'fade'
			});
		});
		</script>
    </head>
    <body>
	<div class="layout">
	
        <div class="header">
			<nav class="navbar navbar-expand-lg navbar-light bg-white">
			  <a class="navbar-brand" href="/"><?= $this->settings['title']; ?></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
				<!--
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/' ? 'active' : ''; ?>">
					<a class="nav-link" href="/">
					Главная
					
					</a>
				  </li>
				-->
				  <? if($this->user): ?>

				<!--
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/user' ? 'active' : ''; ?>">
					<a class="nav-link" href="/user/<?= $this->user['login']; ?>">Профиль</a>
				  </li>
				-->
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/messages' ? 'active' : ''; ?>">
				  
						<a class="nav-link <?= \dvijok\core\Config::$relative_url == '/additem' ? 'active' : ''; ?>" href="/additem">Добавить обьявление</a>
				  </li>
					<!--
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/messages' ? 'active' : ''; ?>">
				  
					<? if($this->newMessagesCount): ?>
					<div class="is_new_messages">
						<?= $this->newMessagesCount; ?>
					</div>
					<? endif; ?>
					<a class="nav-link" href="/messages">Сообщения</a>
				  </li>
-->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<strong>Просмотр</strong>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/messages' ? 'active' : ''; ?>" href="/messages">Переписки</a>
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/myoffers' ? 'active' : ''; ?>" href="/myoffers">Мои заявки</a>
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/myarticles' ? 'active' : ''; ?>" href="/myarticles">Мои обьявления</a>
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/myprojects' ? 'active' : ''; ?>" href="/myprojects">Мои проекты</a>
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/users' ? 'active' : ''; ?>" href="/users">Пользователи</a>

					</div>
				</li>
				  <!--
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/oferta' ? 'active' : ''; ?>">
					<a class="nav-link" href="/oferta">Оферта</a>
				  </li>
				  -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<strong><?= $this->user['login']; ?></strong>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/user/'.$this->user['login'] ? 'active' : ''; ?>" href="/user/<?= $this->user['login']; ?>">Профиль</a>
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/settings' ? 'active' : ''; ?>" href="/settings">Настройки</a>
						<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/history' ? 'active' : ''; ?>" href="/history">История платежей</a>
						<!--
						<a class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/myoffers' ? 'active' : ''; ?>" href="/myoffers">Мои заявки</a>
-->
						<? if($this->user['type'] == 2): ?>
						<a class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/admin' ? 'active' : ''; ?>" href="/admin">Панель управления</a>
						<? endif; ?>
						<!--
					  <div class="dropdown-divider"></div>
-->
					</div>
				</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<strong>Статьи</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<? foreach($params['pages'] as $p): ?>
							<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/page/'.$p['id'] ? 'active' : ''; ?>" href="/page/<?= $p['id']; ?>">
							<?= $p['title']; ?>
							</a>
						<? endforeach; ?>
						</div>
					</li>

				  <li class="nav-item">
					  <a class="dropdown-item" href="/logout">Выход</a>
					</li>
				  <? else: ?>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/messages' ? 'active' : ''; ?>">
				  
						<a class="nav-link <?= \dvijok\core\Config::$relative_url == '/additem' ? 'active' : ''; ?>" href="/additem">Добавить обьявление</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/register' ? 'active' : ''; ?>">
					<a class="nav-link" href="/register">Регистрация</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/login' ? 'active' : ''; ?>">
					<a class="nav-link" href="/login">Вход</a>
				  </li>
				  
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<strong>Статьи</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<? foreach($params['pages'] as $p): ?>
							<a  class="dropdown-item <?= \dvijok\core\Config::$relative_url == '/page/'.$p['id'] ? 'active' : ''; ?>" href="/page/<?= $p['id']; ?>">
							<?= $p['title']; ?>
							</a>
						<? endforeach; ?>
						</div>
					</li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/users' ? 'active' : ''; ?>">
					<a class="nav-link" href="/users">Пользователи</a>
				  </li>
				  <? endif; ?>
				</ul>
				<span class="navbar-text">
				 <i>"клик клик" @неизвестный</i>
				</span>
			  </div>
			</nav>
			<!--
			<h1>stol-zakazov.online</h1>
			<div class="user_data">
			<? if($this->user): ?>
				
				Вы вошли как: <strong><?= $this->user['login']; ?></strong>
				<div>
					<a href="/">главная</a>
				</div>
				<div>
					<a href="/user/settings">настройки</a>
				</div>
				<div>
				<a href="/logout">выход</a>
				</div>
			<? else: ?>
				<? if(!isset($params['hide_buttons'])): ?>
				Вы не вошли в систему
				<div class="auth_buttons">
					<a href="/register" class="btn btn-lg btn-success text-white">Регистрация</a>
					<a href="/login" class="btn btn-lg btn-success text-white">Вход</a>
				</div>
				<? endif; ?>
			<? endif; ?>
			</div>
			-->
        </div>
		<? if(($this->settings['slider_on_main'] == 1 && $this->relative_url == '/') || $this->settings['slider_on_main'] == 0): ?>
		<div class="slider">
			<? foreach($params['slider'] as $s): ?>
				<? if($s['url']): ?>
				
				<div><a href="<?= $s['url']; ?>" <?= $s['new'] ? 'target="_blank"' : ''; ?>><img src="<?= preg_match("%https?://%ix", $s['img']) ? $s['img'] : '/assets/uploads/slider/'.$s['id'].'/'.$s['img']; ?>" /></a></div>
				<? else: ?>
				<div><img src="<?= preg_match("%https?://%ix", $s['img']) ? $s['img'] : '/assets/uploads/slider/'.$s['id'].'/'.$s['img']; ?>" /></div>
				<? endif; ?>
			<? endforeach; ?>
		</div>
		<? endif; ?>
    <div class="content">
        
    