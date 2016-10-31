<?php

class Aluno implements EntidadeInterface {

    private $table = "alunos";
    private $id;
    private $nome;
    private $nota;

    function getTable() {
        return $this->table;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getNota() {
        return $this->nota;
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

    function setNota($nota) {
        $this->nota = $nota;
        return $this;
    }

}
