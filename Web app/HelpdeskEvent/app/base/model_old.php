<?php

namespace base{

use helper\database;

Class model extends database{

	public function __construct(){
		parent::__construct();
	}

	protected function ExecuteQuery($sql,$params = []){
		try{
			$statement = $this->conn->prepare($sql);
			$statement->execute($params);
			return $statement->fetchAll();
		}catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	protected function ExecuteNonQuery($sql,$params = []){
		try{
			$statement = $this->conn->prepare($sql);
			$statement->execute($params);
			return true;
		}catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}
}

}