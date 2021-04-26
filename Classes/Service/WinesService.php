<?php

namespace Service;

use InvalidArgumentException;
use Repository\WinesRepository;
use Util\ConstantGenericalUtil;

class WinesService
{

    public const TABLE = 'wines';
    public const RESOURCE_GET = ['list'];
    public const RESOURCE_POST = ['insert'];
    public const RESOURCE_DELETE = ['delete'];
    public const RESOURCE_PUT = ['update'];

    private array $data;
    private array $dataRequestBody;

    private object $WinesRepository;

    public function __construct($data = [])
    {
        $this->data = $data;
        $this->WinesRepository = new WinesRepository();
    }

    public function validateGet()
    {
        $return = null;
        $resource = $this->data['resource'];
        if(in_array($resource, self::RESOURCE_GET, true)) {
            $return = $this->data['id'] > 0 ? $this->getOneByKey() : $this->$resource();
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
        }

        if ($return === null){
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERICO);
        }

        return $return;
    }

    public function validateDelete()
    {
        $return = null;
        $resource = $this->data['resource'];
        if(in_array($resource, self::RESOURCE_DELETE, true)){
            if($this->data['id']>0){
                $return = $this->$resource();
            }else{
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MUST_HAVE_ID);
            }
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERICO);
        }

        if($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERICO);
        }

        return $return;
    }

    public function validatePost()
    {
        $return = null;
        $resource = $this->data['resource'];
        if (in_array($resource, self::RESOURCE_POST, true)) {
            $return = $this->$resource();
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
        }

        if ($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERICO);
        }

        return $return;
    }

    public function validatePut()
    {
        $return = null;
        $resource = $this->data['resource'];
        if (in_array($resource, self::RESOURCE_PUT, true)) {
            if ($this->data['id'] > 0) {
                $return = $this->$resource();
            } else {
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MUST_HAVE_ID);
            }
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
        }

        if ($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERICO);
        }

        return $return;
    }

    public function setDataRequestBody($dataRequestBody)
    {
        $this->dataRequestBody = $dataRequestBody;
    }

    private function list()
    {
        return $this->WinesRepository->getMySQL()->getAll(self::TABLE);
    }

    private function getOneByKey()
    {
        return $this->WinesRepository->getMySQL()->getOneByKey(self::TABLE, $this->data['id']);
    }

    private function insert()
    {
        [$name, $type, $weight] = [$this->dataRequestBody['name'], $this->dataRequestBody['type'], $this->dataRequestBody['weight']];

        if($name && $type && $weight){

            if ($this->WinesRepository->insertWine($this->dataRequestBody) > 0){
                $idInserido = $this->WinesRepository->getMySQL()->getDb()->lastInsertId();
                $this->WinesRepository->getMySQL()->getDb()->commit();
                return ['id_inserido' => $idInserido];
            }

            $this->WinesRepository->getMySQL()->getDb()->rollBack();

            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERICO);
        }
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MISSING_INFORMATION);
    }

    private function delete()
    {
        if ($this->WinesRepository->deleteWine($this->data['id']) > 0){
            $this->WinesRepository->getMySQL()->getDb()->commit();
            return ConstantGenericalUtil::MSG_DELETED_SUCCESSFULLY;
        }
        $this->WinesRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_NONE_AFFAFFECTED);
    }

    private function update()
    {
        if ($this->WinesRepository->updateWine($this->data['id'], $this->dataRequestBody) > 0){
            $this->WinesRepository->getMySQL()->getDb()->commit();
            return ConstantGenericalUtil::MSG_UPDATED_SUCCESSFULLY;
        }
        $this->WinesRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_NONE_AFFAFFECTED);
    }
}

?>
