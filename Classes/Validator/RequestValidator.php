<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
namespace Validator;

use InvalidArgumentException;
use Service\WinesService;
use Util\ConstantGenericalUtil;
use Util\JsonUtil;

Class RequestValidator
{
    private array $_request;
    private array $_requestData;

    const GET = 'GET';
    const DELETE = 'DELETE';
    const WINES = 'WINES';

    public function __construct($request = [])
    {
        $this->_request = $request;
    }

    public function processRequest()
    {
        $return = utf8_encode(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);

        if (in_array($this->_request['method'], ConstantGenericalUtil::TYPE_REQUEST, true)) {
            $return = $this->_rerouteRequest();
        }
        return $return;
    }

    private function _rerouteRequest()
    {
        if ($this->_request['method'] !== self::GET && $this->_request['method'] !== self::DELETE) {
            $this->requestData = JsonUtil::prepareRequestBodyJson();
        }
        $method = '_' . $this->_request['method'];
        return $this->$method();
    }

    private function _delete()
    {
        $return = utf8_encode(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
        if (in_array($this->_request['method'], ConstantGenericalUtil::DELETE_TYPE, true)) {
            switch ($this->_request['route']){
            case self::WINES:
                $WinesService = new WinesService($this->_request);
                $return = $WinesService->validateDelete();
                break;
            default:
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
            }
            return $return;
        }
    }

    private function _get()
    {
        $return = utf8_encode(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
        if (in_array($this->_request['method'], ConstantGenericalUtil::GET_TYPE, true)) {
            switch ($this->_request['route']){
            case self::WINES:
                $WinesService = new WinesService($this->_request);
                $return = $WinesService->validateGet();
                break;
            default:
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
            }
        }
        return $return;
    }

    private function _post()
    {
        $return = null;
        if (in_array($this->_request['method'], ConstantGenericalUtil::POST_TYPE, true)) {
            switch ($this->_request['route']) {
            case self::WINES:
                $WinesService = new WinesService($this->_request);
                $WinesService->setDataRequestBody($this->_requestData);
                $return = $WinesService->validatePost();
                break;
            default:
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
            }
            return $return;
        }
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
    }

    private function _put()
    {
        $return = null;
        if (in_array($this->_request['method'], ConstantGenericalUtil::PUT_TYPE, true)) {
            switch ($this->_request['route']) {
            case self::WINES:
                $WinesService = new WinesService($this->_request);
                $WinesService->setDataRequestBody($this->_requestData);
                $return = $WinesService->validatePut();
                break;
            default:
                throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
            }
            return $return;
        }
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
    }

}


?>
