<?php

namespace Service;

use InvalidArgumentException;
use Repository\VinhosRepository;
use Util\ConstantesGenericasUtil;

class VinhosService
{

    public const TABELA = 'vinhos';
    public const RECURSOS_GET = ['listar'];
    public const RECURSOS_POST = ['cadastrar'];
    public const RECURSOS_DELETE = ['deletar'];
    public const RECURSOS_PUT = ['atualizar'];

    private array $dados;
    private array $dadosCorpoRequest;

    private object $VinhosRepository;

    public function __construct($dados = [])
    {
        $this->dados = $dados;
        $this->VinhosRepository = new VinhosRepository();
    }

    public function validarGet()
    {
        $retorno = null;
        $recurso = $this->dados['recurso'];
        if(in_array($recurso, self::RECURSOS_GET, true)) {
            $retorno = $this->dados['id'] > 0 ? $this->getOneByKey() : $this->$recurso();
        } else {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null){
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    public function validarDelete()
    {
        $retorno = null; 
        $recurso = $this->dados['recurso'];
        if(in_array($recurso, self::RECURSOS_DELETE, true)){
            if($this->dados['id']>0){
                $retorno = $this->$recurso();
            }else{
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_ID_OBRIGATORIO);
            }
        } else {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

        if($retorno === null) {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    public function validarPost()
    {
        $retorno = null;
        $recurso = $this->dados['recurso'];
        if (in_array($recurso, self::RECURSOS_POST, true)) {
            $retorno = $this->$recurso();
        } else {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null) {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    public function validarPut()
    {
        $retorno = null;
        $recurso = $this->dados['recurso'];
        if (in_array($recurso, self::RECURSOS_PUT, true)) {
            if ($this->dados['id'] > 0) {
                $retorno = $this->$recurso();
            } else {
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_ID_OBRIGATORIO);
            }
        } else {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null) {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    public function setDadosCorpoRequest($dadosCorpoRequest)
    {
        $this->dadosCorpoRequest = $dadosCorpoRequest;
    }

    private function listar()
    {
        return $this->VinhosRepository->getMySQL()->getAll(self::TABELA);
    }

    private function getOneByKey()
    {
        return $this->VinhosRepository->getMySQL()->getOneByKey(self::TABELA, $this->dados['id']);
    }

    private function cadastrar()
    {
        [$name, $type, $weight] = [$this->dadosCorpoRequest['name'], $this->dadosCorpoRequest['type'], $this->dadosCorpoRequest['weight']];

        if($name && $type && $weight){
            
            if ($this->VinhosRepository->InsertVinho($this->dadosCorpoRequest) > 0){
                $idInserido = $this->VinhosRepository->getMySQL()->getDb()->lastInsertId();
                $this->VinhosRepository->getMySQL()->getDb()->commit();
                return ['id_inserido' => $idInserido];
            }

            $this->VinhosRepository->getMySQL()->getDb()->rollBack();

            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_INFORMACOES_OBRIGATORIAS);
    }

    private function deletar()
    {
        if ($this->VinhosRepository->deleteVinho($this->dados['id']) > 0){
            $this->VinhosRepository->getMySQL()->getDb()->commit();
            return ConstantesGenericasUtil::MSG_DELETADO_SUCESSO;
        }
        $this->VinhosRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_NAO_AFETADO);
    }

    private function atualizar()
    {
        if ($this->VinhosRepository->updateVinho($this->dados['id'], $this->dadosCorpoRequest) > 0){
            $this->VinhosRepository->getMySQL()->getDb()->commit();
            return ConstantesGenericasUtil::MSG_ATUALIZADO_SUCESSO;
        }
        $this->VinhosRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_NAO_AFETADO);
    }
}

?>