<?php

class AlunoModel {

    private $db;
    private $entity;

    public function __construct(\PDO $db, EntidadeInterface $entity) {
        $this->db       = $db;
        $this->entity   = $entity;
    }

    public function find($id) {
        
        $query = "SELECT * FROM {$this->entity->getTable()} WHERE id=:id";
        $stmt  = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function listar($ordem = null) {
        
        if ($ordem) {
            $query = "SELECT * FROM {$this->entity->getTable()} order by {$ordem}";
        } else {
            $query = "SELECT * FROM {$this->entity->getTable()}";
        }

        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function inserir() {
        
        $query = "INSERT INTO {$this->entity->getTable()}(nome, nota) VALUES(:nome, :nota)";
           
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->entity->getNome());
        $stmt->bindValue(':nota', $this->entity->getNota());            

        if ($stmt->execute()) {
            return true;
        }
    }

    public function alterar() {

        $query = "UPDATE {$this->entity->getTable()} SET nome=:nome, nota=:nota WHERE id=:id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->entity->getId());
        $stmt->bindValue(':nome', $this->entity->getNome());
        $stmt->bindValue(':nota', $this->entity->getNota());
            
        if ($stmt->execute()) {
            return true;
        }
    }

    public function deletar($id) {
        
        $query = "DELETE FROM {$this->entity->getTable()} WHERE id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
            
        if ($stmt->execute()) {
            return true;
        }
    }

}
