<?php

try {
    $conexao = new \PDO("mysql:host=localhost;dbname=escola", "root", "ws56gb89");
} catch (PDOException $e) {

    echo "Nao foi possivel estabelecer a conexao com o banco de dados, Erro codigo:" . $e->getCode()
    . ":" . $e->getMessage();
}
