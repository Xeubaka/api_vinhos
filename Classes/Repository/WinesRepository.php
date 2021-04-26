<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
namespace Repository;

use DB\MySql;

class WinesRepository
{
    private object $_MySQL;
    const TABLE = 'wines';

    public function __construct()
    {
        $this->_MySQL = new MySQL();
    }

    public function insertWine($data)
    {
        $queryInsert = 'INSERT INTO ' . self::TABLE . ' (name, type, weight) VALUES (:name, :type, :weight)';
        $this->_MySQL->getDb()->beginTransaction();
        $stmt = $this->_MySQL->getDb()->prepare($queryInsert);
        $stmt->execute($data);
        return  $stmt->rowCount();
    }

    public function updateWine($id, $data)
    {
        $data['id'] = $id;
        $queryUpdate = 'UPDATE ' . self::TABLE . ' SET '. self::_validateUpdateFields($data) . ' WHERE id = :id ';
        $this->_MySQL->getDb()->beginTransaction();
        $stmt = $this->_MySQL->getDb()->prepare($queryUpdate);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function deleteWine($id)
    {
        $queryDelete = 'DELETE FROM ' . self::TABLE . ' WHERE id = '. $id;
        $this->_MySQL->getDb()->beginTransaction();
        $stmt = $this->_MySQL->getDb()->prepare($queryDelete);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getMySQL()
    {
        return $this->_MySQL;
    }

    private static function _validateUpdateFields($data)
    {
        $query = '';
        foreach ($data as $key => $value) {
            $query = "$query $key = :$key ,";
        }
        return substr($query, 0, -1);
    }

}

?>
