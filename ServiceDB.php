<?php

class ServiceDB {

    private $db;
    private $entity;

    public function __construct(\PDO $db, EntidadeInterface $entity) {

        $this->db = $db;
        $this->entity = $entity;
    }

    public function find($id) {

        $query = "SELECT * FROM {$this->entity->getTable()} WHERE id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function listar($ordem = NULL) {

        if ($ordem) {
            $query = "SELECT * FROM {$this->entity->getTable()} ORDER BY {$ordem}";
        } else {
            $query = "SELECT * FROM {$this->entity->getTable()}";
        }

        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function inserir() {
        
        $tabela = $this->entity->getTable();
        
        if ($tabela == 'alunos') {

            $query = "Insert into {$tabela} (nome,nota) Values(:nome, :nota)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->entity->getNome());
            $stmt->bindValue(':nota', $this->entity->getNota());
            
        }
        
        if ($tabela == 'usuarios') {
            
            $query = "INSERT INTO {$tabela} (nome, password) Values(:nome, :password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->entity->getNome());
            $stmt->bindValue(':password', $this->entity->getPassword());
            
        }

        if ($stmt->execute()) {
            return true;
        }
        
    }

    public function alterar() {
        
        $tabela = $this->entity->getTable();
        
        if ($tabela == 'alunos') {

            $query = "UPDATE {$this->entity->getTable()} SET nome = :nome, nota = :nota WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->entity->getId());
            $stmt->bindValue(':nome', $this->entity->getNome());
            $stmt->bindValue(':nota', $this->entity->getPassword());
            
        }
        
        if ($tabela == 'usuarios') {
            
            $query = "UPDATE {$this->entity->getTable()} SET nome = :nome, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->entity->getId());
            $stmt->bindValue(':nome', $this->entity->getNome());
            $stmt->bindValue(':password', $this->entity->getPassword());
            
        }        

        if ($stmt->execute()) {
            return true;
        }
    }

    public function deletar($id) {

        $query = "DELETE FROM {$this->entity->getTable()} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
    }

}
