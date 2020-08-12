<?php

namespace base{

require_once HELPER_PATH."database.php";

use helper\database;
use PDO;

Class model extends database{

	private $results;
	private $error = false;
	private $rowCount = 0;
	private $whereClause = "";
	private $sql = "";
	private $params = [];


	public function __construct(){
		parent::__construct();
	}

	private function initialize(){
		$this->sql = "";
		$this->params = [];
	}
	
	protected function ExecuteQuery($sql , $params = []){
		try{
			$this->error = false;
			$statement = $this->conn->prepare($sql);
			$statement->execute($params);
			$this->results = $statement->fetchAll();
			$this->rowCount = count($this->results) ? count($this->results) : 0;
		}catch (PDOException $e) {
			$this->error = true;
			throw new Exception($e->getMessage());
		}
		return $this;
	}

	protected function ExcecuteNonQuery(){
		try{
			$this->error = false;
			$statement = $this->conn->prepare($this->sql);
			$statement->execute($this->params);
		}catch (PDOException $e) {
			$this->error = true;
			throw new Exception($e->getMessage());
		}
		return $this;
	}
	

	protected function select($table,$fields = [] ,$params = []){
		$this->initialize();
		$fieldscount = count($fields) ? count($fields) : 0;
		$columns = implode(",", $fields);
		$sql = "SELECT {$columns} FROM {$table} ";
		$this->params = $params;
		$this->sql.= $sql;
		return $this;
	}

	protected function getSQL(){
		return $this->sql;
	}


	protected function delete($table,$params = []){
		$this->initialize();
		$this->sql.= " DELETE FROM {$table} ";
		$this->params = $params;
		return $this;	
	}

	protected function insert($table,$fields = [],$params = []){
		$this->initialize();
		$fieldscount = count($fields) ? count($fields) : 0;
		if($fieldscount > 0){
			$values = '';
			foreach($fields as $field){
				$values.= "?,";
			}
		}
		$values = substr($values, 0, -1);
		$columns = implode(",", $fields);
		$this->sql.= "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
		$this->params = $params;
		return $this;
	}

	protected function update($table,$fields = [],$params = []){
		$this->initialize();
		$fieldscount = count($fields) ? count($fields) : 0;
		if($fieldscount > 0){
			$values = '';
			foreach($fields as $field){
				$values.="{$field} = ?,";
			}
		}

		$values = substr($values, 0, -1);
		$columns = implode(",",$fields);
		$this->sql.= "UPDATE {$table} SET {$values}";
		$this->params = $params;
		return $this;
	}

	protected function rawQuery($sql,$params = []){
		$this->sql = $sql;
		$this->params = $params;
		$this->ExecuteQuery($sql,$params);
		return $this;
	}

	protected function rawNonQuery($sql,$params = []){
		$this->sql = $sql;
		$this->params = $params;
		$this->ExcecuteNonQuery();
		return $this;
	}


	protected function error(){
		return $this->error;
	}

	protected function execute(){
		if(!$this->ExcecuteNonQuery()->error()){
			return true;
		}
		return false;
	}

	protected function get(){
		$this->ExecuteQuery($this->sql,$this->params);
		return $this->results;
	}

	protected function first(){
		$this->ExecuteQuery($this->sql,$this->params);
		if($this->rowCount() > 0){
			$data = $this->results[0];
		}else{
			$data = null;
		}
		return $data;
	}

	protected function last(){
		$this->ExecuteQuery($this->sql,$this->params);
		if($this->rowCount() > 0){
			$data = $this->results[$this->rowCount()-1];
		}else{
			$data = null;
		}
		return $data;
	}

	protected function rowCount(){
		return $this->rowCount;
	}


	protected function where($whereClause){
		$this->sql.= " WHERE {$whereClause}";
		return $this;
	}


	protected function orderby($order,$sort = "ASC"){
		$this->sql.= " ORDER BY {$order} {$sort}";
		return $this;
	}


	protected function groupby($group){
		$this->sql.= " GROUP BY {$group}";
		return $this;
	}


	protected function leftJoin($jointable,$firstkey,$secondkey){
		$this->sql.= " LEFT JOIN {$jointable} ON {$firstkey} = {$secondkey} ";
		return $this;
	}
	
	protected function Join($jointable,$firstkey,$secondkey){
		$this->sql.= " JOIN {$jointable} ON {$firstkey} = {$secondkey} ";
		return $this;
	}

	protected function innerJoin($jointable,$firstkey,$secondkey){
		$this->sql.= " INNER JOIN {$jointable} ON {$firstkey} = {$secondkey}";
		return $this;
	}


}

}