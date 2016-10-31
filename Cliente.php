<?php

class Cliente implements EntidadeInterface {

    private $table = "clientes";
    private $id;
    private $nome;
    private $email;
    
    function getTable() {
        return $this->table;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    function setTable($table) {
        $this->table = $table;
        return $this;
    }    

}
