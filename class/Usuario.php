<?php 

class Usuario {

	//Atributos

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//METODOS

	public function loadById($id) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
			":ID"=>$id
		));
		if (count($results) > 0) {

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}

	//METODOS ESPECIAIS

	public function __toString() {
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

	public function getIdusuario() {
		return $this->idusuario;
	}

	public function setIdusuario($usuario) {
		$this->idusuario = $usuario;
	}

	public function getDeslogin() {
		return $this->deslogin;
	}

	public function setDeslogin($login) {
		$this->deslogin = $login;
	}

	public function getDessenha() {
		return $this->dessenha;
	}

	public function setDessenha($senha) {
		$this->dessenha = $senha;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function setDtcadastro($cadastro) {
		$this->dtcadastro = $cadastro;
	}
}
?>