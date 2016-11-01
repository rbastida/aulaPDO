<?php
require_once 'includes.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';


$usuario = new Usuario();
$usuario->setTable('usuarios');
$usuarioModel = new UsuarioModel($conexao, $usuario);

$nome       = 'ROGER';
$password   = 'admin';

$rs = $usuarioModel->findNomePassword($nome, $password);


if ($rs >= 0) {
    
    echo 'id='.$rs['id'].'<br>';
    echo 'nome='.$rs['nome'].'<br>';
    echo 'passw='.$rs['password'].'<br>';
    
}