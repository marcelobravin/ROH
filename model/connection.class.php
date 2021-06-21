<?php
abstract class Connection {

	private static $instance;

	protected $user;
	protected $password;
	protected $host;
	protected $database;
	protected $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",);
	protected $connection = null; // ------------------------------------------- private fica melhor?

	public function __construct() {
		$env = parse_ini_file(ROOT.".env");

		$this->user		= $env["USER"];
		$this->password	= $env["PASSWORD"];
		$this->host		= $env["HOST"];
		$this->database	= $env["DBNAME"];
	}

	private function connect(){
		$this->connection = new PDO(
			"mysql:host=$this->host;dbname=$this->database;charset=utf8",
			$this->user,
			$this->password,
			$this->options
		);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE		, PDO::ERRMODE_EXCEPTION);
		$this->connection->setAttribute(PDO::ATTR_ORACLE_NULLS	, PDO::NULL_EMPTY_STRING);
		return $this->connection;
	}

	public function runQuery($sql){
		$stm = $this->connect()->prepare($sql);
		$stm->execute();
		return $stm;
	}

	public function runSelect($sql){
		$stm = $this->connect()->prepare($sql);
		$stm->execute();
		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}

	public function runRow($sql){
		$stm = $this->connect()->prepare($sql);
		$stm->execute();
		return $stm->rowCount();
	}

	public function runQueryFetch($sql){
		$stm = $this->connect()->prepare($sql);
		$stm->execute();
		return $stm->fetch(PDO::FETCH_ASSOC);
	}

	public function getConnection() {
		if ($this->connection == null)
			return $this->connect();

		return $this->connection;
	}
}
