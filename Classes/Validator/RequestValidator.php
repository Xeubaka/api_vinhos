<?php

namespace Validator;

use InvalidArgumentException;
use Service\WinesService;
use Util\ConstantGenericalUtil;
use Util\JsonUtil;

Class RequestValidator
{
    private array $request;
    private array $requestData;

    const GET = 'GET';
    const DELETE = 'DELETE';
    const WINES = 'WINES';

    public function __construct($request = [])
    {
        $this->request = $request;
    }

    public function processRequest()
    {
        $return = utf8_encode(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);

        if (in_array($this->request['method'], ConstantGenericalUtil::TYPE_REQUEST, true)){
            $return = $this->rerouteRequest();
        }
        return $return;
    }

    private function rerouteRequest()
    {
        if ($this->request['method'] !== self::GET && $this->request['method'] !== self::DELETE){
            $this->requestData = JsonUtil::prepareRequestBodyJson();
        }
        $method = $this->request['method'];
        return $this->$method();
    }

    private function delete()
    {
        $return = utf8_encode(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
        if (in_array($this->request['method'], ConstantGenericalUtil::DELETE_TYPE, true)){
            switch ($this->request['route']){
                case self::WINES:
                    $WinesService = new WinesService($this->request);
                    $return = $WinesService->validateDelete();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
            }
            return $return;
        }
    }

    private function get()
    {
        $return = utf8_encode(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
        if (in_array($this->request['method'], ConstantGenericalUtil::GET_TYPE, true)){
            switch ($this->request['route']){
                case self::WINES:
                    $WinesService = new WinesService($this->request);
                    $return = $WinesService->validateGet();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_RESOURCE_UNAVAILABLE);
            }
        }
        return $return;
    }

    private function post()
    {
        $return = null;
        if (in_array($this->request['method'], ConstantGenericalUtil::POST_TYPE, true)){
            switch ($this->request['route']){
                case self::WINES:
                    $WinesService = new WinesService($this->request);
                    $WinesService->setDataRequestBody($this->requestData);
                    $return = $WinesService->validatePost();
                    break;
                default:
                    throw new  InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
            }
            return $return;
        }
        throw new InvalidArgumentException(ConstantGenericalUtil::MSG_ERRO_ROUTE_TYPE);
    }

    private function put()
    {
        $return = null;
        if (in_array($this->request['method'], ConstantGenericalUtil::PUT_TYPE, true)) {
            switch ($this->request['route']) {
                case self::WINES:
                    $WinesService = new WinesService($this->request);
                    $WinesService->setDataRequestBody($this->requestData);
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
