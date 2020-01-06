<?php

namespace dvijok\core;
class Model {
	
	public $___data = array(
	
		'db' => false,
		'table' => false,
		'plural' => 's',
		'columns' => array(),
		'tableName' => '',
		'rows' => array(),
		'objRows' => array(),
		'queryString' => '',
		'whereString' => '',
		'orderByString' => '',
		'queryParams' => array(),
		'data_key' => '___data',
		'insertFields' => '',
		'insertValues' => ''
		
	);
	public function __construct() {
		
		$this->___data['db'] = Config::$db;
		$c = get_class($this);
		$lc = explode('\\', $c);
		$lc = end($lc);
		
		$temp = explode('Model', $lc);
		$this->___data['table'] = strtolower($temp[0]);
		$this->___data['tableName'] = $this->___data['table'].$this->___data['plural'];
		$sql = 'SHOW COLUMNS FROM '.$this->___data['tableName'];
		$res = $this->___data['db']->query($sql)->fetchAll();
		
		
		foreach($res as $r){
			$this->{$r['Field']} = false;
			//$this->columns[] = $r;
		}
		
	}
	
	public function first() {
		
		$rows = $this->executeQuery();
		if(isset($rows[0]))
		{
			$row = (object)$rows[0];
			return $row;
		}
		return false;
		/*
		if(isset($this->objRows[0]))
		{
			return $this->objRows[0];
		}
		*/
		return false;
	}
	
	public function all() {
		
		return $this->objRows;
	}
	
	public function asArray() {
		
		return $this->rows;
	}
	
	public static function where($name, $sign, $value) {
		
		//$where = '';
		//$c = count($array);
		//$i = 0;
		/*
		foreach($array as $key => $value)
		{
			
			if($c - 1 == $i)
			{
				$where .= $key.' = ?';
			}
			else
			{
				$where .= $key.' = ? AND ';
			}
			$params[] = $value;
			$i++;
			
		}
		*/
		$c = get_called_class();
		$mobj = new $c();
		$where = $name.' '.$sign.' ?';
		$mobj->___data['whereString'] = 'WHERE '.$where;
		$mobj->___data['queryParams'][] = $value;
		return $mobj;
	}
	
	public static function getAll() {
		
		$c = get_called_class();
		$mobj = new $c();
		return $mobj->get();
	}
	
	public function orWhere($name, $sign, $value) {
		
		//$where = '';
		//$c = count($array);
		//$i = 0;
		//$params = array();
		/*
		foreach($array as $key => $value)
		{
			
			if($c - 1 == $i)
			{
				$where .= $key.' = ?';
			}
			else
			{
				$where .= $key.' = ? AND ';
			}
			$params[] = $value;
			$i++;
			
		}
		*/
		
		$this->___data['queryParams'][] = $value;
		$where = $name.' '.$sign.' ?';
		$this->___data['whereString'] .= ' OR '.$where;
		return $this;
	}
	
	public static function fillObj(&$obj, $data = array()) {
		
		foreach($data as $key => $value)
		{
			$obj->{$key} = $value;
		}
		return $obj;
	}
	
	public function get() {
		
		$c = get_called_class();
		$rows = $this->executeQuery();

		
		$objRows = array();
		
		foreach($rows as $r)
		{
			$obj = new $c();
			self::fillObj($obj, $r);
			$objRows[] = $obj;
		}
		
		$this->objRows = $objRows;
		$this->rows = $rows;
		return $this->objRows;
	}
	
	public function save() {
		
		
		$temp = get_object_vars($this);
		unset($temp[$this->___data['data_key']]);
		if($this->id)
		{
			
		}
		else
		{
			
			
			$c = count($temp);
			$i = 0;
			foreach($temp as $key => $value)
			{
				$i++;
				if($c == $i)
				{
					$this->___data['insertFields'] .= '`'.$key.'`';
					$this->___data['insertValues'] .= '?';
				}
				else
				{
					$this->___data['insertFields'] .= '`'.$key.'`, ';
					$this->___data['insertValues'] .= '?, ';
				}
				$this->___data['queryParams'][] = $value;
				
			}
			$this->executeQuery('insert');
		//	$sql = "INSERT INTO  `".$this->___data['tableName']."`";
		}
	}
	
	public function executeQuery($type = 'select') {
		
		$result = false;
		if($type == 'select')
		{
			$result = Config::$db->query("SELECT * FROM `".$this->___data['tableName']."` ".$this->___data['whereString']." ".$this->___data['orderByString'], $this->___data['queryParams'])->fetchAll();
		}
		if($type == 'insert')
		{
			$result = Config::$db->query("INSERT INTO `".$this->___data['tableName']."`(".$this->___data['insertFields'].") VALUES(".$this->___data['insertValues'].") ", $this->___data['queryParams']);
		}
		return $result;
	}
	/*
	public static function get($id) {
		
		$id = intval($id);
		$data = Config::$db->query("SELECT * FROM `".$this->tableName."` WHERE id = ".$id)->fetch();
		$c = get_called_class();
		$obj = new $c();
		if($data)
		{
			foreach($data as $key => $value)
			{
				$obj->{$key} = $value;
			}
		}
		return $obj;
	}
	
	public function find($id) {
		
		$id = intval($id);
		$rows = $this->db->query("SELECT * FROM `".$this->tableName."` WHERE id = ".$id)->fetch();
		if($rows)
		{
			foreach($rows as $key => $value)
			{
				$this->{$key} = $value;
			}
		}
		return $this;
	}
	
	public function findBy($array) {
		
		
		$where = '';
		$c = count($array);
		$i = 0;
		$params = array();
		foreach($array as $key => $value)
		{
			if($c == $i)
			{
				$where .= $key.' = ?';
			}
			else
			{
				$where .= $key.' = ? AND ';
			}
			$params[] = $value;
			$i++;
			
		}
		
		$rows = $this->db->query("SELECT * FROM `".$this->tableName."` WHERE ".$where, $params)->fetch();
		$this->rows = $rows;
		return $this;
	}
	*/
}