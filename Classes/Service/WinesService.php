<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
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

    private array $_data;
    private array $_dataRequestBody;

    private object $_WinesRepository;

    public function __construct($data = [])
    {
        $this->_data = $data;
        $this->_WinesRepository = new WinesRepository();
    }

    public function validateGet()
    {
        $return = null;
        if (in_array($this->_data['resource'], self::RESOURCE_GET, true)) {
            $resource = '_' . $this->_data['resource'];
            $return = $this->_data['id'] > 0 ? $this->_getOneByKey() : $this->$resource();
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
        }

        if ($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERIC);
        }

        return $return;
    }

    public function validateDelete()
    {
        $return = null;
        if (in_array($this->_data['resource'], self::RESOURCE_DELETE, true) ) {
            $resource = '_' . $this->_data['resource'];
            if ($this->_data['id'] > 0 ) {
                $return = $this->$resource();
            } else {
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MUST_HAVE_ID);
            }
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERIC);
        }

        if ($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERIC);
        }

        return $return;
    }

    public function validatePost()
    {
        $return = null;
        if (in_array($this->_data['resource'], self::RESOURCE_POST, true)) {
            $resource = '_' . $this->_data['resource'];
            $return = $this->$resource();
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
        }

        if ($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERIC);
        }

        return $return;
    }

    public function validatePut()
    {
        $return = null;
        if (in_array($this->_data['resource'], self::RESOURCE_PUT, true)) {
            $resource = '_' . $this->_data['resource'];
            if ($this->_data['id'] > 0) {
                $return = $this->$resource();
            } else {
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MUST_HAVE_ID);
            }
        } else {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
        }

        if ($return === null) {
            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERIC);
        }

        return $return;
    }

    public function setDataRequestBody($dataRequestBody)
    {
        $this->_dataRequestBody = $dataRequestBody;
    }

    private function _list()
    {
        return $this->_WinesRepository->getMySQL()->getAll(self::TABLE);
    }

    private function _getOneByKey()
    {
        return $this->_WinesRepository->getMySQL()->getOneByKey(self::TABLE, $this->_data['id']);
    }

    private function _insert()
    {
        [$name, $type, $weight] = [$this->_dataRequestBody['name'], $this->_dataRequestBody['type'], $this->_dataRequestBody['weight']];

        if ($name && $type && $weight) {

            if ($this->_WinesRepository->insertWine($this->_dataRequestBody) > 0 ) {
                $idInserido = $this->_WinesRepository->getMySQL()->getDb()->lastInsertId();
                $this->_WinesRepository->getMySQL()->getDb()->commit();
                return ['id_inserido' => $idInserido];
            }

            $this->_WinesRepository->getMySQL()->getDb()->rollBack();

            throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_GENERIC);
        }
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_MISSING_INFORMATION);
    }

    private function _delete()
    {
        if ($this->_WinesRepository->deleteWine($this->_data['id']) > 0 ) {
            $this->_WinesRepository->getMySQL()->getDb()->commit();
            return ConstantGenericalUtil::MSG_DELETED_SUCCESSFULLY;
        }
        $this->_WinesRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_NONE_AFFAFFECTED);
    }

    private function _update()
    {
        if ($this->_WinesRepository->updateWine($this->_data['id'], $this->_dataRequestBody) > 0 ) {
            $this->_WinesRepository->getMySQL()->getDb()->commit();
            return ConstantGenericalUtil::MSG_UPDATED_SUCCESSFULLY;
        }
        $this->_WinesRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_NONE_AFFAFFECTED);
    }
}

?>
