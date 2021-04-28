<?php
/**
 * Classe Conexao, CRUD.
 * @author Adalberto Silveira 
 * @since 2021
 **/
class Conexao {

	protected static $conn;

	function __construct(){
		$drive = "mysql";
		$host = "127.0.0.1";
		$dbName = "crud_spa";
		$user = "root";
		$password = "qwerty";
		try{ 
			self::$conn = new PDO($drive . ':host=' . $host . ';dbname=' . $dbName, $user, $password);
			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$conn->exec("SET NAMES utf8");
		 }catch(PDOException $e){ 
          //print 'Erro na conexão MYSQL EAD '.$e->getMessage().'<br>'; 
		 	//die('Erro na conexão MYSQL EAD '.$e->getMessage());
		 	throw new Exception("Erro ao criar a conexão.", 1); 
        } 
	}

	public function conectar(){
		if (!self::$conn) {
			new Conexao();
		}

		return self::$conn;
	}
}


?>