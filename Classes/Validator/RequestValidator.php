<?php

namespace Validator;

use InvalidArgumentException;
use Service\VinhosService;
use Util\ConstantesGenericasUtil;
use Util\JsonUtil;

Class RequestValidator
{
    private array $request;
    private array $dadosRequest;

    const GET = 'GET';
    const DELETE = 'DELETE';
    const VINHOS = 'VINHOS';

    public function __construct($request = [])
    {
        $this->request = $request;        
    }

    public function processarRequest()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        
        if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_REQUEST, true)){
            $retorno = $this->direcionarRequest();
        }
        return $retorno;
    }

    private function direcionarRequest()
    {
        if ($this->request['metodo'] !== self::GET && $this->request['metodo'] !== self::DELETE){
            $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
        }
        $metodo = $this->request['metodo'];
        return $this->$metodo();
    }

    private function delete()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_DELETE, true)){
            switch ($this->request['rota']){
                case self::VINHOS:
                    $VinhosService = new VinhosService($this->request);
                    $retorno = $VinhosService->validarDelete();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
            return $retorno;
        }
    }

    private function get()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_GET, true)){
            switch ($this->request['rota']){
                case self::VINHOS: 
                    $VinhosService = new VinhosService($this->request);
                    $retorno = $VinhosService->validarGet();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;
    }

    private function post()
    {
        $retorno = null;
        if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_POST, true)){
            switch ($this->request['rota']){
                case self::VINHOS:
                    $VinhosService = new VinhosService($this->request);
                    $VinhosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $VinhosService->validarPost();
                    break;
                default:
                    throw new  InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
            }
            return $retorno;
        }
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
    }

    private function put()
    {
        $retorno = null;
        if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_PUT, true)) {
            switch ($this->request['rota']) {
                case self::VINHOS:
                    $VinhosService = new VinhosService($this->request);
                    $VinhosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $VinhosService->validarPut();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
            }
            return $retorno;
        }
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
    }

}


?>