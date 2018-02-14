<?php 
require_once("config.php");

// $sql = new Sql();
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

//Carrega um usuario
// $root = new Usuario();
// $root->loadById(3);
// echo $root;

//Carrega lista de usuarios
// $lista = Usuario::getList();//metodo estatico
// echo json_encode($lista);

//Carrega lista de usuarios buscando pelo login
// $search = Usuario::search("j");//metodo estatico
// echo json_encode($search);

//Carrega dados do usuario se senha e login forem corretos
// $usuario = new Usuario();
// $usuario->login("Root","12345");
// echo $usuario;

//Criando novo usuario
// $aluno = new Usuario("aluno","@#aluno");
// $aluno->insert();
// echo $aluno;

//Atualizando usuarios
$usuario = new Usuario();
$usuario->loadById(3);
$usuario->update("professor","15243");
echo $usuario;
 ?>