<?php
namespace dvijok\modules\error;
class Error extends \dvijok\core\Core {

	public $user;
	public $data;
	public $path;
	public function __construct($path, $data) {
		
		parent::__construct($path, $data);
		$settings = $this->db->query("SELECT * FROM `settings`")->fetchAll();
		$s2 = array();
		foreach($settings as $s)
		{
			$s2[$s['name']] = $s['value'];
		}
		$this->settings = $s2;

		if(!$this->settings['site_enabled'] && $path['function'] != 'site_closed')
		{
			return $this->redirect('/site_closed'); 
			
		}
		$this->data = $data;
		$this->path = $path;
		$this->current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$this->relative_url = $_SERVER['REQUEST_URI'];
		\dvijok\core\Config::$current_url = $this->current_url;
		\dvijok\core\Config::$relative_url = $this->relative_url;
		if($this->session->has('user_id'))
		{
			$temp = array();
			$temp[] = $this->session->get('user_id');
			$this->user = $this->db->query("SELECT * FROM `users` WHERE `id` = ?", $temp)->fetch();
		}
		$temp = array();
		$temp[] = $this->user['id'];
		$temp[] = $this->user['id'];
		//$temp[] = $this->user['id'];
		$newMessagesCount = $this->db->query("SELECT * FROM `messages` WHERE (`is_system` = 1 AND `is_new_from` = 1 AND `from_id` = ?) OR (`is_new` = 1 AND `to_id` = ?) GROUP BY `conversation_id`", $temp);
	
		$newMessagesCount = $newMessagesCount->result->num_rows;
		$this->newMessagesCount = $newMessagesCount;
	}
	
	public function index() {
		
		$data = array();
		
		return $this->view(__FUNCTION__, $this->data);
	}
	
	public function header() {
		$data = array();
		$pages = $this->db->query("SELECT * FROM `pages` ORDER BY `created_at` DESC")->fetchAll();
		$this->data['pages'] = $pages;
		return $this->view(__FUNCTION__, $this->data);
		
	}
	
	public function footer() {
		
		$data = array();
		return $this->view(__FUNCTION__, $data);
	}
}