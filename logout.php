<?php
session_start();

require_once 'includes.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';


if ( isset($_SESSION['logado']) OR ($_SESSION['logado'] == true) ) {
    
    session_start();
    unset($_SESSION['nome']);
    unset($_SESSION['password']);

    $_SESSION['logado'] = FALSE;    
    
    // Unset all of the session variables.
    $_SESSION = array();

    // Finally, destroy the session.
    session_destroy();    
    
}
