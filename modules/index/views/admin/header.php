<!DOCTYPE html>
<html>
<head>
<title><?= $this->settings['title']; ?> | Панель управления</title>
<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
<link  rel="stylesheet" href=="/assets/css/bootstrap.min.css" />
<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>

tinymce.init({
	selector:'textarea',
	height: 400,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste code"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	//automatic_uploads: true,
	//images_upload_url: 'index/admin/upload_content/',
	//images_reuse_filename: true,
	images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/index/admin/upload_content');
			
            var token = document.getElementById('csrf').value;
           // xhr.setRequestHeader("X-CSRF-Token", token);
		    formData = new FormData();
			console.log(token);
			formData.append('csrf', token);
			
			
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
				document.getElementById('csrf').value = json.csrf;
				console.log(json);
				token = json.csrf;
				
			
                success(json.location);
            };
            
            formData.append('file', blobInfo.blob(), blobInfo.filename());
			
            xhr.send(formData);
        }
		
		
	});
	
	$(function(){
		
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
				  $('.btn-danger, .btn-outline-danger').click(function(e) {
				
				if (window.confirm("Вы уверены?")) {
					//location.href = this.href;
				}
				else
				{
					e.preventDefault();
				}
			});
		
	});
	</script>
<style>
.error {
	
	color: red;
	
}
.message {
	
	color: green;
	
}
.edit {
	
	color: orange;
}
body {
	
	background: white;
	color: black;

}

.layout {
	
	width: 80%;
	margin: auto;
}
hr {
	
	background: white;
}
.menu-item {
	
	margin-top: 10px;
	margin-bottom: 10px;
	
}
</style>
<link href="/assets/css/admin.css" rel="stylesheet" />
</head>
<body>
<div class="layout">
		<div class="header">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="/admin">Панель управления</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
				  <li class="nav-item">
					<strong class="nav-link"><?= $this->user['login']; ?></strong>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/categories' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/categories">Категории</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/articles' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/articles">Обьявления</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/slider' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/slider">Слайдер</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/users' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/users">Пользователи</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/settings' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/settings">Настройки</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/oferta' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/oferta">Оферта</a>
				  </li>
				  <li class="nav-item <?= \dvijok\core\Config::$relative_url == '/admin/rules' ? 'active' : ''; ?>">
					<a class="nav-link" href="/admin/rules">Правила</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="/admin/logout">Выход</a>
				  </li>
				</ul>
				<span class="navbar-text">
				 <i>"да этож Админка" @неизвестный</i>
				</span>
			  </div>
			</nav>
		</div>
<hr />
