<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
//require('core/vendor/autoload.php');
//use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\EntityManager;
// Create a simple "default" Doctrine ORM configuration for Annotations
//$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
//$conn = array(
//    'driver' => 'pdo_sqlite',
//    'path' => __DIR__ . '/db.sqlite',
//);

// obtaining the entity manager
//$entityManager = EntityManager::create($conn, $config);

session_start();
define('DS', '/');
$coreFolder = 'core';
require('Config.php');
require($coreFolder.DS.'purifier'.DS.'HTMLPurifier.auto.php');
require($coreFolder.DS.'Helper.php');
require($coreFolder.DS.'DB.php');
require($coreFolder.DS.'Core.php');
require($coreFolder.DS.'Input.php');
require($coreFolder.DS.'Validator.php');
require($coreFolder.DS.'Session.php');
require($coreFolder.DS.'Model.php');
$modulesFolder = 'modules';
$controllersFolder = 'controllers';
$modelsFolder = 'models';
$viewsFolder = 'views';
$ext = '.php';
$scriptName = $_SERVER['SCRIPT_NAME'];
$scriptUri = $_SERVER['REQUEST_URI'];

$requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
$baseUrl = dirname($scriptName).DS;
if($baseUrl == '//'){$baseUrl = DS;}
$scriptName2 = explode(DS, $scriptName);
$requestUri2 = explode(DS, $scriptUri);
$scriptName2 = array_filter($scriptName2, function($value) { return $value !== ''; });
$requestUri2 = array_filter($requestUri2, function($value) { return $value !== ''; });
$c = true;
foreach($requestUri2 as $s)
{
	foreach($scriptName2 as $s2)
	{
		if($s == $s2)
		{
			$scriptUri = \dvijok\core\Helper::strReplaceFirst($s2.'/', '', $scriptUri);
			$c = false;
			break;
		}
	}
}

$temp = explode('?', $scriptUri);
$scriptUri = trim($temp[0], '/');
if($scriptUri == '')
{
	$scriptUri = '/';
}
$baseSystem = $_SERVER['DOCUMENT_ROOT'].$baseUrl;
/*
spl_autoload_register(function ($class_name) {
	
	global $baseUrl;
	global $modulesFolder;
    include $baseUrl.DIRECTORY_SEPARATOR.$modulesFolder . '.php';
});
*/

$data = array();
$data['firstRun'] = true;

$result = \dvijok\core\Core::call($scriptUri, $data);
echo $result;