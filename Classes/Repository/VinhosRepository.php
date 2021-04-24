<?php

namespace Repository;

use DB\MySql;

class VinhosRepository
{
    private object $MySQL;
    const TABELA = 'vinhos';

    public function __construct()
    {
        $this->MySQL = new MySQL();
    }

    public function getRegistroByName($name){
        $consulta = 'SELECT * FROM ' . self::TABELA . ' WHERE name = :name';
        $stmt = $this->MySQL->getDb()->prepare($consulta);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function insertVinho($name, $type, $weight)
    {
        $consultaInsert = 'INSERT INTO ' . self::TABELA . ' (name, type, weight) VALUES (:name, :type, :weight)';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($consultaInsert);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':weight', $weight);
        $stmt->execute();
        return  $stmt->rowCount();
    }

    public function updateVinho($id, $dados)
    {
        $consultaUpdate = 'UPDATE ' . self::TABELA . ' SET name = :name, type = :type, weight = :weight WHERE id = :id ';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($consultaUpdate);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $dados['name']);
        $stmt->bindParam(':type', $dados['type']);
        $stmt->bindParam(':weight', $dados['weight']);
        $stmt->execute();
        return  $stmt->rowCount();
    }

    public function getMySQL()
    {
        return $this->MySQL;
    }
}

?>