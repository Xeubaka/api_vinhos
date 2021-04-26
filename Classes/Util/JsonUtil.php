<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
namespace Util;

use InvalidArgumentException;
use JsonException;

class JsonUtil
{
    public function processArrayToReturn($return)
    {
        $data = [];
        $data[ConstantGenericalUtil::TYPE] = ConstantGenericalUtil::TYPE_ERROR;

        if ((is_array($return) && count($return)>0) || strlen($return)>10 ) {
            $data[ConstantGenericalUtil::TYPE] = ConstantGenericalUtil::TYPE_SUCCESS;
            $data[ConstantGenericalUtil::ANSWER] = $return;
        }

        $this->_retornarJson($data);
    }

    private function _retornarJson($json)
    {
        header('Content-type: application/json');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
        echo json_encode($json, JSON_THROW_ON_ERROR, 1024);
        exit;
    }

    public static function prepareRequestBodyJson()
    {
        try{
            $postJson = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new  InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_EMPTY_JSON);
        }

        if (is_array($postJson) && count($postJson)>0 ) {
            return $postJson;
        }
    }
}

?>
