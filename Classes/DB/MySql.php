<?php

namespace DB;

use InvalidArgumentException;
use PDO;
use PDOException;
use Util\ConstantesGenericasUtil;

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
                'mysql:host=' . HOST . '; dbname='. BANCO . ';', USUARIO, SENHA
            );
        } catch (PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }

    public function getAll($tabela)
    {
        if($tabela){
            $consulta = 'SELECT * FROM '. $tabela;
            $stmt = $this->db->query($consulta);
            $registros = $stmt->fetchAll($this->db::FETCH_ASSOC);
            if (is_array($registros) && count($registros) > 0){
                return $registros;
            }
        }

        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
    }

    public function getOneByKey($tabela, $id)
    {
        if ($tabela && $id){
            $consulta = 'SELECT * FROM ' . $tabela . ' WHERE id = :id';
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $totalRegistros = $stmt->rowCount();
            if ($totalRegistros === 1){
                return $stmt->fetch($this->db::FETCH_ASSOC);
            }
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
        }

        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_ID_OBRIGATORIO);
    }

    public function getDb()
    {
        return $this->db;
    }
}

?>