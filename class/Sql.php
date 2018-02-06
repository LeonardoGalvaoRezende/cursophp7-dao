<?php 
 /**
  * summary
  */
 class Sql extends PDO
 {
     
    //ATRIBUTOS

 	private $conn;

 	//METODOS

 	//Insere varios valores
 	private function setParams($statement,$parameters = array()) {

 		foreach ($parameters as $key => $value) {
 			$this->setParam($statement,$key,$value);
 		}
 	}
 	//Insere um valor
 	private function setParam($statement,$key,$value) {
 		$statement->bindParam($key,$value);
 	}
 	//Prepara e executa query
 	public function query($rawQuery,$params = array()) {

 		$stmt = $this->conn->prepare($rawQuery);
 		$this->setParams($stmt,$params);
 		$stmt->execute();
 		return $stmt;
 	}
 	//Select
 	public function select($rawQuery,$params = array()):array
 	 {
 		$stmt = $this->query($rawQuery,$params);
 		return $stmt->fetchAll(PDO::FETCH_ASSOC);
 	}

 	//METODOS ESPECIAIS

 	//Construtor
     public function __construct()
     {
         $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","#3v3r357");
     }
 }

 ?>