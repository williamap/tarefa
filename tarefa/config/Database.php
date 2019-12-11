<?php
class Database{

	private $host = 'localhost';
	private $dbase = 'imagens';
	//credenciais para uso na instalação padrao do MySQL no XAMPP (Windows)
	private $user = 'root';
	private $pass = '';	

	public function conexao(){
		try {
		  $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbase, $this->user, $this->pass);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $conn->query("SET CHARACTER SET utf8");
		  return $conn;
		} catch(PDOException $e) {
		    throw new Exception("Erro de conexão".$e->getMessage());
		}
	}
}
