<?php 

class Usuario {

	//Atributos

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//METODOS
	//Carrega um usuario pelo id
	public function loadById($id) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
			":ID"=>$id
		));
		if (count($results) > 0) {

			$this->setData($results[0]);

		}
	}
	//Carrega lista de usuarios
	public static function getList() {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin"); 
	}
	//Procura usuario
	public static function search($login) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			':SEARCH'=>"%".$login."%"
		));
	}
	//Login com usuario e senha e retorna informaçoes
	public function login($login,$password) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
			':LOGIN'=>$login,
			':PASSWORD'=>$password
		));

		if (count($results) > 0) {

			$this->setData($results[0]);

		} else {
			throw new Exception("Login e/ou Senha invalidos!");
		}
	}
	//Insere dados nos atributos
	public function setData($data) {
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}
	//Insere dados
	public function insert() {
		$sql = new Sql();
		//procedure CALL
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($results) > 0) {

			$this->setData($results[0]);

		}
	}
	//Atualiza informaçoes
	public function update($login,$password) {
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}

	public function delete() {

		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID",array(
			':ID'=>$this->getIdusuario()
		));
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	//METODOS ESPECIAIS

	public function __construct($login = "", $password = "") {
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

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