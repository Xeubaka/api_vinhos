<?php

namespace DB;

use InvalidArgumentException;
use PDO;
use PDOException;
use Util\ConstantGenericalUtil;

Class MySql
{
    private object $db;

    public function __construct()
    {
        $this->db = $this->setDB();
    }

    public function setDB()
    {
        try{
            return new PDO (
                'mysql:host=' . HOST . '; dbname='. DATA_BASE . ';', USER, PASSWORD
            );
        } catch (PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }

    public function getAll($table)
    {
        if($table){
            $query = 'SELECT * FROM '. $table;
            $stmt = $this->db->query($query);
            $results = $stmt->fetchAll($this->db::FETCH_ASSOC);
            if (is_array($results) && count($results) > 0){
                return $results;
            }
        }

        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RETURN_NONE);
    }

    public function getOneByKey($table, $id)
    {
        if ($table && $id){
            $query = 'SELECT * FROM ' . $table . ' WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultsCount = $stmt->rowCount();
            if ($resultsCount === 1){
                return $stmt->fetch($this->db::FETCH_ASSOC);
            }
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RETURN_NONE);
        }

        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MUST_HAVE_ID);
    }

    public function getDb()
    {
        return $this->db;
    }
}

?>
