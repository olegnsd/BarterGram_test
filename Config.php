<?php

namespace dvijok\core;
class Config {
	
	public static $useDb = false;
	public static $dbHost = 'srv-pleskdb30.ps.kz';
	public static $dbLogin = 'artla_stolz';
	public static $dbPassword = '4j0Cj0*i';
	public static $dbName = 'artlabte_stolzakazov';
	public static $errorModule = 'error';
	public static $errorController = 'Error';
	public static $current_url = '';
	public static $relative_url = '';
	public static $payment_types = array('', 'Наличными', 'Через систему оплаты qiwi', 'Через систему оплаты yandex money', 'Через систему оплаты webmoney', 'Перечислить на счет stol-zakazov.online');
	public static $currencies = array('', 'сом', '$', '€', 'рубль');
	public static $action = array('reservation' => 'Резервация', 'back_pay' => 'Возврат денег', 'payment' => 'Выплата');
	public static $remaps = array(
		
		'/arbitrary_project/:param' => array(
		
			'path' => 'index/index/arbitrary_project'
		
		),
	
		'c/:param' => array(
		
			'path' => 'index/index/content'
		
		),
		'register_select/:param' => array(
		
			'path' => 'index/index/register_select'
		
		),
		'register/:param' => array(
		
			'path' => 'index/index/register'
		
		),
		'login/:param' => array(
		
			'path' => 'index/index/login'
		
		),
		'oferta/:param' => array(
		
			'path' => 'index/index/oferta'
		
		),
		'rules/:param' => array(
		
			'path' => 'index/index/rules'
		
		),
		'admin/oferta/:param' => array(
		
			'path' => 'index/admin/oferta'
		
		),
		'admin/rules/:param' => array(
		
			'path' => 'index/admin/rules'
		
		),
		'admin/categories/:param' => array(
		
			'path' => 'index/admin/categories'
		
		),
		'admin/articles/:param' => array(
		
			'path' => 'index/admin/articles'
		
		),
		'admin/:param' => array(
		
			'path' => 'index/admin'
		
		),
		'admin/login/:param' => array(
		
			'path' => 'index/admin/login'
		
		),
		'addoffer/:param' => array(
		
			'path' => 'index/index/addoffer'
		
		),
		'register_success/:param' => array(
		
			'path' => 'index/index/register_success'
		
		),
		'category/:param' => array(
		
			'path' => 'index/index/category'
		
		),
		'article/:param' => array(
		
			'path' => 'index/index/article'
		
		),
		'leftbar/:param' => array(
		
			'path' => 'index/index/leftBar'
		
		),
		'user/:param' => array(
		
			'path' => 'index/index/user'
		
		),
		'settings/:param' => array(
		
			'path' => 'index/index/usersettings'
		
		),
		'sendmessage/:param' => array(
		
			'path' => 'index/index/sendmessage'
		
		),
		'messages/:param' => array(
		
			'path' => 'index/index/messages'
		
		),
		'acceptoffer/:param' => array(
		
			'path' => 'index/index/acceptoffer'
		
		),
		'rejectoffer/:param' => array(
		
			'path' => 'index/index/rejectoffer'
		
		),
		'edititem/:param' => array(
		
			'path' => 'index/index/edititem'
		
		),
		'additem/:param' => array(
		
			'path' => 'index/index/additem'
		
		),
		'deleteitem/:param' => array(
		
			'path' => 'index/index/deleteitem'
		
		),
		'n/:param' => array(
		
			'path' => 'index/index/content_news'
		
		),
		'some_test_page' => array(
		
			'path' => 'test/index/test',
			'lock' => true
		),
		'admin/logout' => array(
		
			'path' => 'admin/login/logout',
			'lock' => true
		
		),
		'logout' => array(
		
			'path' => 'index/index/logout'
		
		),
		'uploadavatar' => array(
		
			'path' => 'index/index/uploadavatar'
		
		),
		'/admin/users' => array(
		
			'path' => 'index/admin/users'
		
		),
		'/site_closed' => array(
		
			'path' => 'index/index/site_closed'
		
		),
		'/agreeoffer' => array(
		
			'path' => 'index/index/agreeoffer'
		
		),
		'/reservetation_cash/:param' => array(
		
			'path' => 'index/index/reservetation'
		
		),
		'/history/:param' => array(
		
			'path' => 'index/index/history'
		
		),
		'finish_project/:param' => array(
		
			'path' => 'index/index/finish_project'
		
		),
		'/page/:param' => array(
		
			'path' => 'index/index/page'
		
		),
		'/users/:param' => array(
		
			'path' => 'index/index/users'
		
		),
		'/conversations/:param' => array(
		
			'path' => 'index/admin/conversations'
		
		),
		'/admin/slider/:param' => array(
		
			'path' => 'index/admin/slider'
		
		),
		'/admin/arbitrary/:param' => array(
		
			'path' => 'index/admin/arbitrary'
		
		),
		'/rejectselfoffer/:param' => array(
		
			'path' => 'index/index/rejectselfoffer'
		
		),
		'/myoffers/:param' => array(
		
			'path' => 'index/index/myoffers'
		
		),
		'/myarticles/:param' => array(
		
			'path' => 'index/index/myarticles'
		
		),
		'/myprojects/:param' => array(
		
			'path' => 'index/index/myprojects'
		
		),
		'/reject_project/:param' => array(
		
			'path' => 'index/index/reject_project'
		
		)
		
		
	
	
	
	);
	public static $db = false;
	
	
	
	
}