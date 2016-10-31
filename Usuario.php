<?php

class Usuario implements EntidadeInterface {

    private $table = "usuarios";
    private $id;
    private $nome;
    private $email;
     
    public function __construct() {
        
    }
    function getTable() {
        return $this->table;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function setTable($table) {
        $this->table = $table;
        return $this;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }



}