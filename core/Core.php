<?php

namespace dvijok\core;
class Core {
	
	public $path;
	public static $mainUri;
	public $models = array();
	public $db = false;
	public function __construct($path, $data = array()) {
		
		global $modulesFolder;
		global $controllersFolder;
		global $modelsFolder;
		global $viewsFolder;
		global $requestMethod;
		global $ext;
		global $baseUrl;
		global $baseSystem;
		$this->baseUrl = $baseUrl;
		$this->path = $path;
		$this->modulesFolder = $modulesFolder;
		$this->baseSystem = $baseSystem;
		$this->controllersFolder = $controllersFolder;
		$this->modelsFolder = $modelsFolder;
		$this->viewsFolder = $viewsFolder;
		$this->requestMethod = $requestMethod;
		$this->ext = $ext;
		if(Config::$useDb)
		{
			if(!Config::$db)
			{
				$this->db = new DB(Config::$dbHost, Config::$dbLogin, Config::$dbPassword, Config::$dbName);
				Config::$db = $this->db;
			}
			else
			{
				$this->db = Config::$db;
			}
			
			$modelSearchDir = $this->modulesFolder.DS.$this->path['module'].DS.$this->modelsFolder;
			if(is_dir($modelSearchDir))
			{
				$files = Helper::scanDir($this->modulesFolder.DS.$this->path['module'].DS.$this->modelsFolder);
				foreach($files as $f)
				{
					
					$temp = explode('Model', $f);
					
					$path = $this->modulesFolder.DS.$this->path['module'].DS.$this->modelsFolder.DS.$f;
					
					$c = '\\dvijok\\modules\\'.$this->path['module'].'\\'.$temp[0].'Model';
					
					if(!is_numeric($temp[0]) && !class_exists($c, false))
					{
						require($path);
						$n = strtolower($temp[0]);
						$temp = explode('.', $f);
						$this->models[$n] = new $c();
					}
					
					
				}
			}
		}
		$this->call = function() {
			
			return self::call($scriptUri);
			
			
		};
		$this->session = new Session();
		$this->input = new Input();
		$this->validator = new Validator($this->session, $this->db);
		
		
		
	}
	
	public function view($view, $params = array()) {
		
		ob_start();
		//extract($params, EXTR_OVERWRITE, "d_");
		if(file_exists($this->modulesFolder.DS.$this->path['module'].DS.$this->viewsFolder.DS.lcfirst($this->path['controller']).DS.$view.$this->ext))
		{
			require($this->modulesFolder.DS.$this->path['module'].DS.$this->viewsFolder.DS.lcfirst($this->path['controller']).DS.$view.$this->ext);
		}
		else
		{
			require($this->modulesFolder.DS.Config::$errorModule.DS.$this->viewsFolder.DS.lcfirst(Config::$errorController).DS.$view.$this->ext);
		}
		return ob_get_clean();
	}
	
