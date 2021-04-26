<?php

namespace Repository;

use DB\MySql;

class WinesRepository
{
    private object $MySQL;
    const TABLE = 'wines';

    public function __construct()
    {
        $this->MySQL = new MySQL();
    }

    public function insertWine($data)
    {
        $queryInsert = 'INSERT INTO ' . self::TABLE . ' (name, type, weight) VALUES (:name, :type, :weight)';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($queryInsert);
        $stmt->execute($data);
        return  $stmt->rowCount();
    }

    public function updateWine($id, $data)
    {
        $data['id'] = $id;
        $queryUpdate = 'UPDATE ' . self::TABLE . ' SET '. self::validateUpdateFields($data) . ' WHERE id = :id ';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($queryUpdate);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function deleteWine($id)
    {
        $queryDelete = 'DELETE FROM ' . self::TABLE . ' WHERE id = '. $id;
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($queryDelete);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getMySQL()
    {
        return $this->MySQL;
    }

    private static function validateUpdateFields($data){
        $query = '';
        foreach ($data as $key => $value){
            $query = "$query $key = :$key ,";
        }
        return substr($query, 0, -1);
    }

}

?>
