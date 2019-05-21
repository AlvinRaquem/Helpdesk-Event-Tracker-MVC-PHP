<?php 

namespace helper{
use PDO;

Class Database {
	
	private $host;
	private $user;
	private $database;
	private $password;
	private $charset;
	protected $conn;

	public function __construct(){
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->password = DB_PASS;
		$this->database = DB_NAME;
		$this->charset = DB_CHARSET;
		
		$this->conn = new PDO("mysql:host={$this->host};dbname={$this->database};charset={$this->charset}",$this->user,$this->password);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
	}


	public function connectDB(){
		return $this->conn;
	}

	public function ChangeConnection(){

	}

	public function Disconnect(){
		$this->conn = NULL;
	}

}

}

?>