	public function c($scriptUri) {
		
		return self::call($scriptUri);
		
	}
	
	
	public static function call($scriptUri, $data = false) {
		
					
		if($scriptUri)
		{
			$path = array();
			global $modulesFolder;
			global $controllersFolder;
			global $modelsFolder;
			global $viewsFolder;
			global $requestMethod;
			global $ext;
			global $baseUrl;
			global $baseSystem;
			$scriptUri = trim($scriptUri, '/');
			//print_r($scriptUri);
			$temp = Helper::checkPath($scriptUri);
			
			if($temp->redirect)
			{
				return Helper::redirect($baseUrl.$temp->url);
			}
			$scriptUri = trim($temp->scriptUri, '/');
			$segments = array_filter(explode('/', $scriptUri));
			if(!Core::$mainUri)
			{
				Core::$mainUri = $scriptUri;
			}
			$path['module'] = isset($segments[0]) ? $segments[0] : 'index';
			unset($segments[0]);
			$path['controller'] = ucfirst(isset($segments[1]) ? $segments[1] : 'index');
			unset($segments[1]);
			$path['function'] = isset($segments[2]) ? $segments[2] : 'index';
			if(is_numeric($path['function']))
			{
				$path['function'] = 'index';
			}
			else
			{
				unset($segments[2]);
			}
			$path['params'] = array_values($segments);
			$fullPath = $baseSystem.$modulesFolder.DS.$path['module'].DS.$controllersFolder.DS.$path['controller'].$ext;
			$scanDir = $baseSystem.$modulesFolder.DS.$path['module'].DS.$controllersFolder.DS;
			
			if(isset($data['firstRun']) && $data['firstRun'])
			{

					spl_autoload_register(function ($class_name) use ($path) {
						
						global $modulesFolder;
						global $controllersFolder;
						global $baseUrl;
						global $baseSystem;
						$temp = explode('\\', $class_name);
						$cl = end($temp);
						
						if(file_exists($baseSystem.$modulesFolder.DS.$path['module'].DS.$controllersFolder.DS.$cl.'.php'))
						{
							$res = require $baseSystem.$modulesFolder.DS.$path['module'].DS.$controllersFolder.DS.$cl.'.php';
						}
						else
						{
							$res = require $baseSystem.$modulesFolder.DS.Config::$errorModule.DS.$controllersFolder.DS.$cl.'.php';
						}
						if($res)
						{
							return true;
						}
						return false;
					});
					
					
					
				
				
			}
			/*
			$files = array_diff(scandir($scanDir), array('.', '..'));
			$files = array_values($files);
			print_r($files);
			foreach($files as $f) {
				
				
				$temp = explode('.', $f);
				$cl = '\\dvijok\\modules\\'.$path['module'].'\\'.$temp[0];
				$p = $scanDir.$f;
				
				if(!class_exists($cl))
				{
					require($p);
				}
				
				
			}
			*/
			if(file_exists($fullPath))
			{
					
					$cl = '\\dvijok\\modules\\'.$path['module'].'\\'.$path['controller'];
					$c = new $cl($path, $data);
					if(isset($data['firstRun']) && $data['firstRun'])
					{
						if($c->requestMethod == 'post')
						{
							//echo 1;
							//echo $this->session->get('csrf').'<br />';
							//echo $this->input->post('csrf', false);
							//echo $this->session->get('csrf');
							
							if($c->input->post('csrf', false) != $c->session->get('csrf'))
							{
								//echo 2;
								echo 'unauthorized request';
								exit;
							}
							$c->session->set('csrf', base64_encode(openssl_random_pseudo_bytes(32)));
						}
						//echo 3;
						
					}
					/*
					if(!class_exists($cl))
					{
						require($fullPath);
					}
					*/
					
					
					//$c->$path['function']($path['params']);
		
					
					if(method_exists($c, $path['function'].'_'.$requestMethod))
					{
						$result = call_user_func_array(array($c, $path['function'].'_'.$requestMethod), $path['params']);
					}
					else
					{
						if(method_exists($c, $path['function']))
						{
							$result = call_user_func_array(array($c, $path['function']), $path['params']);
						}
						else
						{
							return $c->redirect('/error404');
						}
					}
					
					return $result;
				
			}
			else
			{
				$cl = '\\dvijok\\modules\\'.Config::$errorModule.'\\'.Config::$errorController;
				$c = new $cl($path, $data);
				
				$result = call_user_func_array(array($c, $path['function']), $path['params']);
				return $result;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function redirectBack() {
		
		
		if(!isset($_SERVER['HTTP_REFERER']) || !$_SERVER['HTTP_REFERER'])
		{
			header('Location: '.$this->baseUrl);
		}
		else
		{
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
	}
	
	public function redirect($url = false) {
		
		Helper::redirect($url);
	}
	
	public function model($name) {
		
		if(isset($this->models[$name]))
		{
			return $this->models[$name];
		}
		return false;
		
	}
	
	public function __destruct() {
		
		
		
		
		
	}
	
	
}