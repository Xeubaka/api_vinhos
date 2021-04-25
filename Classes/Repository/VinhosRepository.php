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

    public function insertVinho($dados)
    {
        $consultaInsert = 'INSERT INTO ' . self::TABELA . ' (name, type, weight) VALUES (:name, :type, :weight)';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($consultaInsert);
        $stmt->execute($dados);
        return  $stmt->rowCount();
    }

    public function updateVinho($id, $dados)
    {
        $dados['id'] = $id;
        $consultaUpdate = 'UPDATE ' . self::TABELA . ' SET '. self::validaSetCampos($dados) . ' WHERE id = :id ';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($consultaUpdate);
        $stmt->execute($dados);
        return $stmt->rowCount();
    }

    public function deleteVinho($id)
    {
        $consultaDelete = 'DELETE FROM ' . self::TABELA . ' WHERE id = '. $id;
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($consultaDelete);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getMySQL()
    {
        return $this->MySQL;
    }

    private static function validaSetCampos($dados){
        $query = '';
        foreach ($dados as $key => $value){
            $query = "$query $key = :$key ,";
        }
        return substr($query, 0, -1);
    }

}

?>